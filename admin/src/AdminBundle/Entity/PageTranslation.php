<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * PageTranslation
 *
 * @ORM\Table(name="page_translation")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\PageTranslationRepository")
 */
class PageTranslation
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
     * @ORM\Column(name="title1", type="string", length=255, nullable=true)
     */
    private $title1;

    /**
     * @var string
     *
     * @ORM\Column(name="title2", type="string", length=255, nullable=true)
     */
    private $title2;

    /**
     * @var string
     *
     * @ORM\Column(name="email1", type="string", length=255, nullable=true)
     */
    private $email1;

    /**
     * @var string
     *
     * @ORM\Column(name="email2", type="string", length=255, nullable=true)
     */
    private $email2;

    /**
     * @var string
     *
     * @ORM\Column(name="classiceditor", type="text", nullable=true)
     */
    private $classiceditor;

    public function __call($method, $arguments)
    {
        return \Symfony\Component\PropertyAccess\PropertyAccess::createPropertyAccessor()->getValue($this->translate(), $method);
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return PageTranslation
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
     * @return PageTranslation
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
     * Set title1
     *
     * @param string $title1
     *
     * @return PageTranslation
     */
    public function setTitle1($title1)
    {
        $this->title1 = $title1;
    
        return $this;
    }

    /**
     * Get title1
     *
     * @return string
     */
    public function getTitle1()
    {
        return $this->title1;
    }

    /**
     * Set title2
     *
     * @param string $title2
     *
     * @return PageTranslation
     */
    public function setTitle2($title2)
    {
        $this->title2 = $title2;
    
        return $this;
    }

    /**
     * Get title2
     *
     * @return string
     */
    public function getTitle2()
    {
        return $this->title2;
    }

    /**
     * Set classiceditor
     *
     * @param string $classiceditor
     *
     * @return PageTranslation
     */
    public function setClassiceditor($classiceditor)
    {
        $this->classiceditor = $classiceditor;
    
        return $this;
    }

    /**
     * Get classiceditor
     *
     * @return string
     */
    public function getClassiceditor()
    {
        return $this->classiceditor;
    }

    /**
     * Set email1
     *
     * @param string $email1
     *
     * @return PageTranslation
     */
    public function setEmail1($email1)
    {
        $this->email1 = $email1;
    
        return $this;
    }

    /**
     * Get email1
     *
     * @return string
     */
    public function getEmail1()
    {
        return $this->email1;
    }

    /**
     * Set email2
     *
     * @param string $email2
     *
     * @return PageTranslation
     */
    public function setEmail2($email2)
    {
        $this->email2 = $email2;
    
        return $this;
    }

    /**
     * Get email2
     *
     * @return string
     */
    public function getEmail2()
    {
        return $this->email2;
    }
}
