<?php


namespace core\repositories\project;


use core\entities\project\Tag;
use core\repositories\NotFoundException;
use RuntimeException;
use yii\db\StaleObjectException;

class TagRepository
{
    /**
     * Find tag
     * @param $id
     * @return Tag
     */
    public function get($id): Tag
    {
        if (!$tag = Tag::findOne($id)) {
            throw new NotFoundException('Tag is not found.');
        }
        return $tag;
    }

    /**
     * Saving tag
     * @param Tag $tag
     */
    public function save(Tag $tag): void
    {
        if (!$tag->save()) {
            throw new RuntimeException('Saving error.');
        }
    }

    /**
     * Removing tag
     * @param Tag $tag
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function remove(Tag $tag): void
    {
        if (!$tag->delete()) {
            throw new RuntimeException('Removing error');
        }
    }
}