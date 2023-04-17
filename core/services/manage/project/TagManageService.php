<?php


namespace core\services\manage\project;


use core\entities\project\Tag;
use core\forms\manage\project\TagForm;
use core\repositories\project\TagRepository;

class TagManageService
{
    private TagRepository $tags;

    /**
     * TagManageService constructor.
     * @param $tags
     */
    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

    /**
     * Create tag
     * @param TagForm $form
     * @return Tag
     */
    public function create(TagForm $form): Tag
    {
        $tag = Tag::create($form->name, $form->slug);
        $this->tags->save($tag);
        return $tag;
    }

    /**
     * Edit tag
     * @param $id
     * @param TagForm $form
     */
    public function edit($id, TagForm $form): void
    {
        $tag = $this->tags->get($id);
        $tag->edit($form->name, $form->slug);
        $this->tags->save($tag);
    }

    /**
     * Remove tag
     * @param $id
     */
    public function remove($id): void
    {
        $tag = $this->tags->get($id);
        $this->tags->remove($tag);
    }

}