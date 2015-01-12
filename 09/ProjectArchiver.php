<?php

class ProjectArchiver
{
    public function __construct($project)
    {
        $this->project = $project;
    }

    public function archive($datetime = null)
    {
        $this->project->setArchivedAt($datetime ?: new DateTime('now'));
        $this->project->sendToQueue();
        $this->project->sentToEmailJob();
    }

    public function cancelArchiving()
    {
        if ($this->project->isOpen()) {
            $this->cancelQueueing();
            $this->cancelEmails();
        }
    }

    protected function sendToQueue() { /* Complex work to queue up project at archivedAt */ }

    protected function sendToEmailJob() { /* Complex work to queue emails at archivedAt */ }

    protected function cancelQueueing() { /* Complex work to cancel queue job */ }

    protected function cancelEmails() { /* Complex work to cancel email job */ }
}
