<?php
namespace FrontBundle\Service;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class EntityService{
	private $em;
	private $locale;
	public function __construct($_em,$_locale = 'fr'){
		$this->em = $_em;
		$this->locale = $_locale;
	}

    public function getEntities($entityType){
        $dataArray = null;
        $entities = $this->em->getRepository('AdminBundle:'.$entityType)->findBy(
            array(
                'state'=>1
            ),
            array()
        );
        if ( $entities ){
            $dataArray = $entities;
        }
        return $dataArray;
    }

	public function getEntityDataFromSlug($entitySlug,$entityType){
        $dataArray = array();
        $entity = $this->em->getRepository('AdminBundle:'.$entityType.'Translation')->findBy(
            array(
                'slug'=>$entitySlug
            ),
            array()
        );
        if ( $entity ){
            $dataArray = array(
                'entity_id' => $entity[0]->getTranslatable()->getId(),
                'entity_type'=>$entityType,
                'entity_seo' => $this->getSeoForEntity($entity[0]->getTranslatable())
            );
        }
        return $dataArray;
    }
    public function getEntityDataFromTitle($entityTitle,$entityType){
        $result = null;
        $entity = $this->em->getRepository('AdminBundle:'.$entityType.'Translation')->findBy(
            array(
                'title'=>$entityTitle,
                'locale'=>$this->locale
            ),
            array()
        );
        if ( $entity ){
            $result = $entityTitle;
        }
        return $result;
    }
    private function getSeoForEntity($entity){
        return  array(
            'title'=> $entity->getSeo()->getTitle(),
            'description'=> $entity->getSeo()->getDescription(),
        );
    }

}