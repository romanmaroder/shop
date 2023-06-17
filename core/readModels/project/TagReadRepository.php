<?php


namespace core\readModels\project;


use core\entities\project\Tag;

class TagReadRepository
{
    public function find($id): ?Tag
    {
        return Tag::findOne($id);
    }
}