<?php


namespace core\forms\manage\project\product;

use core\entities\project\Characteristic;
use core\entities\project\product\Value;
use yii\base\Model;

/**
 * @property integer $id
 */
class ValueForm extends Model
{
    public $value;

    private $_characteristic;

    public function __construct(Characteristic $characteristic, Value $value = null, $config = [])
    {
        if ($value) {
            $this->value = $value->value;
        }
        $this->_characteristic = $characteristic;
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return array_filter(
            [
                $this->_characteristic->required ? ['value', 'required'] : false,
                $this->_characteristic->isString() ? ['value', 'string', 'max' => 255] : false,
                $this->_characteristic->isInteger() ? ['value', 'integer'] : false,
                $this->_characteristic->isFloat() ? ['value', 'number'] : false,
                ['value', 'safe'],
            ]
        );
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'value' => $this->_characteristic->name,
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_characteristic->id;
    }
}