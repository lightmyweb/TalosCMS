<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * PressTranslation
 *
 * @ORM\Table(name="press_translation")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\PressTranslationRepository")
 */
class PressTranslation
{   
    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="abstract", type="text", nullable=true)
     */
    private $abstract;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255, nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $linkText;

    /**
     * @var string
     *
     * @ORM\Column(name="link_url", type="string", length=255, nullable=true)
     */
    private $linkUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf", type="string", length=255, nullable=true)
     */
    private $pdf;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return PressTranslation
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return PressTranslation
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set abstract
     *
     * @param string $abstract
     *
     * @return PressTranslation
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
    
        return $this;
    }

    /**
     * Get abstract
     *
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set date
     *
     * @param string $date
     *
     * @return PressTranslation
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
     * Set linkText
     *
     * @param string $linkText
     *
     * @return PressTranslation
     */
    public function setLinkText($linkText)
    {
        $this->linkText = $linkText;
    
        return $this;
    }

    /**
     * Get linkText
     *
     * @return string
     */
    public function getLinkText()
    {
        return $this->linkText;
    }

    /**
     * Set linkUrl
     *
     * @param string $linkUrl
     *
     * @return PressTranslation
     */
    public function setLinkUrl($linkUrl)
    {
        $this->linkUrl = $linkUrl;
    
        return $this;
    }

    /**
     * Get linkUrl
     *
     * @return string
     */
    public function getLinkUrl()
    {
        return $this->linkUrl;
    }

    public function __call($method, $arguments)
    {
        return \Symfony\Component\PropertyAccess\PropertyAccess::createPropertyAccessor()->getValue($this->translate(), $method);
    }

    /**
     * Set pdf
     *
     * @param string $pdf
     *
     * @return PressTranslation
     */
    public function setPdf($pdf)
    {   
        if( $pdf == null ){
            $pdf = $this->getPdf();
        }
        $this->pdf = $pdf;
    
        return $this;
    }

    /**
     * Get pdf
     *
     * @return string
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set pdfdelete
     *
     * @param string $pdfdelete
     *
     * @return PressTranslation
     */
    public function setPdfdelete($pdf)
    {
        $this->pdf = $pdf;
        return $this;
    }
}
