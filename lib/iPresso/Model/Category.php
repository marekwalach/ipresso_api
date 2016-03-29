<?php

namespace iPresso\Model;

class Category
{
    const VAR_NAME = 'name';
    const VAR_PARENT_ID = 'parentId';

    public $category = [];

    /**
     * Parameter `CATEGORY_NAME` should be replaced with the name of added category.
     * @var string
     */
    private $name = '';

    /**
     * Parameter `PARENT_CATEGORY_ID` should be replaced with ID of parent category.
     * Not required
     * @var int
     */
    private $parent_id = 0;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param int $parent_id
     * @return Category
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
        return $this;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getCategory()
    {
        if (empty($this->name))
            throw new \Exception('Set category name first.');

        $this->category[self::VAR_NAME] = $this->name;

        if (!empty($this->parent_id))
            $this->category[self::VAR_PARENT_ID] = $this->parent_id;

        return $this->category;
    }
}
