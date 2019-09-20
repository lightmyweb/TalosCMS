<?php

namespace ContentElementsManagementSystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * BlocGallery
 *
 * @ORM\Table(name="bloc_gallery")
 * @ORM\Entity(repositoryClass="ContentElementsManagementSystemBundle\Repository\BlocGalleryRepository")
 */
class BlocGallery extends Bloc
{   
    /**
     * @ORM\ManyToOne(targetEntity="\MediaBundle\Entity\Image", inversedBy="blocgallerythumbnail")
     * @ORM\JoinColumn(name="image", referencedColumnName="id")
     */
    private $thumbnail;

    /**
     * @ORM\OneToMany(targetEntity="BlocGalleryimage", mappedBy="galleryimage", cascade={"persist", "remove"}, orphanRemoval=true)
     * 
     * @ORM\OrderBy({"position"="ASC"})
     */

    private $galleryimages; 

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->galleryimages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set thumbnail
     *
     * @param \MediaBundle\Entity\Image $thumbnail
     *
     * @return BlocGallery
     */
    public function setThumbnail(\MediaBundle\Entity\Image $thumbnail = null)
    {
        $this->thumbnail = $thumbnail;
    
        return $this;
    }

    /**
     * Get thumbnail
     *
     * @return \MediaBundle\Entity\Image
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Add galleryimage
     *
     * @param \ContentElementsManagementSystemBundle\Entity\BlocGalleryimage $galleryimage
     *
     * @return BlocGallery
     */
    public function addGalleryimage(\ContentElementsManagementSystemBundle\Entity\BlocGalleryimage $galleryimage)
    {   
        $galleryimage->setGalleryimage($this);
        $this->galleryimages[] = $galleryimage;
    
        return $this;
    }

    /**
     * Remove galleryimage
     *
     * @param \ContentElementsManagementSystemBundle\Entity\BlocGalleryimage $galleryimage
     */
    public function removeGalleryimage(\ContentElementsManagementSystemBundle\Entity\BlocGalleryimage $galleryimage)
    {
        $this->galleryimages->removeElement($galleryimage);
    }

    /**
     * Get galleryimages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGalleryimages()
    {
        return $this->galleryimages;
    }
}
