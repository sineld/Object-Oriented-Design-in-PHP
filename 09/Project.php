<?php

class ArchivedProject extends Project
{
    public function setName($name) { return false; }
    public function addCollaborator($collab) { return false; }
    public function isArchived() { return true; }
}

class OpenProject extends Project
{
    public function isArchived() { return false; }
}

abstract class Project
{
    protected $id;
    protected $name;
    protected $archivedAt;
    protected $collaborators = [];

    public function __construct($options)
    {
        isset($options['id']) && $this->id = $options['id'];
        isset($options['name']) && $this->name = $options['name'];
        isset($options['collaborators']) && $this->collaborators = $options['collaborators'];
        isset($options['archivedAt']) && $this->archivedAt = DateTime::createFromFormat('Y-m-d H:i:s', $options['archivedAt']);
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function addCollaborators($collabs)
    {
        foreach ($collabs as $collab) {
            $this->addCollaborator($collab);
        }
    }

    public function addCollaborator($collab)
    {
        $this->collaborators[] = $collab;
    }

    public function isOpen()
    {
        return ! $this->isArchived();
    }

    public function isArchived()
    {
        if ($this->archivedAt) {
            return $this->archivedAt <= new DateTime('now');
        }
        return false;
    }

    public function archive(DateTime $date = null)
    {
        $archiver = new ProjectArchiver($this);
        $archiver->archive($date);
    }

    public function reopen()
    {
        $reopener = new ProjectReopener($this);
        $reopener->reopen();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStatus()
    {
        return $this->isOpen() ? 'Open' : 'Archived';
    }

    public function getCollaborators()
    {
        return join(', ', $this->collaborators);
    }
}
