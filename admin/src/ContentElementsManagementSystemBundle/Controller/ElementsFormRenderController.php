<?php

namespace ContentElementsManagementSystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ElementsFormRenderController extends Controller
{

	public function renderTextBlocFormAction($form,$entityType = null){  
        if ( $entityType == null ){
            $entityType = 'parent';
        }
		return $this->render(
            'ContentElementsManagementSystemBundle:BlocsForm:textBloc.html.twig',array(
                'form' => $form,
            	'entityType' => $entityType,
        	)
        );
	}

	public function renderSectionBlocFormAction($form,$entity){  
		return $this->render(
            'ContentElementsManagementSystemBundle:BlocsForm:sectionBloc.html.twig',array(
                'form' => $form,
            	'entity' => $entity
        	)
        );
	}
   
}
