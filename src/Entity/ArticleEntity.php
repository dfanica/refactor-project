<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Entity;

class ArticleEntity
{
    const ARTICLE_TYPE_POST = 'post';

    private $id;
    private $title;
    private $excerpt;
    private $content;
    private $tags;
    private $image;

    public function setId($id): self
    {
        $this->id = intval($id);
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setExcerpt($excerpt): self
    {
        $this->excerpt = $excerpt;
        return $this;
    }

    public function getExcerpt()
    {
        return $this->excerpt;
    }

    public function setContent($content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setTags(array $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setImage($image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }
}
