<?php

namespace ContentElementsManagementSystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * BlocQuote
 *
 * @ORM\Table(name="bloc_quote")
 * @ORM\Entity(repositoryClass="ContentElementsManagementSystemBundle\Repository\BlocQuoteRepository")
 */
class BlocQuote extends Bloc
{
    use ORMBehaviors\Translatable\Translatable;

    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }
}