<?php 
namespace MediaBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use MediaBundle\Entity\PageAndImageRelation;


class MasnoryGridService{

    private $em;
    public function __construct($em){
        $this->em = $em;
    }
    public function setNewEntries($array,$entity,$type){
        $fetchedArray = $this->checkIfExiste($entity,$type);
        foreach ($array as $element) {
            if ( isset( $element['position'] )  ){
                $relation = new PageAndImageRelation();
                $relation->setOrderPosition($element['position']);
                $relation->setLeftPosition($element['left']);
                $relation->setTopPosition($element['top']);
                $relation->setImageType($element['type']);
                $relation->setMansoryHeight($element['mansoryHeight']);
                if( $type == 'page' ){
                    $relation->setPage($entity);
                }else{
                    $relation->setProjet($entity);
                }
                $relation->setImage($this->findImageById($element['id']));
                $this->em->persist($relation);
                $this->em->flush();
            }
            
        }
    }
    public function findImageById($id){
        $image = $this->em->getRepository('MediaBundle:Image')->findOneById($id);
        if( $image ){
            return $image;
        }else{
            return null;
        }   
    }
    private function checkIfExiste($entity,$type){
        $rows = $this->em->getRepository('MediaBundle:PageAndImageRelation')->findBy(
            array(
                $type=>$entity
            ),
            array()
           );
        foreach ($rows as $row) {
           
           if( $row  ){
            $this->deleteEntry($row);
            $fetchedArray[] = $row;
           }
        }
    }
    private function deleteEntry($element){
        $this->em->remove($element);
        $this->em->flush();
    }



}
