<?php

namespace ContentElementsManagementSystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * BlocTextTranslation
 *
 * @ORM\Table(name="bloc_text_translation")
 * @ORM\Entity(repositoryClass="ContentElementsManagementSystemBundle\Repository\BlocTextTranslationRepository")
 */
class BlocTextTranslation
{
    use ORMBehaviors\Translatable\Translation;
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * Set content
     *
     * @param string $content
     *
     * @return BlocTextTranslation
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
