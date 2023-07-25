<?php

namespace frontend\urls;

use core\entities\project\Category;
use core\readModels\project\CategoryReadRepository;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;
use yii\web\UrlNormalizerRedirectException;
use yii\web\UrlRuleInterface;

class CategoryUrlRule extends BaseObject implements UrlRuleInterface
{
    public $prefix = 'catalog';
    private $repository;

    /**
     * CategoryUrlRule constructor.
     * @param CategoryReadRepository $repository
     * @param array $config
     */
    public function __construct(CategoryReadRepository $repository, $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }


    /**
     * @inheritDoc
     */
    public function parseRequest($manager, $request)
    {
        if (preg_match('#^' . $this->prefix . '/(.*[a-z])$#is', $request->pathInfo, $matches)) {
            $path = $matches['1'];
            if (!$category = $this->repository->findBySlug($this->getPathSlug($path))) {
                return false;
            }
            if ($path != $this->getCategoryPath($category)) {
                throw new UrlNormalizerRedirectException(['shop/catalog/category', 'id' => $category->id], 301);
            }
            return ['shop/catalog/category', ['id' => $category->id]];
        };
        return false;
    }

    /**
     * @inheritDoc
     */
    public function createUrl($manager, $route, $params)
    {
        if ($route == 'shop/catalog/category') {
            if (empty($params['id'])) {
                throw new \yii\base\InvalidParamException('Empty id.');
            }
            if (!$category = $this->repository->find($params['id'])) {
                throw new \yii\base\InvalidParamException('Undefined id.');
            }

            $url = $this->prefix . '/' . $this->getCategoryPath($category);

            unset($params['id']);
            if (!empty($params) && ($query = http_build_query($params)) !== '') {
                $url .= '?' . $query;
            }
            return $url;
        }
        return false;
    }

    private function getPathSlug($path): string
    {
        $chunks = explode('/', $path);
        return end($chunks);
    }

    private function getCategoryPath(Category $category): string
    {
        $chunks = ArrayHelper::getColumn($category->getParents()->andWhere(['>', 'depth', 0])->all(), 'slug');
        $chunks[] = $category->slug;
        return implode('/', $chunks);
    }
}