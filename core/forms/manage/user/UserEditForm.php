<?php


namespace core\forms\manage\user;


use core\entities\user\User;
use yii\base\Model;

class UserEditForm extends Model
{
    public string $username;
    public string $email;

    public User $_user;

    /**
     * UserEditForm constructor.
     * @param User $user
     * @param array $config
     */
    public function __construct(User $user, $config = [])
    {
        $this->username = $user->username;
        $this->email    = $user->email;
        $this->_user    = $user;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['username', 'email'], 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [['username', 'email'], 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->_user->id]],
        ];
    }

}