<?php


namespace core\tests\unit\entities\project\tag;


use Codeception\Test\Unit;
use core\entities\project\Tag;

class CreateTest extends Unit
{
    public function testSuccess()
    {
        $tag = Tag::create($name = 'Name', $slug = 'slug');

        $this->assertEquals($name, $tag->name);
        $this->assertEquals($slug, $tag->slug);
    }
}