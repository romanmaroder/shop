<?php

namespace core\entities;

use DomainException;
use yii\base\Exception;
use Yii;
use yii\base\InvalidArgumentException;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED  = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE   = 10;


    public static function requestSignup(string $username, string $email, string $password): self
    {
        $user           = new static();
        $user->username = $username;
        $user->email    = $email;
        $user->setPassword($password);
        $user->created_at = time();
        $user->status     = self::STATUS_INACTIVE;
        $user->generateEmailVerificationToken();
        $user->generateAuthKey();
        return $user;
    }

    public function confirmSignup(): void
    {
        if (!$this->isInactive()) {
            throw new InvalidArgumentException('User is already active.');
        }

        $this->status = self::STATUS_ACTIVE;
        $this->removeEmailVerificationToken();
    }

    public function requestPasswordReset(): void
    {
        if (!empty($this->password_reset_token) && self::isPasswordResetTokenValid($this->password_reset_token)) {
            throw new DomainException('Password resetting is already requested.');
        }
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function resetPassword($password): void
    {
        if (empty($this->password_reset_token)) {
            throw new DomainException('Password resetting is not requested.');
        }
        $this->setPassword($password);
        $this->password_reset_token = null;
    }

    /** *
     *Is the user waiting for activation
     * @return bool
     */
    public function isInactive(): bool
    {
        return $this->status === self::STATUS_INACTIVE;
    }

    /**
     * Is the user active
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    /*public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }*/

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne(
            [
                'password_reset_token' => $token,
                'status'               => self::STATUS_ACTIVE,
            ]
        );
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token)
    {
        return static::findOne(
            [
                'verification_token' => $token,
                'status'             => self::STATUS_INACTIVE
            ]
        );
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token): bool
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire    = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    private function setPassword($password)
    {
        try {
            $this->password_hash = Yii::$app->security->generatePasswordHash($password);
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
    }

    /**
     * Generates "remember me" authentication key
     */
    private function generateAuthKey()
    {
        try {
            $this->auth_key = Yii::$app->security->generateRandomString();
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
    }

    /**
     * Generates new password reset token
     */
    private function generatePasswordResetToken()
    {
        try {
            $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
    }

    /**
     * Generates new token for email verification
     */
    private function generateEmailVerificationToken()
    {
        try {
            $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
    }

    /**
     * Removes email verification token
     */
    private function removeEmailVerificationToken()
    {
        $this->verification_token = null;
    }

    /**
     * Removes password reset token
     */
    private function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
