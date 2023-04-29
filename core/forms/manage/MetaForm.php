<?php


namespace core\forms\manage;


use core\entities\Meta;
use yii\base\Model;

class MetaForm extends Model
{
    public string $title;
    public string $description;
    public string $keywords;

    /**
     * FormMeta constructor.
     * @param Meta|null $meta
     * @param array $config
     */
    public function __construct(Meta $meta = null, $config = [])
    {
        if ($meta) {
            $this->title       = $meta->title;
            $this->description = $meta->description;
            $this->keywords    = $meta->keywords;
        }
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title'], 'string', 'max' => 255],
            [['description', 'keywords'], 'string'],
        ];
    }
}