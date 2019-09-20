<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Press;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Press controller.
 *
 * @Route("press")
 */
class PressController extends Controller
{
    /**
     * Lists all press entities.
     *
     * @Route("/", name="press_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $presses = $em->getRepository('AdminBundle:Press')->findBy(array(), array('pressPosition' => 'ASC'));

        return $this->render('AdminBundle:Press:index.html.twig', array(
            'presses' => $presses,
        ));
    }

    /**
     * Lists all press entities.
     *
     * @Route("/order", name="press_order")
     * @Method("GET")
     */
    public function orderAction()
    {
        $em = $this->getDoctrine()->getManager();

        $presses = $em->getRepository('AdminBundle:Press')->findBy(array(), array('pressPosition' => 'ASC'));

        return $this->render('AdminBundle:Press:order.html.twig', array(
            'presses' => $presses,
        ));
    }

    /**
     * Creates a new press entity.
     *
     * @Route("/new", name="press_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $press = new Press();
        $form = $this->createForm('AdminBundle\Form\PressType', $press);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $press->setCreatedAt(new \DateTime("now"));
            $press->setUser( $this->getUser() );
            $em = $this->getDoctrine()->getManager();
            $em->persist($press);
            $em->flush();

            if( $request->request->get('saveAndStay') ){
                return $this->redirectToRoute('press_edit', array('id' => $press->getId()));
            }else{
                return $this->redirectToRoute('press_index');
            }
        }

        return $this->render('AdminBundle:Press:new.html.twig', array(
            'press' => $press,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a press entity.
     *
     * @Route("/{id}", name="press_show")
     * @Method("GET")
     */
    public function showAction(Press $press)
    {
        $deleteForm = $this->createDeleteForm($press);

        return $this->render('AdminBundle:Press:show.html.twig', array(
            'press' => $press,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing press entity.
     *
     * @Route("/{id}/edit", name="press_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Press $press)
    {
        $deleteForm = $this->createDeleteForm($press);
        $editForm = $this->createForm('AdminBundle\Form\PressType', $press);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $press->setUpdatedAt(new \DateTime("now"));
            $press->setUpdateuser( $this->getUser() );
            $this->getDoctrine()->getManager()->flush();

            if( $request->request->get('saveAndStay') ){
                return $this->redirectToRoute('press_edit', array('id' => $press->getId()));
            }else{
                return $this->redirectToRoute('press_index');
            }
        }

        return $this->render('AdminBundle:Press:edit.html.twig', array(
            'press' => $press,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a press entity.
     *
     * @Route("/{id}", name="press_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Press $press)
    {
        $form = $this->createDeleteForm($press);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($press);
            $em->flush();
        }

        return $this->redirectToRoute('press_index');
    }

    /**
     * Creates a form to delete a press entity.
     *
     * @param Press $press The press entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Press $press)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('press_delete', array('id' => $press->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
