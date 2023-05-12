<?php


namespace core\services\manage\project;


use core\entities\Meta;
use core\entities\project\Brand;
use core\forms\manage\project\BrandForm;
use core\repositories\project\BrandRepository;
use core\repositories\project\ProductRepository;
use DomainException;

class BrandManageService
{
    private BrandRepository $brands;
    private ProductRepository $products;

    public function __construct(BrandRepository $brands, ProductRepository $products)
    {
        $this->brands   = $brands;
        $this->products = $products;
    }

    /**
     * @param BrandForm $form
     * @return Brand
     */
    public function create(BrandForm $form): Brand
    {
        $brand = Brand::create(
            $form->name,
            $form->slug,
            new Meta($form->meta->title, $form->meta->description, $form->meta->keywords)
        );

        $this->brands->save($brand);
        return $brand;
    }

    /**
     * @param $id
     * @param BrandForm $form
     */
    public function edit($id, BrandForm $form): void
    {
        $brand = $this->brands->get($id);
        $brand->edit(
            $form->name,
            $form->slug,
            new Meta($form->meta->title, $form->meta->description, $form->meta->keywords)
        );
        $this->brands->save($brand);
    }

    /**
     * @param $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $brand = $this->brands->get($id);
        if ($this->products->existsByBrand($brand->id)) {
            throw new DomainException('Unable to remove brand with products.');
        }
        $this->brands->remove($brand);
    }
}