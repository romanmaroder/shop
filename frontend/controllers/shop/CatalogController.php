<?php


namespace frontend\controllers\shop;


use core\readModels\project\BrandReadRepository;
use core\readModels\project\CategoryReadRepository;
use core\readModels\project\ProductReadRepository;
use core\readModels\project\TagReadRepository;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
{
    public $layout = 'catalog';

    private $products;
    private $categories;
    private $brands;
    private $tags;

    public function __construct(
        $id,
        $module,
        ProductReadRepository $products,
        CategoryReadRepository $categories,
        BrandReadRepository $brands,
        TagReadRepository $tags,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->products   = $products;
        $this->categories = $categories;
        $this->brands     = $brands;
        $this->tags       = $tags;
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = $this->products->getAll();
        $category     = $this->categories->getRoot();
        $brands       = $this->brands->getAllBrands();

        return $this->render(
            'index',
            [
                'category'     => $category,
                'brands'       => $brands,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionCategory($id)
    {
        if (!$category = $this->categories->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $brands = $this->brands->getAllBrands();
        $dataProvider = $this->products->getAllByCategory($category);

        return $this->render(
            'category',
            [
                'category'     => $category,
                'brands'       => $brands,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionBrand($id)
    {
        if (!$brand = $this->brands->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $dataProvider = $this->products->getAllByBrand($brand);

        return $this->render(
            'brand',
            [
                'brand'        => $brand,
                'dataProvider' => $dataProvider
            ]
        );
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionTag($id)
    {
        if (!$tag = $this->tags->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $dataProvider = $this->products->getAllByTag($tag);

        return $this->render(
            'tag',
            [
                'tag'          => $tag,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */

    public function actionProduct($id)
    {
        if (!$product = $this->products->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
$this->layout= 'blank';
        return $this->render('product', ['product' => $product]);
    }

}