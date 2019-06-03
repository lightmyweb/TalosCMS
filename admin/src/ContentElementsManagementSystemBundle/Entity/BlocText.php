<?php

namespace ContentElementsManagementSystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * BlocText
 *
 * @ORM\Table(name="bloc_text")
 * @ORM\Entity(repositoryClass="ContentElementsManagementSystemBundle\Repository\BlocTextRepository")
 */
class BlocText extends Bloc
{
    use ORMBehaviors\Translatable\Translatable;

}
