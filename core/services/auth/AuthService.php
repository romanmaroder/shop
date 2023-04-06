<?php


namespace core\services\auth;


use core\entities\user\User;
use core\forms\auth\LoginForm;
use core\repositories\UserRepository;
use DomainException;

class AuthService
{
    private UserRepository $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function auth(LoginForm  $form):User
    {
        $user = $this->users->findByUsernameOrEmail($form->username);
        if (!$user || !$user->isActive() || !$user->validatePassword($form->password)){
            throw new DomainException('Undefined user or password.');
        }
        return $user;
    }
}