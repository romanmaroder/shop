<?php

namespace core\tests\unit\forms;

use Codeception\Test\Unit;
use Yii;
use core\forms\auth\LoginForm;
use common\fixtures\UserFixture;

/**
 * Login form test
 */
class LoginFormTest extends Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;


    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ];
    }

    public function testBlank()
    {
        $model = new LoginForm([
            'username' => '',
            'password' => '',
        ]);

        verify($model->validate())->false();
        verify(Yii::$app->user->isGuest)->true();
    }

    /*public function testLoginWrongPassword()
    {
        $model = new LoginForm([
            'username' => 'bayer.hudson',
            'password' => 'wrong_password',
        ]);

        verify($model->login())->false();
        verify( $model->errors)->arrayHasKey('password');
        verify(Yii::$app->user->isGuest)->true();
    }*/

    public function testCorrect()
    {
        $model = new LoginForm([
            'username' => 'bayer.hudson',
            'password' => 'password_0',
        ]);


        verify($model->validate())->true();
        verify($model->errors)->arrayHasNotKey('password');
        verify(Yii::$app->user->isGuest)->false();
    }
}
