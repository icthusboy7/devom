<?php

namespace Appto\Common\Infrastructure\Symfony\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

class A0User implements UserInterface, EquatableInterface, WebserviceUser
{
    private $jwt;
    private $roles;
    public function __construct($jwt, array $roles)
    {
        $this->jwt = $jwt;
        $this->roles = $roles;
    }
    public function getRoles()
    {
        return $this->roles;
    }
    public function getPassword()
    {
        return null;
    }
    public function getSalt()
    {
        return null;
    }
    public function getUsername()
    {
        return isset($this->jwt["email"]) ? $this->jwt["email"] : $this->jwt["sub"];
    }
    public function eraseCredentials()
    {
    }
    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof A0User) {
            return false;
        }
        if ($this->getUsername() !== $user->getUsername()) {
            return false;
        }
        return true;
    }
}
