<?php


namespace core\forms\manage\project;


use core\entities\project\Brand;
use core\forms\manage\MetaForm;
use yii\base\Model;

/**
 * @property MetaForm $meta;
 */
class BrandForm extends Model
{
    public string $name;
    public string $slug;

    private MetaForm $_meta;
    private Brand $_brand;

    public function __construct(Brand $brand = null, $config = [])
    {
        if ($brand) {
            $this->name   = $brand->name;
            $this->slug   = $brand->slug;
            $this->_meta  = new MetaForm($brand->meta);
            $this->_brand = $brand;
        }
        parent::__construct($config);
    }

    /**
     * @param array $data
     * @param null $formName
     * @return bool
     */
    public function load(array $data, $formName = null): bool
    {
        $self = parent::load($data, $formName);
        $meta = $this->_meta->load($data, $formName ? null : 'meta');
        return $self && $meta;
    }

    /**
     * @param null $attributeNames
     * @param bool $clearErrors
     * @return bool
     */
    public function validate($attributeNames = null, $clearErrors = true): bool
    {
        $self = parent::validate($attributeNames, $clearErrors);
        $meta = $this->_meta->validate($attributeNames, $clearErrors);
        return $self && $meta;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['slug'], 'match', 'pattern' => '#^[a-z0-9_-]*$#s'],
            [
                ['name', 'slug'],
                'unique',
                'targetClass' => Brand::class,
                'filter'      => $this->_brand ? ['<>', 'id', $this->_brand->id] : null
            ],
        ];
    }

    /**
     * @return MetaForm
     */
    public function getMeta(): MetaForm
    {
        return $this->_meta;
    }
}