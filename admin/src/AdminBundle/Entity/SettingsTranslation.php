<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SettingsTranslation
 *
 * @ORM\Table(name="settings_translation")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\SettingsTranslationRepository")
 */
class SettingsTranslation
{
    use ORMBehaviors\Translatable\Translation;


    public function __call($method, $arguments)
    {
        return \Symfony\Component\PropertyAccess\PropertyAccess::createPropertyAccessor()->getValue($this->translate(), $method);
    }
}
