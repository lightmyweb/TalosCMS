<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\ClientRepository")
 */
class Client extends GeneralEntity
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="\MediaBundle\Entity\Image", inversedBy="logoclient")
     * @ORM\JoinColumn(name="clientlogo", referencedColumnName="id")
    */
    private $clientlogo;

    /**
     * @ORM\ManyToOne(targetEntity="\MediaBundle\Entity\Image", inversedBy="thumbnailclient")
     * @ORM\JoinColumn(name="clientthumbnail", referencedColumnName="id")
    */
    private $clientthumbnail;

    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="client")
     * @ORM\OrderBy({"position"="ASC"})
     */
    protected $projects;

    /**
     * @var int
     *
     * @ORM\Column(name="projectPosition", type="integer", nullable=true)
     */
    private $clientPosition = 999;

    /**
     * Set clientlogo
     *
     * @param \MediaBundle\Entity\Image $clientlogo
     *
     * @return Client
    */
    public function setClientlogo(\MediaBundle\Entity\Image $clientlogo = null)
    {
        $this->clientlogo = $clientlogo;
    
        return $this;
    }

    /**
     * Get clientlogo
     *
     * @return \MediaBundle\Entity\Image
    */
    public function getClientlogo()
    {
        return $this->clientlogo;
    }

    public function __toString(){
        return $this->getName().'';
    }
    
    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }

    /**
     * Set clientthumbnail
     *
     * @param \MediaBundle\Entity\Image $clientthumbnail
     *
     * @return Client
     */
    public function setClientthumbnail(\MediaBundle\Entity\Image $clientthumbnail = null)
    {
        $this->clientthumbnail = $clientthumbnail;
    
        return $this;
    }

    /**
     * Get clientthumbnail
     *
     * @return \MediaBundle\Entity\Image
     */
    public function getClientthumbnail()
    {
        return $this->clientthumbnail;
    }

    /**
     * Add project
     *
     * @param \AdminBundle\Entity\Project $project
     *
     * @return Client
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
     * Set clientPosition
     *
     * @param integer $clientPosition
     *
     * @return Client
     */
    public function setClientPosition($clientPosition)
    {
        $this->clientPosition = $clientPosition;
    
        return $this;
    }

    /**
     * Get clientPosition
     *
     * @return integer
     */
    public function getClientPosition()
    {
        return $this->clientPosition;
    }
}
