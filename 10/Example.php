<?php

require '../TablePrinter.php';
require 'User.php';
require 'UserRepository.php';

$repo = new UserRepository();

$users = $repo->getAllCreatedBefore(2014, ['take' => 2]);

$tp = new TablePrinter(['Class', 'Username', 'Created This Year']);

foreach ($users as $user) {
    $tp->addRow(get_class($user), $user->username, $user->createdThisYear() ? 'Yes' : 'No');
}

echo $tp->output();
