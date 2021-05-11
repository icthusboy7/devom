<?php

namespace Appto\Devotional\View\Publisher;

class AuthorView
{
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $phone;

    public function __construct(string $id, string $firstName, string $lastName, string $email, string $phone)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
    }
}
