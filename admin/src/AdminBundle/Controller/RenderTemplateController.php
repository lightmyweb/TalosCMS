<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ContentElementsManagementSystemBundle\Service\MediaService;
use AdminBundle\Service\ProjetService;


class RenderTemplateController extends Controller
{
    public function renderHelpFormAction($form = null, $entity = null){
        return $this->render(
            'AdminBundle:Templates:Help/forms.html.twig',array(
                'form'=>$form,
                'entity'=>$entity
            )
        ); 
    }

    public function renderFavIconAction(){
        $em = $this->getDoctrine()->getManager();
        $settings  = $em->getRepository('AdminBundle:Settings')->findOneById(1);
        $favicon = null;
        if( $settings ){
            $favicon = $settings->getFavIcon();
        }

        return $this->render(
            'AdminBundle:Templates:Settings/favicon.html.twig',array(
                'favicon'=>$favicon,
                'project_name' => $this->container->getParameter('project_name') 
            )
        ); 
    }

    public function renderSubmitButtonsAction($path){
        return $this->render(
            'AdminBundle:Templates:submitButtons.html.twig',array(
                'path'=>$path
            )
        ); 
    }

    public function renderProjecttitleAction(){
        $em = $this->getDoctrine()->getManager();
        $settings = $em->getRepository('AdminBundle:Settings')->findOneById(1);
        $title = null;
        if ( $settings ){
            $title = $settings->getTitle() ;
        }
        return $this->render(
            'AdminBundle:Templates:Settings/title.html.twig',array(
                'title'=>$title
            )
        );
    }

	public function renderSideBarAction($localepathForRouteId,$localepathForRoutePath){
		return $this->render(
            'AdminBundle:Templates:sidebar.html.twig',
            array(
                'localepathForRouteId'=>$localepathForRouteId,
                'localepathForRoutePath'=>$localepathForRoutePath,
                'project_name' => $this->container->getParameter('project_name') 
                
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

	public function renderPageFormAction($form, $entity = null){
		return $this->render(
            'AdminBundle:Templates:Page/forms.html.twig',
            array(
            	'form'=>$form,
                'entity' =>$entity
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
