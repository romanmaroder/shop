<?php


namespace common\repositories;

use common\entities\User;
use RuntimeException;

class UserRepository
{
    public function findByUsernameOrEmail($value): ?User
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
    }


    public function findByVerificationToken($token): User
    {
        return $this->findBy(['verification_token' => $token]);
    }


    public function findByEmail($email): User
    {
        return $this->findBy(['email' => $email]);
    }


    public function findByPasswordResetToken($token): User
    {
        return $this->findBy(['password_reset_token' => $token, 'status' => User::STATUS_ACTIVE]);
    }

    public function existsByPasswordResetToken(string $token): bool
    {
        return (bool)User::findByPasswordResetToken($token);
    }

    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new RuntimeException('Saving error.');
        }
    }


    private function findBy(array $condition): User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('User not found.');
        }
        return $user;
    }


}