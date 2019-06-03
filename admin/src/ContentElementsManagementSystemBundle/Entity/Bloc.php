<?php

namespace ContentElementsManagementSystemBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Bloc
 *
 * @ORM\Table(name="bloc")
 * @ORM\Entity(repositoryClass="ContentElementsManagementSystemBundle\Repository\BlocRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="entity_type", type="string")
 * @ORM\DiscriminatorMap({"bloctext" = "BlocText","blocsection" = "BlocSection","bloc" = "Bloc"})
 */
 
class Bloc 
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
     * @var int
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="\AdminBundle\Entity\GeneralEntity", inversedBy="blocTexts" )
     * @ORM\JoinColumn(name="entity_id_withBlocTexts", referencedColumnName="id") 
     */
    private $entity_withBlocText;

    /**
     * @ORM\ManyToOne(targetEntity="\AdminBundle\Entity\GeneralEntity", inversedBy="blocSections" )
     * @ORM\JoinColumn(name="entity_id_withBlocSections", referencedColumnName="id") 
     */
    private $entity_withBlocSection;

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
     * Set position
     *
     * @param integer $position
     *
     * @return Bloc
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }


    /**
     * Set entityWithBlocText
     *
     * @param \AdminBundle\Entity\GeneralEntity $entityWithBlocText
     *
     * @return Bloc
     */
    public function setEntityWithBlocText(\AdminBundle\Entity\GeneralEntity $entityWithBlocText = null)
    {
        $this->entity_withBlocText = $entityWithBlocText;

        return $this;
    }

    /**
     * Get entityWithBlocText
     *
     * @return \AdminBundle\Entity\GeneralEntity
     */
    public function getEntityWithBlocText()
    {
        return $this->entity_withBlocText;
    }

    /**
     * Set entityWithBlocSection
     *
     * @param \AdminBundle\Entity\GeneralEntity $entityWithBlocSection
     *
     * @return Bloc
     */
    public function setEntityWithBlocSection(\AdminBundle\Entity\GeneralEntity $entityWithBlocSection = null)
    {
        $this->entity_withBlocSection = $entityWithBlocSection;

        return $this;
    }

    /**
     * Get entityWithBlocSection
     *
     * @return \AdminBundle\Entity\GeneralEntity
     */
    public function getEntityWithBlocSection()
    {
        return $this->entity_withBlocSection;
    }
}
