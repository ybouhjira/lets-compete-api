<?php
namespace AppBundle\Rest;

/**
 * Represents a list of sub resources (like: albums/{id}/photos)
 * return it from an action/controller to get a paginated list.
 * @package AppBundle\Rest
 */
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

    /**
     * SubResourcesList constructor.
     * @param string $subResourceClass The class name of the sub resource
     * @param string $associationName The name of the doctrine association that
     *   references the parent resource.
     * @param Object $parent the parent model object
     */
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