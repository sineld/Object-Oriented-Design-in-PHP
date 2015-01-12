<?php

class UserAuthenticator
{
    public function __construct($repo)
    {
        $this->repo = $repo;
    }

    public function authenticate($username, $password)
    {
        $user = $this->repo->findByUsernameAndPassword($username, $password);

        if ($user) {
            /* Logic to start session on cookie, native, etc */
            return true;
        }

        return false;
    }
}
