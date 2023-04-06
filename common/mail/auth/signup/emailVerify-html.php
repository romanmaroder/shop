<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var core\entities\User $user */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/verify-email', 'token' => $user->verification_token]);
?>
<div class="verify-email">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Follow the link below to verify your email:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
