<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 9/14/14
 * Time: 3:09 PM
 */

class Text {
    private $id;
    private $title;
    private $short_text;
    private $text;
    private $meta_tag;
    private $category;
    private $link;

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMetaTag()
    {
        return $this->meta_tag;
    }

    /**
     * @param mixed $meta_tag
     */
    public function setMetaTag($meta_tag)
    {
        $this->meta_tag = $meta_tag;
    }

    /**
     * @return mixed
     */
    public function getShortText()
    {
        return $this->short_text;
    }

    /**
     * @param mixed $short_text
     */
    public function setShortText($short_text)
    {
        $this->short_text = $short_text;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
} 