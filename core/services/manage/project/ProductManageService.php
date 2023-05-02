<?php


namespace core\services\manage\project;


use core\entities\Meta;
use core\entities\project\product\Product;
use core\forms\manage\project\product\CategoriesForm;
use core\forms\manage\project\product\ProductCreateForm;
use core\repositories\project\BrandRepository;
use core\repositories\project\CategoryRepository;
use core\repositories\project\ProductRepository;

class ProductManageService
{
    private ProductRepository $products;
    private BrandRepository $brands;
    private CategoryRepository $categories;

    public function __construct(ProductRepository $products, BrandRepository $brands, CategoryRepository $categories)
    {
        $this->products   = $products;
        $this->brands     = $brands;
        $this->categories = $categories;
    }

    /**
     * @param ProductCreateForm $form
     * @return Product
     */
    public function create(ProductCreateForm $form): Product
    {
        $brand    = $this->brands->get($form->brandId);
        $category = $this->categories->get($form->categories->main);

        $product = Product::create(
            $brand->id,
            $category->id,
            $form->code,
            $form->name,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $product->setPrice($form->price->new, $form->price->old);

        foreach ($form->categories->others as $otherId) {
            $category = $this->categories->get($otherId);
            $product->assignCategory($category->id);
        }

        foreach ($form->values as $value) {
            $product->setValue($value->id, $value->value);
        }

        $this->products->save($product);
        return $product;
    }

    public function changeCategories($id, CategoriesForm $form): void
    {
        $product  = $this->products->get($id);
        $category = $this->categories->get($form->main);
        $product->changeMainCategory($category->id);
        $product->revokeCategories();

        foreach ($form->others as $otherId) {
            $category = $this->categories->get($otherId);
            $product->assignCategory($category->id);
        }

        $this->products->save($product);
    }

    /**
     * @param $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $product = $this->products->get($id);
        $this->products->remove($product);
    }
}