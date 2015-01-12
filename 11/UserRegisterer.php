<?php

class UserRegisterer
{
    public function __construct($repo, $mailer)
    {
        $this->repo = $repo;
        $this->mailer = $mailer;
    }

    public function register($user)
    {
        if (! $user->username) {
            throw new Exception('Username must be present');
        }

        if (! filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email address');
        }

        $this->repo->save($user);
        $this->mailer->sendWelcomeEmail($user);

        return true;
    }
}

class UserMailer
{

    public function sendWelcomeEmail($user)
    {
        if ($user->saved) {
            return mail($user->email, 'User Registration', $this->fetchView('welcome'));
        }

        throw new Exception('User not registered yet');
    }

    public function fetchView($type)
    {
        // Fetch some view template
    }
}
