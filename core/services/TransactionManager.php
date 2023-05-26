<?php


namespace core\services;


use Exception;
use Yii;

class TransactionManager
{
    /**
     * @param callable $function
     * @throws \Throwable
     */
    public function wrap(callable $function): void
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $function();
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}