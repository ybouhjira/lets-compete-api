<?php
namespace AppBundle\Rest;

class SubResourcesList
{
    /**
     * @var string
     */
    private $subResourceClass;

    /**
     * @var string
     */
    private $associationName;

    /**
     * @var object
     */
    private $parent;

    public function __construct(string $subResourceClass,
                                string $associationName,
                                $parent)
    {
        $this->subResourceClass = $subResourceClass;
        $this->associationName = $associationName;
        $this->parent = $parent;
    }

    /**
     * @return string
     */
    public function getSubResourceClass()
    {
        return $this->subResourceClass;
    }

    /**
     * @param string $subResourceClass
     */
    public function setSubResourceClass(string $subResourceClass)
    {
        $this->subResourceClass = $subResourceClass;
    }

    /**
     * @return object
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param object $parent
     */
    public function setParent(object $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return string
     */
    public function getAssociationName()
    {
        return $this->associationName;
    }

    /**
     * @param string $associationName
     */
    public function setAssociationName(string $associationName)
    {
        $this->associationName = $associationName;
    }
}