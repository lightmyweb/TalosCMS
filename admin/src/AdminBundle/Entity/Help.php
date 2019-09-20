<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Help
 *
 * @ORM\Table(name="help")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\HelpRepository")
 */
class Help extends GeneralEntity
{

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;




    /**
     * Set title
     *
     * @param string $title
     *
     * @return Help
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
}
