<?php

namespace MediaBundle\Controller;

use MediaBundle\Entity\Image;
use MediaBundle\Service\RelatedEntitiesService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AdminBundle\Service\FileUploader;


class AjaxCallsController extends Controller
{
    /**
     * @Route("/getImageConfig", name="getImageConfig")
     * @Method("GET")
     */
    public function getImageConfigAction()
    {
        $em = $this->getDoctrine()->getManager();
        $settings = $em->getRepository('AdminBundle:Settings')->findOneById(1);
        $dataArray = array(
            'result' => 0
        );
        if( $settings ){
            $dataArray = array(
                'result' => 1,
                'heigth' =>$settings->getWidthForCrop(),
                'width' =>$settings->getHeigthForCrop(),
            );  
        }
        return new JsonResponse($dataArray);
    }

	 /**
     * @Route("/all_images", name="all_images")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $images = $em->getRepository('MediaBundle:Image')->findAll();
        $dataArray = array();
        foreach ($images as $image) {
        	$dataArray[] = array(
        		"id"=>$image->getId(),
        		"src"=>$image->getSrc(),
        		"alt"=>$image->getAlt(),
        		"externa_link"=>$image->getExternaLink(),
        	);
        }
        return new JsonResponse($dataArray);
    }

    /**
     * @Route("/getOneImage/{id}", name="getOneImage")
     * @Method("GET")
     */
    public function getOneImageAction(Request $data,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository('MediaBundle:Image')->findOneById($id);
        $dataArray = array("result"=>0 );
        if($image){
            $dataArray['result'] = 1;
            $dataArray['image'] = array(
                "id"=>$image->getId(),
                "src"=>$image->getSrc(),
                "alt"=>$image->getAlt(),
                "externa_link"=>$image->getExternaLink(),
            );
        }
        return new JsonResponse($dataArray);
    }

    /**
     *
     * @Route("/new_image", name="add_new_image")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $file = null;
        if( $request->files->get('fileCroped') ){
            $file = $request->files->get('fileCroped');
        }else{
            $file = $request->files->get('src');
        }
        $status = array('status' => "error","fileUploaded" => false);
        if(!is_null($file)){
            $date = new \DateTime("now");
            $date = $date->format('Y-m-d_H-i-s');
            $upload_directory = $this->get('kernel')->getRootDir() . '/../web/uploads/';
            $file_uploader = new FileUploader($upload_directory);
            $file_name = $file_uploader->upload($file,$date,'image');

            $em = $this->getDoctrine()->getManager();
            $image = new Image();
            $image->setSrc($file_name);
            $image->setAlt($request->request->get('title'));
            //$image->setExternaLink($request->request->get('externalLink'));
            $em->persist($image);
            $em->flush();

            $image_id =  $em->getRepository('MediaBundle:Image')->findBy(
                array(),
                array('id'=>'DESC')
            )[0]->getId();

            $status = array('status' => "success","fileUploaded" => true,'id'=>$image_id);
        }
        return new JsonResponse($status);
    }
    
     /**
     *
     * @Route("/edit_image/{id}", name="edit_existant_image")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository('MediaBundle:Image')->findOneById($id);
        $status = array('status' => "error","fileUploaded" => 'entity not found');
        if( $image ){
            $file = $request->files->get('fileCroped');
            if(!is_null($file)){
                $date = new \DateTime("now");
                $date = $date->format('Y-m-d_H-i-s');
                $upload_directory = $this->get('kernel')->getRootDir() . '/../web/uploads/';
                $file_uploader = new FileUploader($upload_directory);
                $file_name = $file_uploader->upload($file,$date,'image');
                $image->setSrc($file_name);
            }
            $image->setAlt($request->request->get('title'));
            $image->setExternaLink($request->request->get('externalLink'));
            $em->flush();
            $status = array('status' => "error","fileUploaded" => 'entity found');
        }
        
        return new JsonResponse($status);
    }

    /**
     *
     * @Route("/delete_image/{id}", name="delete_existant_image")
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository('MediaBundle:Image')->findOneById($id);
        $status = array('status' => "error","fileUploaded" => 'entity not found');
        if( $image ){
            $service = new RelatedEntitiesService($em );
            $service->deleteEntitiesRelatedToEntity($image);
            $em->remove($image);
            $em->flush();
            $status = array('status' => "error","fileUploaded" => 'entity found');
        }
        
        return new JsonResponse($status);
    }
}
