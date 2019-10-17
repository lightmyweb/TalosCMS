<?php 
namespace CoreSystemBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use CoreSystemBundle\Entity\Page;
use CoreSystemBundle\Entity\Settings;

class DeleteService{

    private $em;
    public function __construct($em){
        $this->em = $em;
    }
    public function deleteEntitiesRelatedToEntity($entity){
        $entity->setUser(null);
        $entity->setUpdateuser(null);
        $this->em->flush();
    }



}
