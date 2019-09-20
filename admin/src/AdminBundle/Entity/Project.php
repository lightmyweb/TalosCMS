<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\ProjectRepository")
 */
class Project extends GeneralEntity
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="\MediaBundle\Entity\Image", inversedBy="projects")
     * @ORM\JoinColumn(name="image", referencedColumnName="id")
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="projects")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="Client", inversedBy="projects")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    private $client;

    /**
     * @ORM\ManyToMany(targetEntity="Location", inversedBy="projects")
     * @ORM\JoinColumn(name="location", referencedColumnName="id")
     */
    private $location;

    /**
     * @var int
     *
     * @ORM\Column(name="projectPosition", type="integer", nullable=true)
     */
    private $projectPosition = 999; 

    /**
     * @var int
     *
     * @ORM\Column(name="projectPositionHome", type="integer", nullable=true)
     */
    private $projectinhomeposition = 999;

    /**
     * @ORM\ManyToOne(targetEntity="Home", inversedBy="projects")
     * @ORM\JoinColumn(name="home_id", referencedColumnName="id")
     */
    private $home;


    public function __toString(){
        return $this->getTitle().'';
    }
    
    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }

    /**
     * Set image
     *
     * @param \MediaBundle\Entity\Image $image
     *
     * @return Project
     */
    public function setImage(\MediaBundle\Entity\Image $image = null)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return \MediaBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add category
     *
     * @param \AdminBundle\Entity\Category $category
     *
     * @return Project
     */
    public function addCategory(\AdminBundle\Entity\Category $category)
    {
        $this->category[] = $category;
    
        return $this;
    }

    /**
     * Remove category
     *
     * @param \AdminBundle\Entity\Category $category
     */
    public function removeCategory(\AdminBundle\Entity\Category $category)
    {
        $this->category->removeElement($category);
    }

    /**
     * Get category
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add client
     *
     * @param \AdminBundle\Entity\Client $client
     *
     * @return Project
     */
    public function addClient(\AdminBundle\Entity\Client $client)
    {
        $this->client[] = $client;
    
        return $this;
    }

    /**
     * Remove client
     *
     * @param \AdminBundle\Entity\Client $client
     */
    public function removeClient(\AdminBundle\Entity\Client $client)
    {
        $this->client->removeElement($client);
    }

    /**
     * Get client
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add location
     *
     * @param \AdminBundle\Entity\Location $location
     *
     * @return Project
     */
    public function addLocation(\AdminBundle\Entity\Location $location)
    {
        $this->location[] = $location;
    
        return $this;
    }

    /**
     * Remove location
     *
     * @param \AdminBundle\Entity\Location $location
     */
    public function removeLocation(\AdminBundle\Entity\Location $location)
    {
        $this->location->removeElement($location);
    }

    /**
     * Get location
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set projectPosition
     *
     * @param integer $projectPosition
     *
     * @return Project
     */
    public function setProjectPosition($projectPosition)
    {
        $this->projectPosition = $projectPosition;
    
        return $this;
    }

    /**
     * Get projectPosition
     *
     * @return integer
     */
    public function getProjectPosition()
    {
        return $this->projectPosition;
    }

    /**
     * Set projectinhomeposition
     *
     * @param integer $projectinhomeposition
     *
     * @return Project
     */
    public function setProjectinhomeposition($projectinhomeposition)
    {
        $this->projectinhomeposition = $projectinhomeposition;
    
        return $this;
    }

    /**
     * Get projectinhomeposition
     *
     * @return integer
     */
    public function getProjectinhomeposition()
    {
        return $this->projectinhomeposition;
    }

    /**
     * Set home
     *
     * @param \AdminBundle\Entity\Home $home
     *
     * @return Project
     */
    public function setHome(\AdminBundle\Entity\Home $home = null)
    {
        $this->home = $home;

        return $this;
    }

    /**
     * Get home
     *
     * @return \AdminBundle\Entity\Home
     */
    public function getHome()
    {
        return $this->home;
    }
}
