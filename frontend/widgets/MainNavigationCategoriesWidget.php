<?php


namespace frontend\widgets;


use core\entities\project\Category;
use core\readModels\project\CategoryReadRepository;
use yii\base\Widget;
use yii\helpers\Html;

class MainNavigationCategoriesWidget extends Widget
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


        $depth = 0;
        $class = "hassubs";
        $arrow = " <i class='fas fa-chevron-right'></i>";

        foreach ($this->categories->getTreeWithSubsOfMainMenu() as $n => $category) {


            if ($category->depth == $depth) {
                echo Html::endTag('li') . "\n";
            } else if ($category->depth > $depth) {

                if ($n == 0) {
                    echo Html::beginTag('ul', ['class' => 'cat_menu']) . "\n";
                } else {
                    echo Html::beginTag('ul') . "\n";
                }

            } else {
                echo Html::endTag('li') . "\n";

                for ($i = $depth - $category->depth; $i; $i--) {
                    echo Html::endTag('ul') . "\n";
                    echo Html::endTag('li') . "\n";
                }
            }
            if ($category->children) {

                echo Html::beginTag('li', ['class' => $class ]) . "\n";
                echo Html::a(Html::encode($category->name) . $arrow);

            } else {
                echo Html::beginTag('li') . "\n";
                echo Html::a(Html::encode($category->name));
            }

            $depth = $category->depth;
        }


        for ($i = $depth; $i; $i--) {
            echo Html::endTag('li') . "\n";
            echo Html::endTag('ul') . "\n";
        }


        /*return Html::tag('ul', implode(PHP_EOL, array_map(function (Category $category) {
            $indent = ($category->depth > 1 ? str_repeat('<i class="fas fa-chevron-right ml-auto"></i>', $category->depth - 1) . '- ' : '');
            $active = $this->active && ($this->active->isChildOf($category));
            $child = $category->children;
            if($child){
                foreach ($child as $item) {

                    echo'<pre>';
                    var_dump($item->name);
                }
            }
            die();
            return Html::tag('li',
                Html::a($indent . Html::encode($category->name), ['/shop/catalog/category', 'id' => $category->id],
                    ['class' => $active ? 'active' : ''])

            );*/
        /*if ($category->depth > 1) {
            return Html::tag('li',
                Html::a($indent . Html::encode($category->name), ['/shop/catalog/category', 'id' => $category->id],
                    ['class' => $active ? 'active' : '']) . '' .
                Html::ul($category, ['item' => function ($item, $index) use ($category, $active) {
                    return Html::tag(
                        'li',
                        Html::a(Html::encode($category->name), ['/shop/catalog/category', 'id' => $category->id],
                            ['class' => $active ? 'active' : '']),
                    );

                }]),
                ['class' => 'hassubs']

            );
        }*/
        /* },
             $this->categories->getTreeWithSubsOf())), ['class' => 'cat_menu']);*/


        /*return "<ul class='cat_menu'>
                                <li><a href='#'>Computers & Laptops <i class='fas fa-chevron-right ml-auto'></i></a>
                                </li>
                                <li><a href='#'>Cameras & Photos<i class='fas fa-chevron-right'></i></a></li>
                                <li class='hassubs'>
                                    <a href='#'>Hardware<i class='fas fa-chevron-right'></i></a>
                                    <ul>
                                        <li class='hassubs'>
                                            <a href='#'>Menu Item<i class='fas fa-chevron-right'></i></a>
                                            <ul>
                                                <li><a href='#'>Menu Item<i
                                                            class='fas fa-chevron-right'></i></a>
                                                </li>
                                                <li><a href='#'>Menu Item<i
                                                            class='fas fa-chevron-right'></i></a>
                                                </li>
                                                <li><a href='#'>Menu Item<i
                                                            class='fas fa-chevron-right'></i></a>
                                                </li>
                                                <li><a href='#'>Menu Item<i
                                                            class='fas fa-chevron-right'></i></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href='#'>Menu Item<i class='fas fa-chevron-right'></i></a></li>
                                        <li><a href='#'>Menu Item<i class='fas fa-chevron-right'></i></a></li>
                                        <li><a href='#'>Menu Item<i class='fas fa-chevron-right'></i></a></li>
                                    </ul>
                                </li>
                                <li><a href='#'>Smartphones & Tablets<i class='fas fa-chevron-right'></i></a>
                                </li>
                                <li><a href='#'>TV & Audio<i class='fas fa-chevron-right'></i></a></li>
                                <li><a href='#'>Gadgets<i class='fas fa-chevron-right'></i></a></li>
                                <li><a href='#'>Car Electronics<i class='fas fa-chevron-right'></i></a></li>
                                <li><a href='#'>Video Games & Consoles<i class='fas fa-chevron-right'></i></a>
                                </li>
                                <li><a href='#'>Accessories<i class='fas fa-chevron-right'></i></a></li>
                            </ul>";*/
    }

}


