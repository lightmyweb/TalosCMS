<?php

namespace MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="MediaBundle\Repository\ImageRepository")
 */
class Image
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
     * @var string
     *
     * @ORM\Column(name="src", type="string", length=255, nullable=true)
     */
    private $src;

            /**
     * @var string
     *
     * @ORM\Column(name="externa_link", type="string", length=255, nullable=true)
     */
    private $externaLink;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="width", type="string", length=255, nullable=true)
     */
    private $width;

    /**
     * @var string
     *
     * @ORM\Column(name="heigth", type="string", length=255, nullable=true)
     */
    private $heigth;

    /**
     * @ORM\OneToMany(targetEntity="\AdminBundle\Entity\Page", mappedBy="image")
     * @ORM\OrderBy({"position"="ASC"})
     */
    protected $pages;

    /**
     * @ORM\OneToMany(targetEntity="PageAndImageRelation", mappedBy="image", cascade={"persist", "remove"} , orphanRemoval=true)
     * @ORM\OrderBy({"orderPosition"="ASC"})
     */

    private $masnoryrelations;

    public function __toString(){
        return $this->getId().'';
    }


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
     * Set src
     *
     * @param string $src
     *
     * @return Image
     */
    public function setSrc($src)
    {
        if( $src == null ){
            $src = $this->getSrc();
        }
        $this->src = $src;
        return $this;
    }

    /**
     * Get src
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set externaLink
     *
     * @param string $externaLink
     *
     * @return Image
     */
    public function setExternaLink($externaLink)
    {
        $this->externaLink = $externaLink;

        return $this;
    }

    /**
     * Get externaLink
     *
     * @return string
     */
    public function getExternaLink()
    {
        return $this->externaLink;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set width
     *
     * @param string $width
     *
     * @return Image
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set heigth
     *
     * @param string $heigth
     *
     * @return Image
     */
    public function setHeigth($heigth)
    {
        $this->heigth = $heigth;

        return $this;
    }

    /**
     * Get heigth
     *
     * @return string
     */
    public function getHeigth()
    {
        return $this->heigth;
    }
/**
     * Constructor
     */
    public function __construct()
    {
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection;
    }

   /**
     * Add page
     *
     * @param \AdminBundle\Entity\Page $page
     *
     * @return Image
     */
    public function addPage(\AdminBundle\Entity\Page $page)
    {
        $page->setImage($this);
        $this->pages[] = $page;

        return $this;
    }

    /**
     * Remove page
     *
     * @param \AdminBundle\Entity\Page $page
     */
    public function removePage(\AdminBundle\Entity\Page $page)
    {
        $this->pages->removeElement($page);
    }

    /**
     * Get pages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPages()
    {
        return $this->pages;
    }
   
    /**
     * Add masnoryrelation
     *
     * @param \MediaBundle\Entity\PageAndImageRelation $masnoryrelation
     *
     * @return Image
     */
    public function addMasnoryrelation(\MediaBundle\Entity\PageAndImageRelation $masnoryrelation)
    {
        $masnoryrelation->setImage($this);
        $this->masnoryrelations[] = $masnoryrelation;

        return $this;
    }

    /**
     * Remove masnoryrelation
     *
     * @param \MediaBundle\Entity\PageAndImageRelation $masnoryrelation
     */
    public function removeMasnoryrelation(\MediaBundle\Entity\PageAndImageRelation $masnoryrelation)
    {
        $this->masnoryrelations->removeElement($masnoryrelation);
    }

    /**
     * Get masnoryrelations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMasnoryrelations()
    {
        return $this->masnoryrelations;
    }
}
