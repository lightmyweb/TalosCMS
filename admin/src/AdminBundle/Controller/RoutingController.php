<?php

namespace AdminBundle\Controller; 

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use AdminBundle\Entity\User;
use AdminBundle\Entity\Page;
use AdminBundle\Entity\Locale;
use AdminBundle\Service\LocaleService;
use AdminBundle\Service\ProjetService;
use AdminBundle\Service\DeleteService;


use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\File\File;


class RoutingController extends Controller
{
    /**
     * @Route("/",name="backend_index")
     */
    public function indexAction()
    {
        $doctrine = $this->getDoctrine();
        return $this->render('AdminBundle:Dashboard:index.html.twig',array(
            'number_of_users' => $doctrine->getRepository('AdminBundle:User')->getTotalCount(),
            'number_of_pages'=>$doctrine->getRepository('AdminBundle:Page')->getTotalCount(),
            'number_of_locales'=>$doctrine->getRepository('AdminBundle:Locale')->getTotalCount(),
        ));
    }

    /**
     * @Route("/exemple",name="exemple_index")
     */
    public function exempleAction()
    {
        return $this->render('AdminBundle:Templates:exemple.html.twig');
    }

    /**
     * @Route("/deleteLocale/{id}/",name="deleteLocale")
     *  @Method({"GET"})
     */
    public function deleteLocaleAction(Request $data,$id){
        $dataArray = array('result'=>0); ////notFound in Database
        $locale_id = $id;
        $em = $this->getDoctrine()->getManager();
        $locale = $em->getRepository('AdminBundle:Locale')->findOneById($locale_id);
        if ( $locale ){
            $path = $this->get('kernel')->getRootDir().'/../config/';
            $service = new LocaleService($path);
            $result = $service->removeLocale( $locale->getSlug() );
            $em->remove($locale);
            $em->flush();
            if ( $result == true ){
                $dataArray = array('result'=>1); //Success
                $this->cacheSys();
            }else{
                $dataArray = array('result'=> -1 ); //notFound in Yml
            }
        }

        return new JsonResponse( $dataArray );
    }

        /**
     * @Route("/element_delete/{id}/{entity}",name="element_delete")
     *  @Method({"GET"})
     */
    public function element_deleteAction(Request $data,$id,$entity){
        $dataArray = array('result'=>0); ////notFound in Database
        $em = $this->getDoctrine()->getManager();
        $element = $em->getRepository('AdminBundle:'.$entity)->findOneById($id);

        if ( $element ){
            $service = new DeleteService($this->getDoctrine()->getManager());
            $service->deleteEntitiesRelatedToEntity($element);

            $em->remove($element);
            $em->flush();
            $dataArray = array('result'=>1); //Success
        }

        return new JsonResponse( $dataArray );
    }

    /**
     * @Route("/updateDefaultLocale/{id}",name="updateDefaultLocale")
     *  @Method({"GET"})
     */
    public function setDefaultLocaleAction(Request $data,$id = null){
        $dataArray = array('result'=>0); ////notFound in Database
        $locale_id = $id;
        $em = $this->getDoctrine()->getManager();
        $locale = $em->getRepository('AdminBundle:Locale')->findOneById($locale_id);
        if ( $locale ){
            $path = $this->get('kernel')->getRootDir().'/../config/';
            $service = new LocaleService($path);
            $service->changeDefaultLocale( $locale->getSlug() );
            $locales = $em->getRepository('AdminBundle:Locale')->findall();
            foreach ($locales as $element) {
               $element->setDef(0);
            }
            $locale->setDef(1);
            $em->flush();
            $dataArray = array('result'=>1); //Success
            $this->cacheSys();
        }

        return new JsonResponse( $dataArray );
    }

    /**
     * @Route("/affectUser/{user_id}/{entity_id}/{entity_type}",name="affectUser")
     *  @Method({"GET"})
     */
    public function affectUserAction(Request $data,$user_id = null,$entity_id = null,$entity_type = null){
        $dataArray = array('result'=>0); ////notFound in Database
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AdminBundle:User')->find($user_id);
        $entity = $em->getRepository('AdminBundle:'.$entity_type)->find($entity_id);
        if ($user){
            $entity->setUser($user);
            $em->flush();
            $dataArray = array(
                'result'=>1,
                'name' => $user->getFirstName(). ' '. $user->getLastName()
            );
        }
        return new JsonResponse( $dataArray );
    }

