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
     * @ORM\OneToMany(targetEntity="\AdminBundle\Entity\Client", mappedBy="image")
     * @ORM\OrderBy({"position"="ASC"})
     */
    protected $logoclient;

    /**
     * @ORM\OneToMany(targetEntity="\AdminBundle\Entity\Client", mappedBy="image")
     * @ORM\OrderBy({"position"="ASC"})
     */
    protected $thumbnailclient;

    /**
     * @ORM\OneToMany(targetEntity="\AdminBundle\Entity\Press", mappedBy="image")
     * @ORM\OrderBy({"position"="ASC"})
     */
    protected $pressthumbnail;

    /**
     * @ORM\OneToMany(targetEntity="\ContentElementsManagementSystemBundle\Entity\BlocGallery", mappedBy="image")
     * @ORM\OrderBy({"position"="ASC"})
     */
    protected $blocgallerythumbnail;

    /**
     * @ORM\OneToMany(targetEntity="\ContentElementsManagementSystemBundle\Entity\BlocImage", mappedBy="image")
     * @ORM\OrderBy({"position"="ASC"})
     */
    protected $blocimagethumbnail;

    /**
     * @ORM\OneToMany(targetEntity="\ContentElementsManagementSystemBundle\Entity\BlocGalleryimage", mappedBy="image")
     * @ORM\OrderBy({"position"="ASC"})
     */
    protected $galleryfigures;

    /**
     * @ORM\OneToMany(targetEntity="\AdminBundle\Entity\Project", mappedBy="image")
     * @ORM\OrderBy({"position"="ASC"})
     */
    protected $projects;


    /**
     * @ORM\OneToMany(targetEntity="\AdminBundle\Entity\Home", mappedBy="image")
     * @ORM\OrderBy({"position"="ASC"})
     */
    protected $homeAboutImage;


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
        $this->galleryfigures = new \Doctrine\Common\Collections\ArrayCollection;
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
     * Add project
     *
     * @param \AdminBundle\Entity\Project $project
     *
     * @return Image
     */
    public function addProject(\AdminBundle\Entity\Project $project)
    {
        $this->projects[] = $project;
    
        return $this;
    }

    /**
     * Remove project
     *
     * @param \AdminBundle\Entity\Project $project
     */
    public function removeProject(\AdminBundle\Entity\Project $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Add logoclient
     *
     * @param \AdminBundle\Entity\Client $logoclient
     *
     * @return Image
     */
    public function addLogoclient(\AdminBundle\Entity\Client $logoclient)
    {
        $this->logoclient[] = $logoclient;
    
        return $this;
    }

    /**
     * Remove logoclient
     *
     * @param \AdminBundle\Entity\Client $logoclient
     */
    public function removeLogoclient(\AdminBundle\Entity\Client $logoclient)
    {
        $this->logoclient->removeElement($logoclient);
    }

    /**
     * Get logoclient
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLogoclient()
    {
        return $this->logoclient;
    }

    /**
     * Add thumbnailclient
     *
     * @param \AdminBundle\Entity\Client $thumbnailclient
     *
     * @return Image
     */
    public function addThumbnailclient(\AdminBundle\Entity\Client $thumbnailclient)
    {
        $this->thumbnailclient[] = $thumbnailclient;
    
        return $this;
    }

    /**
     * Remove thumbnailclient
     *
     * @param \AdminBundle\Entity\Client $thumbnailclient
     */
    public function removeThumbnailclient(\AdminBundle\Entity\Client $thumbnailclient)
    {
        $this->thumbnailclient->removeElement($thumbnailclient);
    }

    /**
     * Get thumbnailclient
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getThumbnailclient()
    {
        return $this->thumbnailclient;
    }

    /**
     * Add homeAboutImage
     *
     * @param \AdminBundle\Entity\Home $homeAboutImage
     *
     * @return Image
     */
    public function addHomeAboutImage(\AdminBundle\Entity\Home $homeAboutImage)
    {
        $this->homeAboutImage[] = $homeAboutImage;
    
        return $this;
    }

    /**
     * Remove homeAboutImage
     *
     * @param \AdminBundle\Entity\Home $homeAboutImage
     */
    public function removeHomeAboutImage(\AdminBundle\Entity\Home $homeAboutImage)
    {
        $this->homeAboutImage->removeElement($homeAboutImage);
    }

    /**
     * Get homeAboutImage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHomeAboutImage()
    {
        return $this->homeAboutImage;
    }

    /**
     * Add pressthumbnail
     *
     * @param \AdminBundle\Entity\Press $pressthumbnail
     *
     * @return Image
     */
    public function addPressthumbnail(\AdminBundle\Entity\Press $pressthumbnail)
    {
        $this->pressthumbnail[] = $pressthumbnail;
    
        return $this;
    }

    /**
     * Remove pressthumbnail
     *
     * @param \AdminBundle\Entity\Press $pressthumbnail
     */
    public function removePressthumbnail(\AdminBundle\Entity\Press $pressthumbnail)
    {
        $this->pressthumbnail->removeElement($pressthumbnail);
    }

    /**
     * Get pressthumbnail
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPressthumbnail()
    {
        return $this->pressthumbnail;
    }

    /**
     * Add blocgallerythumbnail
     *
     * @param \ContentElementsManagementSystemBundle\Entity\BlocGallery $blocgallerythumbnail
     *
     * @return Image
     */
    public function addBlocgallerythumbnail(\ContentElementsManagementSystemBundle\Entity\BlocGallery $blocgallerythumbnail)
    {
        $this->blocgallerythumbnail[] = $blocgallerythumbnail;
    
        return $this;
    }

    /**
     * Remove blocgallerythumbnail
     *
     * @param \ContentElementsManagementSystemBundle\Entity\BlocGallery $blocgallerythumbnail
     */
    public function removeBlocgallerythumbnail(\ContentElementsManagementSystemBundle\Entity\BlocGallery $blocgallerythumbnail)
    {
        $this->blocgallerythumbnail->removeElement($blocgallerythumbnail);
    }

    /**
     * Get blocgallerythumbnail
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlocgallerythumbnail()
    {
        return $this->blocgallerythumbnail;
    }

    /**
     * Add galleryfigure
     *
     * @param \ContentElementsManagementSystemBundle\Entity\BlocGalleryimage $galleryfigure
     *
     * @return Image
     */
    public function addGalleryfigure(\ContentElementsManagementSystemBundle\Entity\BlocGalleryimage $galleryfigure)
    {   
        $galleryfigure->setImage($this);
        $this->galleryfigures[] = $galleryfigure;
    
        return $this;
    }

    /**
     * Remove galleryfigure
     *
     * @param \ContentElementsManagementSystemBundle\Entity\BlocGalleryimage $galleryfigure
     */
    public function removeGalleryfigure(\ContentElementsManagementSystemBundle\Entity\BlocGalleryimage $galleryfigure)
    {
        $this->galleryfigures->removeElement($galleryfigure);
    }

    /**
     * Get galleryfigures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGalleryfigures()
    {
        return $this->galleryfigures;
    }

    /**
     * Add blocimagethumbnail
     *
     * @param \ContentElementsManagementSystemBundle\Entity\BlocImage $blocimagethumbnail
     *
     * @return Image
     */
    public function addBlocimagethumbnail(\ContentElementsManagementSystemBundle\Entity\BlocImage $blocimagethumbnail)
    {
        $this->blocimagethumbnail[] = $blocimagethumbnail;
    
        return $this;
    }

    /**
     * Remove blocimagethumbnail
     *
     * @param \ContentElementsManagementSystemBundle\Entity\BlocImage $blocimagethumbnail
     */
    public function removeBlocimagethumbnail(\ContentElementsManagementSystemBundle\Entity\BlocImage $blocimagethumbnail)
    {
        $this->blocimagethumbnail->removeElement($blocimagethumbnail);
    }

    /**
     * Get blocimagethumbnail
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlocimagethumbnail()
    {
        return $this->blocimagethumbnail;
    }
}
