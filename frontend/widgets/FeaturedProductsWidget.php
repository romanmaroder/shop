<?php


namespace frontend\widgets;


use core\readModels\project\ProductReadRepository;
use yii\base\Widget;

/**
 * Class  FeaturedProductsWidget
 *
 * @property ProductReadRepository repository
 *
 * @property int limit
 */
class FeaturedProductsWidget extends Widget
{
    public int $limit;

    private ProductReadRepository $repository;

    public function __construct(ProductReadRepository $repository, $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function run(): string
    {
        if ($products = $this->repository->getFeatured($this->limit)) {
            return $this->render(
                'featured',
                [
                    'products' => $products,
                ]
            );
        }
        return false;

    }
}