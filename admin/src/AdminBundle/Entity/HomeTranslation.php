<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * HomeTranslation
 *
 * @ORM\Table(name="home_translation")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\HomeTranslationRepository")
 */
class HomeTranslation
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

    /**
     * @var string
     *
     * @ORM\Column(name="about_title", type="string", length=255, nullable=true)
     */
    private $aboutTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="about_subtitle", type="string", length=255, nullable=true)
     */
    private $aboutSubtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="about_intro", type="text", nullable=true)
     */
    private $aboutIntro;

    /**
     * @var string
     *
     * @ORM\Column(name="about_text", type="text", nullable=true)
     */
    private $aboutText;

    /**
     * @var string
     *
     * @ORM\Column(name="about_caption", type="string", length=255, nullable=true)
     */
    private $aboutCaption;

    /**
     * @var string
     *
     * @ORM\Column(name="about_quote", type="text", nullable=true)
     */
    private $aboutQuote;


    /**
     * Set title
     *
     * @param string $title
     *
     * @return HomeTranslation
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
     * @return HomeTranslation
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
     * Set aboutTitle
     *
     * @param string $aboutTitle
     *
     * @return HomeTranslation
     */
    public function setAboutTitle($aboutTitle)
    {
        $this->aboutTitle = $aboutTitle;
    
        return $this;
    }

    /**
     * Get aboutTitle
     *
     * @return string
     */
    public function getAboutTitle()
    {
        return $this->aboutTitle;
    }

    /**
     * Set aboutSubtitle
     *
     * @param string $aboutSubtitle
     *
     * @return HomeTranslation
     */
    public function setAboutSubtitle($aboutSubtitle)
    {
        $this->aboutSubtitle = $aboutSubtitle;
    
        return $this;
    }

    /**
     * Get aboutSubtitle
     *
     * @return string
     */
    public function getAboutSubtitle()
    {
        return $this->aboutSubtitle;
    }

    /**
     * Set aboutIntro
     *
     * @param string $aboutIntro
     *
     * @return HomeTranslation
     */
    public function setAboutIntro($aboutIntro)
    {
        $this->aboutIntro = $aboutIntro;
    
        return $this;
    }

    /**
     * Get aboutIntro
     *
     * @return string
     */
    public function getAboutIntro()
    {
        return $this->aboutIntro;
    }

    /**
     * Set aboutText
     *
     * @param string $aboutText
     *
     * @return HomeTranslation
     */
    public function setAboutText($aboutText)
    {
        $this->aboutText = $aboutText;
    
        return $this;
    }

    /**
     * Get aboutText
     *
     * @return string
     */
    public function getAboutText()
    {
        return $this->aboutText;
    }

    /**
     * Set aboutCaption
     *
     * @param string $aboutCaption
     *
     * @return HomeTranslation
     */
    public function setAboutCaption($aboutCaption)
    {
        $this->aboutCaption = $aboutCaption;
    
        return $this;
    }

    /**
     * Get aboutCaption
     *
     * @return string
     */
    public function getAboutCaption()
    {
        return $this->aboutCaption;
    }

    /**
     * Set aboutQuote
     *
     * @param string $aboutQuote
     *
     * @return HomeTranslation
     */
    public function setAboutQuote($aboutQuote)
    {
        $this->aboutQuote = $aboutQuote;
    
        return $this;
    }

    /**
     * Get aboutQuote
     *
     * @return string
     */
    public function getAboutQuote()
    {
        return $this->aboutQuote;
    }

    public function __call($method, $arguments)
    {
        return \Symfony\Component\PropertyAccess\PropertyAccess::createPropertyAccessor()->getValue($this->translate(), $method);
    }
}
