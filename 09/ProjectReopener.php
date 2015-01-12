<?php

class ProjectReopener
{
    public function __construct($project)
    {
        $this->project = $project;
    }

    public function reopen()
    {
        $this->project->setArchivedAt(null);

        if ($this->project->getArchivedAt() && $this->project->isOpen()) {
            $archiver = new ProjectArchiver($this->project);
            $archiver->cancelArchiving();
        } else {
            $this->project->sendToQueue();
            $this->project->sentToEmailJob();
        }
    }

    protected function sendToQueue() { /* Complex work to queue up project at archivedAt */ }

    protected function sendToEmailJob() { /* Complex work to queue emails at archivedAt */ }
}
