<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ContentElementsManagementSystemBundle\Service\MediaService;
use AdminBundle\Service\ProjetService;


class RenderTemplateController extends Controller
{

	public function renderSideBarAction($localepathForRouteId,$localepathForRoutePath){
		return $this->render(
            'AdminBundle:Templates:sidebar.html.twig',
            array(
                'localepathForRouteId'=>$localepathForRouteId,
                'localepathForRoutePath'=>$localepathForRoutePath,
                
            )
        );
	}

	public function renderSeoPartAction($form){
		return $this->render(
            'AdminBundle:Templates:Forms/seo_part.html.twig',
            array(
            	'form'=>$form
            )
        );
	}

    public function renderUserSelectAction(){
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository("AdminBundle:User")->findAll();
        return $this->render(
            'AdminBundle:Templates:Forms/userSelect.html.twig',
            array(
                'users'=>$users
            )
        );
    }


    public function renderStateAction($form, $entity = null){
        return $this->render(
            'AdminBundle:Templates:state.html.twig',
            array(
                'form'=>$form,
                'entity' =>$entity
            )
        );
    }

    public function renderProjetFormAction($form, $entity = null){
        return $this->render(
            'AdminBundle:Templates:Projet/forms.html.twig',
            array(
                'form'=>$form,
                'entity' =>$entity
            )
        );
    }

    public function renderCategoryFormAction($form, $entity = null){
        return $this->render(
            'AdminBundle:Templates:Category/forms.html.twig',
            array(
                'form'=>$form,
                'entity' =>$entity
            )
        );
    }


    public function renderLocaleFormAction($form, $entity = null){
        return $this->render(
            'AdminBundle:Templates:Locales/crud_form.html.twig',
            array(
                'form'=>$form
            )
        );
    }

    public function renderLocalesAction(){
        $locales = $this->getDoctrine()->getManager()->getRepository('AdminBundle:Locale')->findBy(
            array(
                'state'=>true
            ),
            array('def'=>'DESC')
        );
        return $this->render(
            'AdminBundle:Templates:Locales/locale.html.twig',
            array(
                'locales'=>$locales
            )
        );
    }

}
