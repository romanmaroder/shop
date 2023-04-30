<?php


namespace core\forms\manage\project;


use core\entities\project\Category;
use core\forms\CompositeForm;
use core\forms\manage\MetaForm;
use core\validators\SlugValidator;

/**
 * @property MetaForm $meta;
 */
class CategoryForm extends CompositeForm
{
    public $name;
    public $slug;
    public $title;
    public $description;
    public $parentId;

    private $_category;

    public function __construct(Category $category = null, $config = [])
    {
        if ($category) {
            $this->name        = $category->name;
            $this->slug        = $category->slug;
            $this->title       = $category->title;
            $this->description = $category->description;
            $this->parentId    = $category->parent ? $category->parent->id : null;
            $this->meta        = new MetaForm($category->meta);
            $this->_category   = $category;
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    /**
     * @return \array[][]
     */
    public function rules(): array
    {
        return [
            [['name', 'slug'], 'required'],
            [['parentId'], 'integer'],
            [['name', 'slug', 'title'], 'string', 'max' => 255],
            [['description'], 'string'],
            ['slug', SlugValidator::class],
            [
                ['name', 'slug'],
                'unique',
                'targetClass' => Category::class,
                'filter'      => $this->_category ? ['<>', 'id', $this->_category->id] : null
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function internalForms(): array
    {
        return ['meta'];
    }
}