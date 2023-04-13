<?php


namespace core\helpers;


use core\entities\user\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use function PHPUnit\Framework\matches;

class UserHelper
{
    /**
     * Return status list
     * @return string[]
     */
    public static function statusList(): array
    {
        return [
            User::STATUS_INACTIVE => 'Inactive',
            User::STATUS_ACTIVE   => 'Active',
        ];
    }

    /**
     * Return status name
     * @param $status
     * @return string
     * @throws \Exception
     */
    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        /* Match expression is only allowed since PHP 8.0
                match ($status) {
                    0, User::STATUS_INACTIVE => $class ='badge bg-secondary',
                    User::STATUS_ACTIVE => $class = 'badge bg-success',
                };
        */

        switch ($status) {
            case User::STATUS_INACTIVE:
                $class = 'badge bg-secondary';
                break;
            case User::STATUS_ACTIVE:
                $class = 'badge bg-success';
                break;
            default:
                $class = 'badge bg-secondary';
        };

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), ['class' => $class]);



    }
}