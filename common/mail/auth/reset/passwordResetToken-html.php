<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var core\entities\User $user */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/reset/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Follow the link below to reset your password:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
