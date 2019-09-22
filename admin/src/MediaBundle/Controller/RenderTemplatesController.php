<?php

namespace MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class RenderTemplatesController extends Controller
{
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
