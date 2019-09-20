<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Press
 *
 * @ORM\Table(name="press")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\PressRepository")
 */
class Press extends GeneralEntity
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="\MediaBundle\Entity\Image", inversedBy="pressthumbnail")
     * @ORM\JoinColumn(name="image", referencedColumnName="id")
     */
    private $thumbnail;

    /**
     * @var int
     *
     * @ORM\Column(name="pressPosition", type="integer", nullable=true)
     */
    private $pressPosition = 999;

    public function __toString(){
        return $this->getName().'';
    }
    
    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }

    /**
     * Set thumbnail
     *
     * @param \MediaBundle\Entity\Image $thumbnail
     *
     * @return Press
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
     * Set pressPosition
     *
     * @param integer $pressPosition
     *
     * @return Press
     */
    public function setPressPosition($pressPosition)
    {
        $this->pressPosition = $pressPosition;
    
        return $this;
    }

    /**
     * Get pressPosition
     *
     * @return integer
     */
    public function getPressPosition()
    {
        return $this->pressPosition;
    }
}
