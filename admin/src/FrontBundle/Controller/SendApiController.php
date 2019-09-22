<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FrontBundle\Service\EntityService;
use Symfony\Component\HttpFoundation\Response;
use FrontBundle\Service\GetElementsService;


use Symfony\Component\HttpFoundation\JsonResponse;


class SendApiController extends Controller
{
    /**
   * @Route("/")
  */
  
  public function homeAction(Request $request)
  {
    return new JsonResponse(array('res'=>1));
  }

}
