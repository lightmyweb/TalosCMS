<?php

namespace CoreSystemBundle\Controller;

use CoreSystemBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Contact controller.
 *
 * @Route("contact")
 */
class ContactController extends Controller
{
    /**
     * Lists all contact entities.
     *
     * @Route("/", name="contact_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contacts = $em->getRepository('CoreSystemBundle:Contact')->findAll();

        return $this->render('CoreSystemBundle:Contact:index.html.twig', array(
            'contacts' => $contacts,
        ));
    }

    /**
     * Finds and displays a contact entity.
     *
     * @Route("/{id}", name="contact_show")
     * @Method("GET")
     */
    public function showAction(Contact $contact)
    {

        return $this->render('CoreSystemBundle:Contact:show.html.twig', array(
            'contact' => $contact,
        ));
    }
}
