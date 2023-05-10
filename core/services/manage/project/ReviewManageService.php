<?php


namespace core\services\manage\project;


use core\forms\manage\project\product\ReviewEditForm;
use core\repositories\project\ProductRepository;

class ReviewManageService
{
    private ProductRepository $products;

    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    /**
     * @param $id
     * @param $reviewId
     * @param ReviewEditForm $form
     */
    public function edit($id, $reviewId, ReviewEditForm $form): void
    {
        $product = $this->products->get($id);
        $product->editReview($reviewId, $form->vote, $form->text);
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param $reviewId
     */
    public function activate($id, $reviewId): void
    {
        $product = $this->products->get($id);
        $product->activateReview($reviewId);
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param $reviewId
     */
    public function draft($id, $reviewId): void
    {
        $product = $this->products->get($id);
        $product->draftReview($reviewId);
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param $reviewId
     */
    public function remove($id, $reviewId): void
    {
        $product = $this->products->get($id);
        $product->removeReview($reviewId);
        $this->products->save($product);
    }
}