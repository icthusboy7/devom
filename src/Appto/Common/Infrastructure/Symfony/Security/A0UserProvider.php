<?php

namespace Appto\Common\Infrastructure\Symfony\Security;

use Auth0\JWTAuthBundle\Security\Auth0Service;
use Auth0\JWTAuthBundle\Security\Core\JWTUserProviderInterface;
use Symfony\Component\Intl\Exception\NotImplementedException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class A0UserProvider implements JWTUserProviderInterface
{
    protected $auth0Service;
    public function __construct(Auth0Service $auth0Service)
    {
        $this->auth0Service = $auth0Service;
    }
    public function loadUserByJWT($jwt)
    {
        // you can fetch the user profile from the auth0 api
        // or from your database
        // $data = $this->auth0Service->getUserProfileByA0UID($jwt->token,$jwt->sub);
        // in this case, we will just use what we got from
        // the token because we dont need any info from the profile
        $data = [ 'sub' => $jwt->sub ];
        $roles = array();
        $roles[] = 'ROLE_AUTH0_AUTHENTICATED';
//        if (isset($jwt->scope)) {
//            $scopes = explode(' ', $jwt->scope);
//            if (array_search('write:users', $scopes) !== false) {
//                $roles[] = 'ROLE_OAUTH_READER';
//            }
//        }
        return new A0User($data, $roles);
    }
    public function loadUserByUsername($username)
    {
        throw new NotImplementedException('method not implemented');
    }
    public function getAnonymousUser()
    {
        return new A0AnonymousUser();
    }
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof WebserviceUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }
        return $this->loadUserByUsername($user->getUsername());
    }
    public function supportsClass($class)
    {
        //return $class === 'Appto\Common\Infrastructure\Symfony\Security\A0User';
        return $class === A0User::class;
    }
}
