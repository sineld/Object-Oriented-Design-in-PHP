<?php
// Based off Laravel

class ProjectController extends Controller
{
    public function store()
    {
        $currentUser = Auth::user();

        $project = new Project(Input::get('project'));

        if ($project->save()) {
            $currentUser->projects()->associate($project);

            Mail::queue('projects.creation', compact('project'), function($message) use ($project) {
                $emails = $project->collaborators->lists('email');
                $message->to($emails)->subject("New Project {$project->name} Added");
            });

            Session::flash('success', 'Project created successfully');
            return Redirect::to("projects/{$project->id}");
        } else {
            Session::flash('error', 'Project creation failed');
            return View::make('projects.create', compact('project'));
        }
    }
}
