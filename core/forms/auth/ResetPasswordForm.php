<?php

namespace core\forms\auth;

use yii\base\Model;


/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required'],
//            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['password', 'string', 'min' => '6'],
        ];
    }


}
