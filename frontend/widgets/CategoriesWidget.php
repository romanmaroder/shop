<?php


namespace frontend\widgets;


use core\entities\project\Category;
use core\readModels\project\CategoryReadRepository;
use yii\base\Widget;
use yii\helpers\Html;

class CategoriesWidget extends Widget
{
    /** @var Category|null */
    public $active;
    private $categories;


    /**
     * CategoriesWidget constructor.
     * @param CategoryReadRepository $categories
     * @param array $config
     */
    public function __construct(CategoryReadRepository $categories, $config = [])
    {
        parent::__construct($config);
        $this->categories = $categories;

    }


    public function run()
    {
        return Html::tag('ul', implode(PHP_EOL, array_map(function (Category $category) {
             $indent = ($category->depth > 1 ? str_repeat('&nbsp;&nbsp;&nbsp;', $category->depth - 1) . '- ' : '');
             $active = $this->active && ($this->active->id == $category->id || $this->active->isChildOf($category));

             return Html::tag('li',
                 Html::a($indent  .  Html::encode($category->name), ['/shop/catalog/category', 'id' => $category->id],
                     ['class' => $active ? 'active': ''])
             );
         },
             $this->categories->getTreeWithSubsOf($this->active))), ['class' => 'sidebar_categories']);
     }

}


