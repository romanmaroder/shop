<?php


namespace core\repositories;

use core\entities\user\User;
use RuntimeException;

class UserRepository
{
    /**
     * @param $value
     * @return User|null
     */
    public function findByUsernameOrEmail($value): ?User
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
    }


    /**
     * @param $network
     * @param $identity
     * @return User|null
     */
    public function findByNetworkIdentity($network, $identity): ?User
    {
        return User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])
            ->one();
    }

    /**
     * @param $id
     * @return User
     */
    public function get($id): User
    {
        return $this->findBy(['id' => $id]);
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

    public function remove(User $user): void
    {
        if (!$user->delete()) {
            throw new \RuntimeException('Removing error.');
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