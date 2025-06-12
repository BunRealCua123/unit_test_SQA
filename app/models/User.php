<?php

namespace App\Models;

class User
{
    public $id;
    public $name;
    public $email;
    public $role;

    public function __construct($id = null, $name = null, $email = null, $role = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }
}
