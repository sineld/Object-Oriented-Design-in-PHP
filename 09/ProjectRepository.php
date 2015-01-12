<?php

class ProjectRepository
{
    protected $projects = [
        1 => [
            'id' => 1,
            'name' => 'Screencasts',
            'collaborators' => ['me']
        ],
        2 => [
            'id' => 2,
            'name' => 'Client Y New App',
            'collaborators' => ['me', 'Client Y'],
            'archivedAt' => '2024-01-01 01:00:00'
        ],
        3 => [
            'id' => 3,
            'name' => 'Client X Site Overhaul',
            'collaborators' => ['me', 'Client X'],
            'archivedAt' => '2013-01-01 01:00:00'
        ],
    ];

    public function all()
    {
        return array_map(function($project) {
            return $this->factory($project);
        }, $this->projects);
    }

    public function saveAll($projects)
    {
        foreach ($projects as $project) {
            // Persist
        }
    }

    protected function factory($data)
    {
        if (isset($data['archivedAt']) && $data['archivedAt']) {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $data['archivedAt']);
            if ($date <= new DateTime('now')) {
                return new ArchivedProject($data);
            }
        }
        return new OpenProject($data);
    }
}
