<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
/**
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\PageRepository")
 */
class Page extends GeneralEntity
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="\MediaBundle\Entity\Image", inversedBy="pages")
     * @ORM\JoinColumn(name="image", referencedColumnName="id")
     */
    private $image;

    public function __toString(){
        return $this->getTitle().'';
    }
    
    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }

    /**
     * Set image
     *
     * @param \MediaBundle\Entity\Image $image
     *
     * @return Page
     */
    public function setImage(\MediaBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \MediaBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}
