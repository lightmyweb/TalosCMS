<?php

namespace MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PageAndImageRelation
 *
 * @ORM\Table(name="page_and_image_relation")
 * @ORM\Entity(repositoryClass="MediaBundle\Repository\PageAndImageRelationRepository")
 */
class PageAndImageRelation
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
     * @var int
     *
     * @ORM\Column(name="orderPosition", type="integer", nullable=true)
     */
    private $orderPosition = -1;

    /**
     * @var string
     *
     * @ORM\Column(name="leftPosition", type="string", length=255, nullable=true)
     */
    private $leftPosition;

    /**
     * @var string
     *
     * @ORM\Column(name="imageType", type="string", length=255, nullable=true)
     */
    private $imageType;

    /**
     * @var string
     *
     * @ORM\Column(name="TopPosition", type="string", length=255, nullable=true)
     */
    private $topPosition;

    /**
     * @ORM\ManyToOne(targetEntity="\AdminBundle\Entity\Page", inversedBy="masnoryrelations")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id" ,onDelete="CASCADE")
     */

    protected $page;

    /**
     * @ORM\ManyToOne(targetEntity="Image", inversedBy="categoryJoins",inversedBy="masnoryrelations")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */

    protected $image;


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
     * Set orderPosition
     *
     * @param integer $orderPosition
     *
     * @return PageAndImageRelation
     */
    public function setOrderPosition($orderPosition)
    {
        $this->orderPosition = $orderPosition;

        return $this;
    }

    /**
     * Get orderPosition
     *
     * @return int
     */
    public function getOrderPosition()
    {
        return $this->orderPosition;
    }

    /**
     * Set leftPosition
     *
     * @param string $leftPosition
     *
     * @return PageAndImageRelation
     */
    public function setLeftPosition($leftPosition)
    {
        $this->leftPosition = $leftPosition;

        return $this;
    }

    /**
     * Get leftPosition
     *
     * @return string
     */
    public function getLeftPosition()
    {
        return $this->leftPosition;
    }

    /**
     * Set topPosition
     *
     * @param string $topPosition
     *
     * @return PageAndImageRelation
     */
    public function setTopPosition($topPosition)
    {
        $this->topPosition = $topPosition;

        return $this;
    }

    /**
     * Get topPosition
     *
     * @return string
     */
    public function getTopPosition()
    {
        return $this->topPosition;
    }

    /**
     * Set page
     *
     * @param \AdminBundle\Entity\Page $page
     *
     * @return PageAndImageRelation
     */
    public function setPage(\AdminBundle\Entity\Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \AdminBundle\Entity\Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set image
     *
     * @param \MediaBundle\Entity\Image $image
     *
     * @return PageAndImageRelation
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

    /**
     * Set imageType
     *
     * @param string $imageType
     *
     * @return PageAndImageRelation
     */
    public function setImageType($imageType)
    {
        $this->imageType = $imageType;

        return $this;
    }

    /**
     * Get imageType
     *
     * @return string
     */
    public function getImageType()
    {
        return $this->imageType;
    }
}
