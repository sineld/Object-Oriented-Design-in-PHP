<?php
// Based off Laravel

class ProjectCreator
{
    public function __construct($listener)
    {
        $this->listener = $listener;
    }

    public function createForUser($user, $attributes)
    {
        $project = new Project($attributes);

        if ($project->save()) {
            $user->projects()->associate($project);

            Mail::queue('projects.creation', compact('project'), function($message) use ($project) {
                $emails = $project->collaborators->lists('email');
                $message->to($emails)->subject("New Project {$project->name} Added");
            });

            return $this->listener->projectCreationSucceeded($project);
        } else {
            return $this->listener->projectCreationFailed($project);
        }
    }
}

class ProjectController extends Controller
{
    public function store()
    {
        $projectCreator = new ProjectCreator($this);

        return $projectCreator->createForUser(Auth::user(), Input::get('project'));
    }

    protected function projectCreationSucceeded($project)
    {
        Session::flash('success', 'Project created successfully');
        return Redirect::to("projects/{$project->id}");
    }

    protected function projectCreationFailed($project)
    {
        Session::flash('error', 'Project creation failed');
        return View::make('projects.create', compact('project'));
    }
}
