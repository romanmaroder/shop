<?php


namespace core\services\auth;


use core\entities\user\User;
use core\repositories\UserRepository;
use core\forms\auth\SignupForm;
use RuntimeException;
use Yii;
use yii\base\InvalidArgumentException;
use yii\mail\MailerInterface;

class SignupService
{

    private UserRepository $users;
    private MailerInterface $mailer;

    public function __construct(UserRepository $users, MailerInterface $mailer)
    {
        $this->users  = $users;
        $this->mailer = $mailer;
    }

    public function signup(SignupForm $form): void
    {
        $user = User::requestSignup($form->username, $form->email, $form->password);

        $this->users->save($user);

        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/signup/emailVerify-html', 'text' => 'auth/signup/emailVerify-text'],
                ['user' => $user]
            )
            ->setTo($form->email)
            ->setSubject('Signup confirm for ' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new RuntimeException('Email sending error.');
        }
    }

    public function confirm($token): void
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Verify email token cannot be blank.');
        }
        $user = $this->users->findByVerificationToken($token);
        $user->confirmSignup();
        $this->users->save($user);
    }

}