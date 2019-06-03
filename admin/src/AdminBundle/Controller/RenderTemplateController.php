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
                'favicon'=>$favicon
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

    public function renderHomeItemAction($entity = null,$form = null){
        $em = $this->getDoctrine()->getManager();
        $service = new ProjetService($em);
        $projets = $service->fetchallProjetRelatedToHomepage();
        return $this->render(
            'AdminBundle:Templates:Page/Home/contenu.html.twig',
            array(
                'form'=>$form,
                'entity' =>$entity,
                'projets'=>$projets
            )
        );
    }

    public function renderRefItemAction($entity = null,$form = null){
        $em = $this->getDoctrine()->getManager();
        $service = new ProjetService($em);
        $projets = $service->fetchallProjetRelatedToRef();
        return $this->render(
            'AdminBundle:Templates:Page/Ref/contenu.html.twig',
            array(
                'form'=>$form,
                'entity' =>$entity,
                'projets'=>$projets
            )
        );
    }

    public function renderFoulardItemAction($entity = null,$form = null){
        $em = $this->getDoctrine()->getManager();
        $service = new ProjetService($em);
        $projets = $service->fetchallProjetRelatedToFoulard();
        return $this->render(
            'AdminBundle:Templates:Page/Foulard/contenu.html.twig',
            array(
                'form'=>$form,
                'entity' =>$entity,
                'projets'=>$projets
            )
        );
    }

    public function renderProjetItemAction($entity = null,$form = null){
        $em = $this->getDoctrine()->getManager();
        $service = new ProjetService($em);
        $projets = $em->getRepository('AdminBundle:Projet')->findBy(array(), array('positionInPageProjet' => 'ASC'));
        return $this->render(
            'AdminBundle:Templates:Page/Projet/contenu.html.twig',
            array(
                'form'=>$form,
                'entity' =>$entity,
                'projets'=>$projets
            )
        );
    }

    public function renderProjetInCategoryAction($entity = null){
        $em = $this->getDoctrine()->getManager();
        $service = new ProjetService($em);
        $projets = $service->fetchallProjetRelatedToCat($entity);
        return $this->render(
            'AdminBundle:Templates:Category/allProjetInCat.html.twig',
            array(
                "projets"=>$projets,
                'entity' =>$entity
            )
        );
    }

    public function renderProjetInCategoryFoulardAction($entity = null){
        $em = $this->getDoctrine()->getManager();
        $service = new ProjetService($em);
        $projets = $service->fetchallProjetRelatedToCatFoulard($entity);
        return $this->render(
            'AdminBundle:Templates:CategoryFoulard/allProjetInCat.html.twig',
            array(
                "projets"=>$projets,
                'entity' =>$entity
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

    public function renderCategoryFormAction($form, $entity = null){
        return $this->render(
            'AdminBundle:Templates:Category/forms.html.twig',
            array(
                'form'=>$form,
                'entity' =>$entity
            )
        );
    }
    public function renderCategoryFoulardFormAction($form, $entity = null){
        return $this->render(
            'AdminBundle:Templates:CategoryFoulard/forms.html.twig',
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
