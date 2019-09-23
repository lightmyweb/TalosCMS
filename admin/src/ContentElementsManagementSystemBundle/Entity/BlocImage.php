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
}
