<?php
// Based off Laravel

class ProjectCreator
{
    protected $errors = [];

    public function getErrors()
    {
        return $this->errors;
    }

    public function succeeded()
    {
        return empty($this->getErrors());
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
        } else {
            $this->errors[] = 'Something has gone wrong';
        }

        return $project;
    }
}

class ProjectController extends Controller
{
    public function store()
    {
        $projectCreator = new ProjectCreator();

        $project = $projectCreator->createForUser(Auth::user(), Input::get('project'));

        if ($projectCreator->succeeded()) {
            Session::flash('success', 'Project created successfully');
            return Redirect::to("projects/{$project->id}");
        } else {
            Session::flash('error', 'Project creation failed');
            return View::make('projects.create', compact($project));
        }
    }
}
