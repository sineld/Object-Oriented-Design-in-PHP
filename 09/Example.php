<?php

require 'ProjectArchiver.php';
require 'ProjectReopener.php';
require '../TablePrinter.php';
require 'Project.php';
require 'ProjectRepository.php';

$repo = new ProjectRepository();

$projects = $repo->all();

// Add 'New Developer' to all projects

foreach ($projects as $project) {
    $project->addCollaborator('New Developer');
}

$tp = new TablePrinter(['Project', 'Status', 'Collaborators']);
foreach ($projects as $p) {
    $tp->addRow($p->getName(), $p->getStatus(), $p->getCollaborators());
}

echo $tp->output();
