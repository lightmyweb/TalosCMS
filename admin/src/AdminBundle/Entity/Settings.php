<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Settings
 *
 * @ORM\Table(name="settings")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\SettingsRepository")
 */
class Settings
{
    use ORMBehaviors\Translatable\Translatable;
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="favicon", type="string", length=255)
     */
    private $favicon;

    /**
     * @var bool
     *
     * @ORM\Column(name="installed", type="boolean")
     */
    private $installed;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="instagram", type="string", length=255)
     */
    private $instagram;

    /**
     * @var string
     *
     * @ORM\Column(name="pinterest", type="string", length=255)
     */
    private $pinterest;

    /**
     * @var string
     *
     * @ORM\Column(name="widthForCrop", type="string", length=255, nullable=true)
     */
    private $widthForCrop;

    /**
     * @var string
     *
     * @ORM\Column(name="heigthForCrop", type="string", length=255, nullable=true)
     */
    private $heigthForCrop;


    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
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
     * Set title
     *
     * @param string $title
     *
     * @return Settings
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
     * Set favicon
     *
     * @param string $favicon
     *
     * @return Settings
     */
    public function setFavicon($favicon)
    {
        if( $favicon == null ){
            $favicon = $this->getFavicon();
        }
        $this->favicon = $favicon;

        return $this;
    }

    /**
     * Get favicon
     *
     * @return string
     */
    public function getFavicon()
    {
        return $this->favicon;
    }

    /**
     * Set installed
     *
     * @param boolean $installed
     *
     * @return Settings
     */
    public function setInstalled($installed)
    {
        $this->installed = $installed;

        return $this;
    }

    /**
     * Get installed
     *
     * @return bool
     */
    public function getInstalled()
    {
        return $this->installed;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Settings
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return Settings
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set instagram
     *
     * @param string $instagram
     *
     * @return Settings
     */
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;

        return $this;
    }

    /**
     * Get instagram
     *
     * @return string
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * Set widthForCrop
     *
     * @param string $widthForCrop
     *
     * @return Settings
     */
    public function setWidthForCrop($widthForCrop)
    {
        $this->widthForCrop = $widthForCrop;

        return $this;
    }

    /**
     * Get widthForCrop
     *
     * @return string
     */
    public function getWidthForCrop()
    {
        return $this->widthForCrop;
    }

    /**
     * Set heigthForCrop
     *
     * @param string $heigthForCrop
     *
     * @return Settings
     */
    public function setHeigthForCrop($heigthForCrop)
    {
        $this->heigthForCrop = $heigthForCrop;

        return $this;
    }

    /**
     * Get heigthForCrop
     *
     * @return string
     */
    public function getHeigthForCrop()
    {
        return $this->heigthForCrop;
    }

    /**
     * Set pinterest
     *
     * @param string $pinterest
     *
     * @return Settings
     */
    public function setPinterest($pinterest)
    {
        $this->pinterest = $pinterest;

        return $this;
    }

    /**
     * Get pinterest
     *
     * @return string
     */
    public function getPinterest()
    {
        return $this->pinterest;
    }
}
