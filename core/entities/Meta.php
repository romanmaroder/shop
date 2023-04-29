<?php


namespace core\entities;


class Meta
{
    public string $title;
    public string $description;
    public string $keywords;

    /**
     * Meta constructor.
     * @param $title
     * @param $description
     * @param $keywords
     */
    public function __construct($title, $description, $keywords)
    {
        $this->title       = $title;
        $this->description = $description;
        $this->keywords    = $keywords;
    }
}