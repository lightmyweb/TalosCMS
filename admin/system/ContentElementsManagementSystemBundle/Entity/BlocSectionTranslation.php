<?php

namespace ContentElementsManagementSystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * BlocSectionTranslation
 *
 * @ORM\Table(name="bloc_section_translation")
 * @ORM\Entity(repositoryClass="ContentElementsManagementSystemBundle\Repository\BlocSectionTranslationRepository")
 */
class BlocSectionTranslation
{
    use ORMBehaviors\Translatable\Translation;

        /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

     /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


    public function __call($method, $arguments)
    {
        return \Symfony\Component\PropertyAccess\PropertyAccess::createPropertyAccessor()->getValue($this->translate(), $method);
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return BlocSection
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return BlocSectionTranslation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
