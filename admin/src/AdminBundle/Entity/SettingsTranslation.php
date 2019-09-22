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
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


    public function __call($method, $arguments)
    {
        return \Symfony\Component\PropertyAccess\PropertyAccess::createPropertyAccessor()->getValue($this->translate(), $method);
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return SettingsTranslation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
