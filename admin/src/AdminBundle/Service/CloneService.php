<?php 
namespace AdminBundle\Service;
use AdminBundle\Entity\Page;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class CloneService{

    private $em;
    public function __construct($em){
        $this->em = $em;
    }
    public function cloneEnity($originalEntity){
        $new_entity = clone($originalEntity);
        if ($new_entity instanceof Page){
            $new_entity->setSlug('copie_d_une_page'.uniqid());
        }
        $this->em->persist($new_entity);
        $this->em->flush();
    }


}
