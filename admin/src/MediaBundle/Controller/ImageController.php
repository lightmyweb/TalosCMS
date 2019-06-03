<?php

namespace MediaBundle\Controller;

use MediaBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Image controller.
 *
 * @Route("image")
 */
class ImageController extends Controller
{
    /**
     * Lists all image entities.
     *
     * @Route("/", name="image_index")
     * @Method("GET")
     */
    public function indexAction(Request $data)
    {
        $em = $this->getDoctrine()->getManager();

        $images = $em->getRepository('MediaBundle:Image')->findAll();

        return $this->render('MediaBundle:Image:index.html.twig', array(
            'images' => $images,
        ));
    }
}
