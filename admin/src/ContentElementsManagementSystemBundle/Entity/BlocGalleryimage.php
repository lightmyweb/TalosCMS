<?php

namespace ContentElementsManagementSystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * BlocGalleryimage
 *
 * @ORM\Table(name="bloc_galleryimage")
 * @ORM\Entity(repositoryClass="ContentElementsManagementSystemBundle\Repository\BlocGalleryimageRepository")
 */
class BlocGalleryimage extends Bloc
{

    /**
     * @ORM\ManyToOne(targetEntity="BlocGallery", inversedBy="galleryimages" )
     * 
     */
    private $galleryimage;

    /**
     * @ORM\ManyToOne(targetEntity="\MediaBundle\Entity\Image", inversedBy="galleryfigures")
     * @ORM\JoinColumn(name="figure", referencedColumnName="id")
     */
    private $figure;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return integer
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
        // $this->galleryimage = new \Doctrine\Common\Collections\ArrayCollection();
    }

   

    /**
     * Set galleryimage
     *
     * @param \ContentElementsManagementSystemBundle\Entity\BlocGallery $galleryimage
     *
     * @return BlocGalleryimage
     */
    public function setGalleryimage(\ContentElementsManagementSystemBundle\Entity\BlocGallery $galleryimage = null)
    {
        $this->galleryimage = $galleryimage;
    
        return $this;
    }

    /**
     * Get galleryimage
     *
     * @return \ContentElementsManagementSystemBundle\Entity\BlocGallery
     */
    public function getGalleryimage()
    {
        return $this->galleryimage;
    }

    /**
     * Set figure
     *
     * @param \MediaBundle\Entity\Image $figure
     *
     * @return BlocGalleryimage
     */
    public function setFigure(\MediaBundle\Entity\Image $figure = null)
    {
        $this->figure = $figure;
    
        return $this;
    }

    /**
     * Get figure
     *
     * @return \MediaBundle\Entity\Image
     */
    public function getFigure()
    {
        return $this->figure;
    }
}
