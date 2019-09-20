<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * ProjectTranslation
 *
 * @ORM\Table(name="project_translation")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\ProjectTranslationRepository")
 */
class ProjectTranslation
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
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="program", type="string", length=255, nullable=true)
     */
    private $program;

    /**
     * @var string
     *
     * @ORM\Column(name="area", type="string", length=255, nullable=true)
     */
    private $area;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255, nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="photographer", type="string", length=255, nullable=true)
     */
    private $photographer;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptiontitle", type="string", length=255, nullable=true)
     */
    private $descriptiontitle;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionintro", type="text", nullable=true)
     */
    private $descriptionintro;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptioncontent", type="text", nullable=true)
     */
    private $descriptioncontent;

    public function __call($method, $arguments)
    {
        return \Symfony\Component\PropertyAccess\PropertyAccess::createPropertyAccessor()->getValue($this->translate(), $method);
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return ProjectTranslation
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
     * Set slug
     *
     * @param string $slug
     *
     * @return ProjectTranslation
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ProjectTranslation
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


    /**
     * Set program
     *
     * @param string $program
     *
     * @return ProjectTranslation
     */
    public function setProgram($program)
    {
        $this->program = $program;
    
        return $this;
    }

    /**
     * Get program
     *
     * @return string
     */
    public function getProgram()
    {
        return $this->program;
    }

    /**
     * Set area
     *
     * @param string $area
     *
     * @return ProjectTranslation
     */
    public function setArea($area)
    {
        $this->area = $area;
    
        return $this;
    }

    /**
     * Get area
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set date
     *
     * @param string $date
     *
     * @return ProjectTranslation
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set photographer
     *
     * @param string $photographer
     *
     * @return ProjectTranslation
     */
    public function setPhotographer($photographer)
    {
        $this->photographer = $photographer;
    
        return $this;
    }

    /**
     * Get photographer
     *
     * @return string
     */
    public function getPhotographer()
    {
        return $this->photographer;
    }

    /**
     * Set descriptiontitle
     *
     * @param string $descriptiontitle
     *
     * @return ProjectTranslation
     */
    public function setDescriptiontitle($descriptiontitle)
    {
        $this->descriptiontitle = $descriptiontitle;
    
        return $this;
    }

    /**
     * Get descriptiontitle
     *
     * @return string
     */
    public function getDescriptiontitle()
    {
        return $this->descriptiontitle;
    }

    /**
     * Set descriptionintro
     *
     * @param string $descriptionintro
     *
     * @return ProjectTranslation
     */
    public function setDescriptionintro($descriptionintro)
    {
        $this->descriptionintro = $descriptionintro;
    
        return $this;
    }

    /**
     * Get descriptionintro
     *
     * @return string
     */
    public function getDescriptionintro()
    {
        return $this->descriptionintro;
    }

    /**
     * Set descriptioncontent
     *
     * @param string $descriptioncontent
     *
     * @return ProjectTranslation
     */
    public function setDescriptioncontent($descriptioncontent)
    {
        $this->descriptioncontent = $descriptioncontent;
    
        return $this;
    }

    /**
     * Get descriptioncontent
     *
     * @return string
     */
    public function getDescriptioncontent()
    {
        return $this->descriptioncontent;
    }
}
