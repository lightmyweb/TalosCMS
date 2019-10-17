<?php

namespace CoreSystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Seo
 *
 * @ORM\Table(name="seo")
 * @ORM\Entity(repositoryClass="CoreSystemBundle\Repository\SeoRepository")
 */
class Seo
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
     * @ORM\OneToMany(targetEntity="GeneralEntity", mappedBy="seo")
     */
    private $entity;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entity = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add entity
     *
     * @param \CoreSystemBundle\Entity\GeneralEntity $entity
     *
     * @return Seo
     */
    public function addEntity(\CoreSystemBundle\Entity\GeneralEntity $entity)
    {
        $this->entity[] = $entity;

        return $this;
    }

    /**
     * Remove entity
     *
     * @param \CoreSystemBundle\Entity\GeneralEntity $entity
     */
    public function removeEntity(\CoreSystemBundle\Entity\GeneralEntity $entity)
    {
        $this->entity->removeElement($entity);
    }

    /**
     * Get entity
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
