<?php

class UserRepository
{
    public function find($id)
    {
        return User::find($id);
    }

    public function findAll()
    {
        return User::all();
    }

    public function getAllCreatedBefore($year, $options = [])
    {
        $query = User::query()->where('created_at', '<', $year);

        if (isset($options['take'])) {
            $query->take($options['take']);
        }

        return $query->get();
    }
}
