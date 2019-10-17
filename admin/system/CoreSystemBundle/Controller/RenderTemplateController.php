<?php

namespace CoreSystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ContentElementsManagementSystemBundle\Service\MediaService;
use CoreSystemBundle\Service\ProjetService;


class RenderTemplateController extends Controller
{

	public function renderSideBarAction($localepathForRouteId,$localepathForRoutePath){
		return $this->render(
            'CoreSystemBundle:Templates:sidebar.html.twig',
            array(
                'localepathForRouteId'=>$localepathForRouteId,
                'localepathForRoutePath'=>$localepathForRoutePath,
                
            )
        );
	}

	public function renderSeoPartAction($form){
		return $this->render(
            'CoreSystemBundle:Templates:Forms/seo_part.html.twig',
            array(
            	'form'=>$form
            )
        );
	}

    public function renderUserSelectAction(){
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository("CoreSystemBundle:User")->findAll();
        return $this->render(
            'CoreSystemBundle:Templates:Forms/userSelect.html.twig',
            array(
                'users'=>$users
            )
        );
    }


    public function renderStateAction($form, $entity = null){
        return $this->render(
            'CoreSystemBundle:Templates:state.html.twig',
            array(
                'form'=>$form,
                'entity' =>$entity
            )
        );
    }

    public function renderProjetFormAction($form, $entity = null){
        return $this->render(
            'CoreSystemBundle:Templates:Projet/forms.html.twig',
            array(
                'form'=>$form,
                'entity' =>$entity
            )
        );
    }

    public function renderCategoryFormAction($form, $entity = null){
        return $this->render(
            'CoreSystemBundle:Templates:Category/forms.html.twig',
            array(
                'form'=>$form,
                'entity' =>$entity
            )
        );
    }


    public function renderLocaleFormAction($form, $entity = null){
        return $this->render(
            'CoreSystemBundle:Templates:Locales/crud_form.html.twig',
            array(
                'form'=>$form
            )
        );
    }

    public function renderLocalesAction(){
        $locales = $this->getDoctrine()->getManager()->getRepository('CoreSystemBundle:Locale')->findBy(
            array(
                'state'=>true
            ),
            array('def'=>'DESC')
        );
        return $this->render(
            'CoreSystemBundle:Templates:Locales/locale.html.twig',
            array(
                'locales'=>$locales
            )
        );
    }

}
