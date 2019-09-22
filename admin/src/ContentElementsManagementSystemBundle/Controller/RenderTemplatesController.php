<?php
namespace ContentElementsManagementSystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ContentElementsManagementSystemBundle\Service\TestifContentExistControllor;


class RenderTemplatesController extends Controller{
	public function renderItemsViewerAction($entity = null,$form = null){  
		$dataArray = array(
			'edit'=> 0
		);
		if ( $entity != null ){
			$contentTestService = new TestifContentExistControllor( $this->getDoctrine()->getManager(), $entity );
			$dataArray['edit'] = 1;
			$dataArray['form'] = $form;
			$dataArray['contents'] = $contentTestService->getResult();
		}
		return $this->render(
            'ContentElementsManagementSystemBundle:Templates:items_viewer.html.twig',$dataArray 
        );
	}
}