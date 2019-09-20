<?php

namespace ContentElementsManagementSystemBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestifContentExistControllor extends Controller
{
	private $em;
	private $result; 

	public function __construct($em,$entity) {  
		$this->em = $em;
		$this->result = $this->whichContent($entity);
  }
  private function whichContent( $entity ){
   		$dataArray = array();

   		//textBloc
   		if ( method_exists($entity,'getBlocTexts' )  ){
   			foreach ($entity->getBlocTexts() as $textBloc) {
              $dataArray[] =  array(
                  'type' => 'textBloc', 
                  'entity' => $textBloc, 
                  'position' => $textBloc->getPosition() 
              );
          }
   		}

      //quoteBloc
      if ( method_exists($entity,'getBlocQuotes' ) ){
        foreach ($entity->getBlocQuotes() as $quoteBloc) {
                $dataArray[] =  array(
                    'type' => 'quoteBloc', 
                    'entity' => $quoteBloc, 
                    'position' => $quoteBloc->getPosition() 
                );
            }
      }

      //imageBloc
      if ( method_exists($entity,'getBlocImages' ) ){
        foreach ($entity->getBlocImages() as $imageBloc) {
                $dataArray[] =  array(
                    'type' => 'imageBloc', 
                    'entity' => $imageBloc, 
                    'position' => $imageBloc->getPosition() 
                );
            }
      }

      //galleryBloc
      if ( method_exists($entity,'getBlocGalleries' ) ){
        foreach ($entity->getBlocGalleries() as $galleryBloc) {
                $dataArray[] =  array(
                    'type' => 'galleryBloc', 
                    'entity' => $galleryBloc, 
                    'position' => $galleryBloc->getPosition() 
                );
            }
      }

      //galleryimageBloc
      if ( method_exists($entity,'getBlocGalleryimages' ) ){
          foreach ($entity->getBlocGalleryimages() as $galleryimageBloc) {
              $dataArray[] =  array(
                  'type' => 'galleryimageBloc', 
                  'entity' => $galleryimageBloc, 
                  'position' => $galleryimageBloc->getPosition() 
              );
          }
      }

   		/** order by position **/
      $dataArray = $this->setPositionOrder($dataArray);

      return $dataArray;
   	}
  private function setPositionOrder($array){
      $sortArray = array(); 
      if(isset($array) && sizeof( $array ) > 0  ){
          foreach($array as $person){ 
              foreach($person as $key=>$value){ 
                  if(!isset($sortArray[$key])){ 
                      $sortArray[$key] = array(); 
                  } 
                  $sortArray[$key][] = $value; 
              } 
          } 
          $orderby = "position";
          array_multisort($sortArray[$orderby],SORT_ASC,$array); 
      }
      return $array;
    }

   public function getResult(){
   		return $this->result;
   }
}
