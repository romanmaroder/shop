<?php

namespace common\bootstrap;


use core\entities\project\Category;
use core\readModels\project\CategoryReadRepository;
use core\services\auth\PasswordResetService;
use core\services\contact\ContactService;
use frontend\urls\CategoryUrlRule;
use Yii;
use yii\base\BootstrapInterface;
use yii\caching\Cache;
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

        $container->setSingleton('cache', function () use ($app) {
            return $app->cache;
        });

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

        $container->set(CategoryUrlRule::class, [], [
            Instance::of(CategoryReadRepository::class),
            Instance::of('cache'),
        ]);
    }
}