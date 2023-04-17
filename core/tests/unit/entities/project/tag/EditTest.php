<?php


namespace core\tests\unit\entities\project\tag;


use Codeception\Test\Unit;
use core\entities\project\Tag;

class EditTest extends Unit
{
    public function testSuccess()
    {
        $tag = Tag::create($name = 'Name', $slug = 'slug');

        $tag->edit($name = 'New Name', $slug = 'new-slug');

        $this->assertEquals($name, $tag->name);
        $this->assertEquals($slug, $tag->slug);
    }
}