    /**
     * @Route("/slugValidation/{entity}/{slug}",name="slugValidation")
     *  @Method({"GET"})
     */
    public function slugValidationAction(Request $data,$entity = null,$slug = null){
        $dataArray = array('result' => 0 );////notFound in Database
        $count = 0;
        $slugEditForma = null;
        if ( $entity != null && $slug != null ){
            $em = $this->getDoctrine()->getManager();
            $entities = $em->getRepository('AdminBundle:'.$entity )->findall();
            if ( count($entities) ){
                if( $entity == 'Locale' ){
                    foreach ($entities as $element) {
                        if ( $element->getSlug() == $slug ){
                            $count++;
                            $slugEditForma = $element->getSlug();
                        }
                    }
                }else{
                    $locales = $this->getDoctrine()->getManager()->getRepository('AdminBundle:Locale')->findAll();
                    foreach ($locales as $locale ) {
                        foreach ($entities as $element) {
                            if ( $element->translate( $locale->getSlug() )->getSlug() == $slug ){
                                $count++;
                                $slugEditForma = $element->translate( $locale->getSlug() )->getSlug() ;
                            }
                        }
                    }
                }
                
            }
        }
        if ( $count > 0 ){
            $dataArray = array('result' => 1,'slug'=> $slugEditForma); //slug exist
        }
        return new JsonResponse( $dataArray );
    }


    /**
     * @Route("/clearcache",name="clearcache")
     *  @Method({"GET", "POST"})
     */
    public function clearCacheAction(){
        $this->cacheSys();
        return $this->redirectToRoute('backend_index');
    }

    private function cacheSys(){
        $kernel = $this->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(array(
        'command' => 'cache:clear',
        '--env' => "dev",
        '--no-warmup' => true
        ));
        $output = new BufferedOutput();
        $application->run($input, $output);
        $content = $output->fetch();
    }

    /**
     * @Route("/updateProjetPositionInHome/{id}_{position}",name="updateProjetPositionInHome")
     *  @Method({"GET"})
     */
    public function updateProjetPositionInHomeAction(Request $data,$id = null,$position = null){
        $dataArray = array('result'=>0);
        $service = new ProjetService($this->getDoctrine()->getManager());
        $result = $service->setProjetOrderInHome($id,$position);
        if( $result == 1 ){
            $dataArray = array('result'=>1,'order'=>$position);
        }
        return new JsonResponse( $dataArray );
    }

    /**
     * @Route("/updateProjetPositionInRef/{id}_{position}",name="updateProjetPositionInRef")
     *  @Method({"GET"})
     */
    public function updateProjetPositionInRefAction(Request $data,$id = null,$position = null){
        $dataArray = array('result'=>0);
        $service = new ProjetService($this->getDoctrine()->getManager());
        $result = $service->setProjetOrderInRef($id,$position);
        if( $result == 1 ){
            $dataArray = array('result'=>1,'order'=>$position);
        }
        return new JsonResponse( $dataArray );
    }

    /**
     * @Route("/updateProjetPositionInPageProjet/{id}_{position}",name="updateProjetPositionInPageProjet")
     *  @Method({"GET"})
     */
    public function updateProjetPositionInPageProjetAction(Request $data,$id = null,$position = null){
        $dataArray = array('result'=>0);
        $service = new ProjetService($this->getDoctrine()->getManager());
        $result = $service->setProjetOrderInPageProjet($id,$position);
        if( $result == 1 ){
            $dataArray = array('result'=>1,'order'=>$position);
        }
        return new JsonResponse( $dataArray );
    }

    /**
     * @Route("/updateProjetPositionInFoulard/{id}_{position}",name="updateProjetPositionInFoulard")
     *  @Method({"GET"})
     */
    public function updateProjetPositionInFoulardAction(Request $data,$id = null,$position = null){
        $dataArray = array('result'=>0);
        $service = new ProjetService($this->getDoctrine()->getManager());
        $result = $service->setProjetOrderInFoulard($id,$position);
        if( $result == 1 ){
            $dataArray = array('result'=>1,'order'=>$position);
        }
        return new JsonResponse( $dataArray );
    }


}
