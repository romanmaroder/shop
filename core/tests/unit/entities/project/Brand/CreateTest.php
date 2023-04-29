<?php


namespace core\tests\unit\entities\project\Brand;


use Codeception\Test\Unit;
use core\entities\Meta;
use core\entities\project\Brand;

class CreateTest extends Unit
{
    public function testSuccess()
    {
        $brand = Brand::create($name = 'Name',
                               $slug = 'slug',
                               $meta = new Meta('Title', 'Description', 'Keywords')
        );

        $this->assertEquals($name, $brand->name);
        $this->assertEquals($slug, $brand->slug);
        $this->assertEquals($meta, $brand->meta);
    }
}