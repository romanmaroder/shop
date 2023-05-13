<?php


namespace core\services\manage\project;


use core\entities\project\Characteristic;
use core\forms\manage\project\CharacteristicForm;
use core\repositories\project\CharacteristicRepository;

class CharacteristicManageService
{
    private CharacteristicRepository $characteristics;

    /**
     * CharacteristicManageService constructor.
     * @param $characteristics
     */
    public function __construct(CharacteristicRepository $characteristics)
    {
        $this->characteristics = $characteristics;
    }

    /**
     * @param CharacteristicForm $form
     * @return Characteristic
     */
    public function create(CharacteristicForm $form): Characteristic
    {
        $characteristic = Characteristic::create(
            $form->name,
            $form->type,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort
        );
        $this->characteristics->save($characteristic);
        return $characteristic;
    }

    /**
     * @param $id
     * @param Characteristic $form
     */
    public function edit($id, Characteristic $form): void
    {
        $characteristic = $this->characteristics->get($id);
        $characteristic->edit($form->name, $form->type, $form->required, $form->default, $form->variants, $form->sort);
        $this->characteristics->save($characteristic);
    }

    /**
     * @param $id
     * @throws \Throwable
     */
    public function remove($id): void
    {
        $characteristic = $this->characteristics->get($id);
        $this->characteristics->remove($characteristic);
    }
}