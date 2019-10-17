<?php

namespace ContentElementsManagementSystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * BlocSection
 *
 * @ORM\Table(name="bloc_section")
 * @ORM\Entity(repositoryClass="ContentElementsManagementSystemBundle\Repository\BlocSectionRepository")
 */
class BlocSection extends Bloc
{
    use ORMBehaviors\Translatable\Translatable;

    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        
    }

}
