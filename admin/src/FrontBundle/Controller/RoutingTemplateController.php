<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FrontBundle\Service\EntityService;
use Symfony\Component\HttpFoundation\Response;
use FrontBundle\Service\PageService;


use Symfony\Component\HttpFoundation\JsonResponse;


class RoutingTemplateController extends Controller
{
    private $locale = 'fr';
    /**
     * @Route("/")
    */
    public function homeAction(Request $request)
    {
      dump($this->container->getParameter('project_name'));die;
      $dataArray = array(
        'result' => 'Hello World'
      );
      return new JsonResponse($dataArray);
    }

}
