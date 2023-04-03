<?php

namespace common\bootstrap;


use frontend\services\auth\PasswordResetService;
use frontend\services\contact\ContactService;
use Yii;
use yii\base\BootstrapInterface;
use yii\di\Instance;
use yii\mail\MailerInterface;

class SetUp implements BootstrapInterface
{

    public function bootstrap($app)
    {
        $container = Yii::$container;

        $container->setSingleton(PasswordResetService::class);

        /* Example of using a container

        $container->setSingleton(
            PasswordResetService::class,
            function () use ($app) {
                return new PasswordResetService([$app->params['supportEmail'] => $app->name . ' robot']);
            });
        */

        $container->setSingleton(
            MailerInterface::class,
            function () use ($app) {
                return $app->mailer;
            }
        );
        $container->setSingleton(
            ContactService::class,
            [],
            [
               // $app->params['adminEmail'],

                /* Optional parameter. The framework will substitute MailerInterface itself,
                   via reflection, registered in the container
                Instance::of(MailerInterface::class) */
            ]
        );
    }
}