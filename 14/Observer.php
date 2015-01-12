<?php

class Project
{
    protected $observers = [];

    public function observe($observer)
    {
        $this->observers[] = $observer;
    }

    public function cancelObservation($observer)
    {
        $i = array_search($observer, $this->observers);

        if ($i !== false) {
            unset($this->observers[$i]);
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

class Observer
{
    public function update($project)
    {
        echo "I heard that this project was updated: \n".print_r($project, true);
    }
}

$project = new Project();

$project->observe(new Observer);
$project->observe(new Observer);
$project->notify();
