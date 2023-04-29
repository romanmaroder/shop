<?php


namespace core\forms\manage\project;


use core\entities\project\Brand;
use core\forms\CompositeForm;
use core\forms\manage\MetaForm;
use core\validators\SlugValidator;

/**
 * @property MetaForm $meta;
 */
class BrandForm extends CompositeForm
{
    public string $name;
    public string $slug;

    private Brand $_brand;

    public function __construct(Brand $brand = null, $config = [])
    {
        if ($brand) {
            $this->name   = $brand->name;
            $this->slug   = $brand->slug;
            $this->meta   = new MetaForm($brand->meta);
            $this->_brand = $brand;
        }
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['slug'], SlugValidator::class],
            [
                ['name', 'slug'],
                'unique',
                'targetClass' => Brand::class,
                'filter'      => $this->_brand ? ['<>', 'id', $this->_brand->id] : null
            ],
        ];
    }


    protected function internalForms(): array
    {
        return ['meta'];
    }
}