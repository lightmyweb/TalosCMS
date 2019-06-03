<?php

namespace MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use MediaBundle\Service\MasnoryGridService;
use MediaBundle\Service\MasnoryGridProjetService;

class RenderTemplatesController extends Controller
{
	public function renderMasonryGridAction($entity,$type = 'page'){  
		$em = $this->getDoctrine()->getManager();
        $images = $em->getRepository('MediaBundle:Image')->findAll();
        $masnoryElements = $em->getRepository('MediaBundle:PageAndImageRelation')->findby(
        	array(
        		$type=>$entity
        	),
        	array('orderPosition'=>'ASC')
        );
        $service = new MasnoryGridService($this->getDoctrine()->getManager());
        $masnoryImages = array();
        foreach ($masnoryElements as $element) {
        	if( $service->findImageById($element->getImage()->getId()) != null ){
                $result = false;
                if( $type == 'page' && $element->getPage() != null && $element->getPage()->getId() == $entity->getId() ){
                    $masnoryImages[] = $this->fetchMansory($element);
                }else if( $type == 'projet' && $element->getProjet() != null && $element->getProjet()->getId() == $entity->getId() ){
                    $masnoryImages[] = $this->fetchMansory($element);
                }
        	}
        }
		return $this->render(
            'MediaBundle:Templates:masnoryGrid.html.twig',array(
            	'images'=>$images,
            	'masnoryImages'=>$masnoryImages
            )
        );
	}
    private function fetchMansory($element){
        $array = array(
            'type'=>$element->getImageType(),
            'src'=>$element->getImage()->getSrc(),
            'top'=>$element->getTopPosition(),
            'left'=>$element->getLeftPosition(),
            'id'=>$element->getImage()->getId(),
            'order'=>$element->getOrderPosition()
        );
        return $array;
    }
}
