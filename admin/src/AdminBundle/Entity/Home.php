<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Home
 *
 * @ORM\Table(name="home")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\HomeRepository")
 */
class Home extends GeneralEntity
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="\MediaBundle\Entity\Image", inversedBy="homeAboutImage")
     * @ORM\JoinColumn(name="aboutImage", referencedColumnName="id")
     */
    private $aboutImage;


    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="home")
     * @ORM\OrderBy({"projectinhomeposition"="ASC"})
     */
    private $projects;


    public function __toString(){
        return $this->getTitle().'';
    }

    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    /**
     * Set aboutImage
     *
     * @param \MediaBundle\Entity\Image $aboutImage
     *
     * @return Home
     */
    public function setAboutImage(\MediaBundle\Entity\Image $aboutImage = null)
    {
        $this->aboutImage = $aboutImage;
    
        return $this;
    }

    /**
     * Get aboutImage
     *
     * @return \MediaBundle\Entity\Image
     */
    public function getAboutImage()
    {
        return $this->aboutImage;
    }

    /**
     * Add project
     *
     * @param \AdminBundle\Entity\Project $project
     *
     * @return Home
     */
    public function addProject(\AdminBundle\Entity\Project $project)
    {
        $project->setHome($this);
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
}
