<?php


namespace core\forms\manage\project;


use core\entities\project\Characteristic;
use yii\base\Model;

/**
 * @property array $variants
 */
class CharacteristicForm extends Model
{
    public string $name;
    public string $type;
    public string $required;
    public string $default;
    public string $textVariants;
    public $sort;

    private Characteristic $_characteristic;

    public function __construct(Characteristic $characteristic, $config = [])
    {
        if ($characteristic) {
            $this->name            = $characteristic->name;
            $this->type            = $characteristic->type;
            $this->required        = $characteristic->required;
            $this->default         = $characteristic->default;
            $this->textVariants    = implode(PHP_EOL, $characteristic->variants);
            $this->sort            = $characteristic->sort;
            $this->_characteristic = $characteristic;
        } else {
            $this->sort = Characteristic::find()->max('sort') + 1;
        }
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'type', 'sort'], 'required'],
            [['required'], 'boolean'],
            [['default'], 'string', 'max' => 255],
            [['textVariants'], 'string'],
            [['sort'], 'integer'],
            [
                ['name'],
                'unique',
                'targetClass' => Characteristic::class,
                'filter'      => $this->_characteristic ? ['<>', 'id', $this->_characteristic->id] : null
            ],
        ];
    }

    /**
     * @return array
     */
    public function getVariants(): array
    {
        return preg_split('#\s+#i', $this->textVariants);
    }
}