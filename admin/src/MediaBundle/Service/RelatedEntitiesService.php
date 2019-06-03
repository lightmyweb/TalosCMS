<?php 
namespace MediaBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class RelatedEntitiesService{

    private $em;
    public function __construct($em){
        $this->em = $em;
    }
    public function deleteEntitiesRelatedToEntity($entity){
        if ( method_exists($entity,'getPages' )  ){
            foreach ($entity->getPages() as $element) {
              $element->setImage(null);
            }
        }
        if ( method_exists($entity,'getProjets' )  ){
            foreach ($entity->getProjets() as $element) {
              $element->setImage(null);
            }
        }
        if ( method_exists($entity,'getMasnoryrelations' )  ){
            foreach ($entity->getMasnoryrelations() as $element) {
                //$element->setImage(null);
                $this->em->remove($element);
                $this->em->flush();
            }
        }
        $this->em->flush();
    }



}
