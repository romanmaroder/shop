<?php


namespace core\forms\manage\project\product;


use core\entities\project\product\Modification;
use yii\base\Model;

class ModificationForm extends Model
{
    public string $code;
    public string $name;
    public int $price;

    public function __construct(Modification $modification = null, $config = [])
    {
        if ($modification) {
            $this->code  = $modification->code;
            $this->name  = $modification->name;
            $this->price = $modification->price;
        }
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['code','name'],'required'],
            [['price'],'integer'],
        ];
    }
}