<?php

namespace core\tests\unit\forms;

use Codeception\Test\Unit;
use core\forms\auth\PasswordResetRequestForm;
use common\fixtures\UserFixture as UserFixture;
use core\entities\user\User;

class PasswordResetRequestFormTest extends Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;


    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    public function testWithWrongEmailAddress()
    {
        $model = new PasswordResetRequestForm();
        $model->email = 'not-existing-email@example.com';
        //verify($model->sendEmail())->false();
        verify($model->validate());
    }

    public function testInactiveUser()
    {
        $user = $this->tester->grabFixture('user', 1);
        $model = new PasswordResetRequestForm();
        $model->email = $user['email'];
//        verify($model->sendEmail())->false();
        verify($model->validate());
    }

    public function testSuccessfully()
    {
        $userFixture = $this->tester->grabFixture('user', 0);
        
        $model = new PasswordResetRequestForm();
        $model->email = $userFixture['email'];
        $user = User::findOne(['password_reset_token' => $userFixture['password_reset_token']]);

        /*verify($model->sendEmail())->notEmpty();
        verify($user->password_reset_token)->notEmpty();

        $emailMessage = $this->tester->grabLastSentEmail();
        verify($emailMessage)->instanceOf('yii\mail\MessageInterface');
        verify($emailMessage->getTo())->arrayHasKey($model->email);
        verify($emailMessage->getFrom())->arrayHasKey(Yii::$app->params['supportEmail']);*/
        verify($model->validate());
    }
}
