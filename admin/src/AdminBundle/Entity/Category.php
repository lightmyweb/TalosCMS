<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\CategoryRepository")
 */
class Category extends GeneralEntity
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="category")
     * @ORM\OrderBy({"position"="ASC"})
     */
    protected $projects;

    /**
     * @var int
     *
     * @ORM\Column(name="categoryPosition", type="integer", nullable=true)
     */
    private $categoryPosition = 999;

    public function __construct() {
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString(){
        return $this->getName();
    }

    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }

    /**
     * Add project
     *
     * @param \AdminBundle\Entity\Project $project
     *
     * @return Category
     */
    public function addProject(\AdminBundle\Entity\Project $project)
    {
        $this->projects[] = $project;
    
        return $this;
    }

    /**
     * Remove project
     *
     * @param \AdminBundle\Entity\Project $project
     */
    public function removeProject(\AdminBundle\Entity\Project $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Set categoryPosition
     *
     * @param integer $categoryPosition
     *
     * @return Category
     */
    public function setCategoryPosition($categoryPosition)
    {
        $this->categoryPosition = $categoryPosition;
    
        return $this;
    }

    /**
     * Get categoryPosition
     *
     * @return integer
     */
    public function getCategoryPosition()
    {
        return $this->categoryPosition;
    }
}
