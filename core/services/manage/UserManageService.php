<?php


namespace core\services\manage;


use core\entities\user\User;
use core\forms\manage\user\UserCreateForm;
use core\forms\manage\user\UserEditForm;
use core\repositories\UserRepository;

class UserManageService
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password,
        );
        $this->repository->save($user);
        return $user;
    }

    public function edit($id, UserEditForm $form): void
    {
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email
        );
        $this->repository->save($user);
    }
}