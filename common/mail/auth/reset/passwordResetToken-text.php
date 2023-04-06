<?php

/** @var yii\web\View $this */
/** @var core\entities\User $user */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/reset/reset-password', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
