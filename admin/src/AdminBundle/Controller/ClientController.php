<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Client controller.
 *
 * @Route("client")
 */
class ClientController extends Controller
{
    /**
     * Lists all client entities.
     *
     * @Route("/", name="client_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clients = $em->getRepository('AdminBundle:Client')->findBy(array(), array('clientPosition' => 'ASC'));

        return $this->render('AdminBundle:Client:index.html.twig', array(
            'clients' => $clients,
        ));
    }

    /**
     * Lists all client entities.
     *
     * @Route("/order", name="client_order")
     * @Method("GET")
     */
    public function orderAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clients = $em->getRepository('AdminBundle:Client')->findBy(array(), array('clientPosition' => 'ASC'));

        return $this->render('AdminBundle:Client:order.html.twig', array(
            'clients' => $clients,
        ));
    }

    /**
     * Creates a new client entity.
     *
     * @Route("/new", name="client_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $client = new Client();
        $form = $this->createForm('AdminBundle\Form\ClientType', $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $client->setCreatedAt(new \DateTime("now"));
            $client->setUser( $this->getUser() );
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            if( $request->request->get('saveAndStay') ){
                return $this->redirectToRoute('client_edit', array('id' => $client->getId()));
            }else{
                return $this->redirectToRoute('client_index');
            }
        }

        return $this->render('AdminBundle:Client:new.html.twig', array(
            'client' => $client,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a client entity.
     *
     * @Route("/{id}", name="client_show")
     * @Method("GET")
     */
    public function showAction(Client $client)
    {
        $deleteForm = $this->createDeleteForm($client);

        return $this->render('AdminBundle:Client:show.html.twig', array(
            'client' => $client,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing client entity.
     *
     * @Route("/{id}/edit", name="client_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Client $client)
    {
        $deleteForm = $this->createDeleteForm($client);
        $editForm = $this->createForm('AdminBundle\Form\ClientType', $client);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $client->setUpdatedAt(new \DateTime("now"));
            $client->setUpdateuser( $this->getUser() );
            $this->getDoctrine()->getManager()->flush();

            if( $request->request->get('saveAndStay') ){
                return $this->redirectToRoute('client_edit', array('id' => $client->getId()));
            }else{
                return $this->redirectToRoute('client_index');
            }
        }

        return $this->render('AdminBundle:Client:edit.html.twig', array(
            'client' => $client,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a client entity.
     *
     * @Route("/{id}", name="client_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Client $client)
    {
        $form = $this->createDeleteForm($client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush();
        }

        return $this->redirectToRoute('client_index');
    }

    /**
     * Creates a form to delete a client entity.
     *
     * @param Client $client The client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Client $client)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('client_delete', array('id' => $client->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
