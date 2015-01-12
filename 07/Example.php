<?php

class User
{
    public function __construct($username, $profile = null)
    {
        $this->username = $username;
        $this->profile  = $profile;
    }

    public function getUsername() { return $this->username; }
    public function getProfile() { return $this->profile; }

    public function getName()
    {
        if ($this->profile) {
            return $this->profile->getName();
        }
    }

    public function getPhotoPath()
    {
        if ($this->profile) {
            return $this->profile->getPhotoPath();
        }
    }
}

class Profile
{
    public function __construct($name, $photo = null)
    {
        $this->name  = $name;
        $this->photo = $photo;
    }

    public function getName() { return $this->name; }
    public function getPhoto() { return $this->photo; }

    public function getPhotoPath()
    {
        if ($this->photo) {
            return $this->photo->getPath();
        }
    }
}

class Photo
{
    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getPath() { return $this->path; }
}

$user = new User('user', new Profile('User', new Photo('SomeMeme.gif')));

$name = $user->getName();
$path = $user->getPhotoPath();

echo "The path to {$name}'s photo is: {$path}\n";
