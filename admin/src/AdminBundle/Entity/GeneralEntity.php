<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Entity
 *
 * @ORM\Table(name="generalentity")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\GeneralEntityRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="entity_type", type="string")
 * @ORM\DiscriminatorMap({
    "helpEntity"="Help",
    "pageEntity" = "Page",
    "generalEntity" = "GeneralEntity"
})
 */
class GeneralEntity 
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
     * @ORM\Column(name="state", type="integer", nullable=true)
     */
    protected $state = 1;

        /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

        /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="entities", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id_user")
     */

    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="entitiesUser", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id_update", referencedColumnName="id_user")
     */

    protected $updateuser;  


    /**
     * @ORM\ManyToOne(targetEntity="Seo", inversedBy="entity", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="seo_id", referencedColumnName="id")
     */

    protected $seo;

    /**
     * @ORM\OneToMany(targetEntity="\ContentElementsManagementSystemBundle\Entity\Bloc", mappedBy="entity_withBlocText", cascade={"persist", "remove"}, orphanRemoval=true)
     * 
     * @ORM\OrderBy({"position"="ASC"})
     */

    private $blocTexts; 

    /**
     * @ORM\OneToMany(targetEntity="\ContentElementsManagementSystemBundle\Entity\Bloc", mappedBy="entity_withBlocSection", cascade={"persist", "remove"}, orphanRemoval=true)
     * 
     * @ORM\OrderBy({"position"="ASC"})
     */

    private $blocSections; 


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->blocTexts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->blocSections = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Page
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Page
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Gets triggered only on insert

     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new \DateTime("now");
    }

    /**
     * Gets triggered every time on update

     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime("now");
    }

    /**
     * Set user
     *
     * @param \AdminBundle\Entity\User $user
     *
     * @return GeneralEntity
     */
    public function setUser(\AdminBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return \AdminBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set seo
     *
     * @param \AdminBundle\Entity\Seo $seo
     *
     * @return GeneralEntity
     */
    public function setSeo(\AdminBundle\Entity\Seo $seo = null)
    {
        $this->seo = $seo;

        return $this;
    }

    /**
     * Get seo
     *
     * @return \AdminBundle\Entity\Seo
     */
    public function getSeo()
    {
        return $this->seo;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return GeneralEntity
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set state
     *
     * @param integer $state
     *
     * @return GeneralEntity
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }
    
    /**
     * Add blocText
     *
     * @param \ContentElementsManagementSystemBundle\Entity\Bloc $blocText
     *
     * @return GeneralEntity
     */
    public function addBlocText(\ContentElementsManagementSystemBundle\Entity\Bloc $blocText)
    {
        $blocText->setEntityWithBlocText($this);
        $this->blocTexts[] = $blocText;

        return $this;
    }

    /**
     * Remove blocText
     *
     * @param \ContentElementsManagementSystemBundle\Entity\Bloc $blocText
     */
    public function removeBlocText(\ContentElementsManagementSystemBundle\Entity\Bloc $blocText)
    {
        $this->blocTexts->removeElement($blocText);
    }

    /**
     * Get blocTexts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlocTexts()
    {
        return $this->blocTexts;
    }

    /**
     * Add blocSection
     *
     * @param \ContentElementsManagementSystemBundle\Entity\Bloc $blocSection
     *
     * @return GeneralEntity
     */
    public function addBlocSection(\ContentElementsManagementSystemBundle\Entity\Bloc $blocSection)
    {
        $blocSection->setEntityWithBlocSection($this);
        $this->blocSections[] = $blocSection;

        return $this;
    }

    /**
     * Remove blocSection
     *
     * @param \ContentElementsManagementSystemBundle\Entity\Bloc $blocSection
     */
    public function removeBlocSection(\ContentElementsManagementSystemBundle\Entity\Bloc $blocSection)
    {
        $this->blocSections->removeElement($blocSection);
    }

    /**
     * Get blocSections
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlocSections()
    {
        return $this->blocSections;
    }

    /**
     * Set updateuser
     *
     * @param \AdminBundle\Entity\User $updateuser
     *
     * @return GeneralEntity
     */
    public function setUpdateuser(\AdminBundle\Entity\User $updateuser = null)
    {
        $this->updateuser = $updateuser;

        return $this;
    }

    /**
     * Get updateuser
     *
     * @return \AdminBundle\Entity\User
     */
    public function getUpdateuser()
    {
        return $this->updateuser;
    }
}
