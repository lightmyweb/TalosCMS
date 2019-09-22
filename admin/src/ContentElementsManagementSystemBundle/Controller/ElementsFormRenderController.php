<?php

namespace ContentElementsManagementSystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ElementsFormRenderController extends Controller
{


    public function renderImageBlocFormAction($form,$entity){  
        return $this->render(
            'ContentElementsManagementSystemBundle:BlocsForm:imageBloc.html.twig',array(
                'form' => $form,
                'entity' => $entity,
            )
        );
    }
}