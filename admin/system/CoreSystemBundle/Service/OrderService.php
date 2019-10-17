<?php
namespace CoreSystemBundle\Service;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class OrderService{
	private $em;
	public function __construct($_em){
		$this->em = $_em;
	}

	public function setProjectPosition($id,$position){
		$result = 0;
		$project = $this->em->getRepository('CoreSystemBundle:Project')->findOneById($id);
		if( $project  ){
			$project->setProjectPosition( $position );
			$this->em->flush();
			return 1;
		}
	}

	public function setProjectPositionHome($id,$position){
		$result = 0;
		$project = $this->em->getRepository('CoreSystemBundle:Project')->findOneById($id);
		if( $project  ){
			$project->setProjectPositionHome( $position );
			$this->em->flush();
			return 1;
		}
	}

	public function setClientPosition($id,$position){
		$result = 0;
		$client = $this->em->getRepository('CoreSystemBundle:Client')->findOneById($id);
		if( $client  ){
			$client->setClientPosition( $position );
			$this->em->flush();
			return 1;
		}
	}

	public function setPressPosition($id,$position){
		$result = 0;
		$press = $this->em->getRepository('CoreSystemBundle:Press')->findOneById($id);
		if( $press  ){
			$press->setPressPosition( $position );
			$this->em->flush();
			return 1;
		}
	}

	public function setCategoryPosition($id,$position){
		$result = 0;
		$category = $this->em->getRepository('CoreSystemBundle:Category')->findOneById($id);
		if( $category  ){
			$category->setCategoryPosition( $position );
			$this->em->flush();
			return 1;
		}
	}
}