<?php

namespace ContentElementsManagementSystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * BlocImage
 *
 * @ORM\Table(name="bloc_image")
 * @ORM\Entity(repositoryClass="ContentElementsManagementSystemBundle\Repository\BlocImageRepository")
 */
class BlocImage extends Bloc
{   
    /**
     * @ORM\ManyToOne(targetEntity="\MediaBundle\Entity\Image", inversedBy="blocimagethumbnail")
     * @ORM\JoinColumn(name="image", referencedColumnName="id")
     */
    private $thumbnail; 

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
     * Set thumbnail
     *
     * @param \MediaBundle\Entity\Image $thumbnail
     *
     * @return BlocImage
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
}
