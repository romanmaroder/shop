<?php


namespace core\repositories\project;


use core\entities\project\Characteristic;
use core\repositories\NotFoundException;
use RuntimeException;
use yii\db\StaleObjectException;

class CharacteristicRepository
{
    /**
     * @param $id
     * @return Characteristic
     */
    public function get($id): Characteristic
    {
        if (!$characteristic = Characteristic::findOne($id)) {
            throw new NotFoundException('Characteristic not found.');
        }
        return $characteristic;
    }

    /**
     * @param Characteristic $characteristic
     */
    public function save(Characteristic $characteristic): void
    {
        if (!$characteristic->save()) {
            throw new RuntimeException('Saving error.');
        }
    }

    /**
     * @param Characteristic $characteristic
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function remove(Characteristic $characteristic): void
    {
        if (!$characteristic->delete()) {
            throw new RuntimeException('Removing error.');
        }
    }
}