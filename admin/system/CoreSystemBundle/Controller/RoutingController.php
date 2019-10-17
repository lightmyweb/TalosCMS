<?php

namespace CoreSystemBundle\Controller; 

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use CoreSystemBundle\Entity\User;
use CoreSystemBundle\Entity\Page;
use CoreSystemBundle\Entity\PressTranslation;
use CoreSystemBundle\Entity\Press;
use CoreSystemBundle\Entity\Locale;
use CoreSystemBundle\Service\LocaleService;
use CoreSystemBundle\Service\OrderService;
use CoreSystemBundle\Service\DeleteService;


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
        return $this->render('CoreSystemBundle:Dashboard:index.html.twig',array(
            'number_of_users' => $doctrine->getRepository('CoreSystemBundle:User')->getTotalCount(),
            'number_of_pages'=>55,
            'number_of_locales'=>$doctrine->getRepository('CoreSystemBundle:Locale')->getTotalCount(),
        ));
    }

    /**
     * @Route("/deleteLocale/{id}/",name="deleteLocale")
     *  @Method({"GET"})
     */
    public function deleteLocaleAction(Request $data,$id){
        $dataArray = array('result'=>0); ////notFound in Database
        $locale_id = $id;
        $em = $this->getDoctrine()->getManager();
        $locale = $em->getRepository('CoreSystemBundle:Locale')->findOneById($locale_id);
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
        $element = $em->getRepository('CoreSystemBundle:'.$entity)->findOneById($id);

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
        $locale = $em->getRepository('CoreSystemBundle:Locale')->findOneById($locale_id);
        if ( $locale ){
            $path = $this->get('kernel')->getRootDir().'/../config/';
            $service = new LocaleService($path);
            $service->changeDefaultLocale( $locale->getSlug() );
            $locales = $em->getRepository('CoreSystemBundle:Locale')->findall();
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
        $user = $em->getRepository('CoreSystemBundle:User')->find($user_id);
        $entity = $em->getRepository('CoreSystemBundle:'.$entity_type)->find($entity_id);
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
            $entities = $em->getRepository('CoreSystemBundle:'.$entity )->findall();
            if ( count($entities) ){
                if( $entity == 'Locale' ){
                    foreach ($entities as $element) {
                        if ( $element->getSlug() == $slug ){
                            $count++;
                            $slugEditForma = $element->getSlug();
                        }
                    }
                }else{
                    $locales = $this->getDoctrine()->getManager()->getRepository('CoreSystemBundle:Locale')->findAll();
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
}