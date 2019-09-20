<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\LocationRepository")
 */
class Location extends GeneralEntity
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="location")
     * @ORM\OrderBy({"position"="ASC"})
     */
    protected $projects;

    public function __toString(){
        return $this->getCity().'';
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
     * @return Location
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
}
