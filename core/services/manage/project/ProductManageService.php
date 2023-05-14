<?php


namespace core\services\manage\project;


use core\entities\Meta;
use core\entities\project\product\Product;
use core\entities\project\Tag;
use core\forms\manage\project\product\CategoriesForm;
use core\forms\manage\project\product\ModificationForm;
use core\forms\manage\project\product\PhotosForm;
use core\forms\manage\project\product\ProductCreateForm;
use core\forms\manage\project\product\ProductEditForm;
use core\repositories\project\BrandRepository;
use core\repositories\project\CategoryRepository;
use core\repositories\project\ProductRepository;
use core\repositories\project\TagRepository;
use core\services\TransactionManager;

class ProductManageService
{
    private ProductRepository $products;
    private BrandRepository $brands;
    private CategoryRepository $categories;
    private TagRepository $tags;
    private TransactionManager $transaction;

    public function __construct(
        ProductRepository $products,
        BrandRepository $brands,
        CategoryRepository $categories,
        TagRepository $tags,
        TransactionManager $transaction
    ) {
        $this->products    = $products;
        $this->brands      = $brands;
        $this->categories  = $categories;
        $this->tags        = $tags;
        $this->transaction = $transaction;
    }

    /**
     * @param ProductCreateForm $form
     * @return Product
     * @throws \Throwable
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

        foreach ($form->photos->files as $file) {
            $product->addPhoto($file);
        }

        foreach ($form->tags->existing as $tagId) {
            $tag = $this->tags->get($tagId);
            $product->assignTag($tag->id);
        }

        $this->transaction->wrap(
            function () use ($product, $form) {
                foreach ($form->tags->newNames as $tagName) {
                    if (!$tag = $this->tags->findByName($tagName)) {
                        $tag = Tag::create($tagName, $tagName);
                        $this->tags->save($tag);
                    }
                    $product->assignTag($tag->id);
                }
                $this->products->save($product);
            }
        );

        $this->products->save($product);
        return $product;
    }

    public function edit($id, ProductEditForm $form): void
    {
        $product = $this->products->get($id);
        $brand   = $this->brands->get($form->brandId);
        $category = $this->categories->get($form->categories->main);

        $product->edit(
            $brand->id,
            $form->code,
            $form->name,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords,
            )
        );

        $product->changeMainCategory($category->id);
        $product->revokeCategories();

        foreach ($form->categories->others as $otherId) {
            $category=$this->categories->get($otherId);
            $product->assignCategory($category->id);
        }

        foreach ($form->values as $value) {
            $product->setValue($value->id, $value->value);
        }

        $product->revokeTags();

        foreach ($form->tags->existing as $tagId) {
            $tag = $this->tags->get($tagId);
            $product->assignTag($tag->id);
        }

        $this->transaction->wrap(
            function () use ($product, $form) {
                foreach ($form->tags->newNames as $tagName) {
                    if (!$tag = $this->tags->findByName($tagName)) {
                        $tag = Tag::create($tagName, $tagName);
                        $this->tags->save($tag);
                    }
                    $product->assignTag($tag->id);
                }
                $this->products->save($product);
            }
        );
    }

    /**
     * If you want to display a form in a modal window
     * @param $id
     * @param CategoriesForm $form
     */
    /*public function changeCategories($id, CategoriesForm $form): void
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
    }*/

    /**
     * @param $id
     * @param PhotosForm $form
     */
    public function addPhotos($id, PhotosForm $form): void
    {
        $product = $this->products->get($id);
        foreach ($form->files as $file) {
            $product->addPhoto($file);
        }
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param $photoId
     */
    public function movePhotoUp($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->movePhotoUp($photoId);
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param $photoId
     */
    public function movePhotoDown($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->movePhotoDown($photoId);
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param $photoId
     */
    public function removePhoto($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->removePhoto($photoId);
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param $otherId
     */
    public function addRelatedProduct($id, $otherId): void
    {
        $product = $this->products->get($id);
        $other   = $this->products->get($otherId);
        $product->assignRelatedProduct($other->$id);
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param $otherId
     */
    public function removeRelatedProduct($id, $otherId): void
    {
        $product = $this->products->get($id);
        $other   = $this->products->get($otherId);
        $product->revokeRelatedProduct($other->id);
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param ModificationForm $form
     */
    public function addModification($id, ModificationForm $form): void
    {
        $product = $this->products->get($id);
        $product->addModification($form->code, $form->name, $form->price);
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param $modificationId
     * @param ModificationForm $form
     */
    public function editModification($id, $modificationId, ModificationForm $form): void
    {
        $product = $this->products->get($id);
        $product->editModification($modificationId, $form->code, $form->name, $form->price);
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param $modificationId
     */
    public function removeModification($id, $modificationId): void
    {
        $product = $this->products->get($id);
        $product->removeModification($modificationId);
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