<?php

namespace common\bootstrap;


use Yii;
use yii\base\BootstrapInterface;

class SetUp implements BootstrapInterface{

    public function bootstrap($app)
    {
        Yii::$app->session->setFlash('danger', Yii::$app->getBasePath());
    }
}