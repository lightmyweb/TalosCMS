<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Seo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Seo controller.
 *
 * @Route("seo")
 */
class SeoController extends Controller
{
    /**
     * Lists all seo entities.
     *
     * @Route("/", name="seo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $seos = $em->getRepository('AdminBundle:Seo')->findAll();

        return $this->render('seo/index.html.twig', array(
            'seos' => $seos,
        ));
    }

    /**
     * Creates a new seo entity.
     *
     * @Route("/new", name="seo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $seo = new Seo();
        $form = $this->createForm('AdminBundle\Form\SeoType', $seo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($seo);
            $em->flush();

            return $this->redirectToRoute('seo_show', array('id' => $seo->getId()));
        }

        return $this->render('seo/new.html.twig', array(
            'seo' => $seo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a seo entity.
     *
     * @Route("/{id}", name="seo_show")
     * @Method("GET")
     */
    public function showAction(Seo $seo)
    {
        $deleteForm = $this->createDeleteForm($seo);

        return $this->render('seo/show.html.twig', array(
            'seo' => $seo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing seo entity.
     *
     * @Route("/{id}/edit", name="seo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Seo $seo)
    {
        $deleteForm = $this->createDeleteForm($seo);
        $editForm = $this->createForm('AdminBundle\Form\SeoType', $seo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seo_edit', array('id' => $seo->getId()));
        }

        return $this->render('seo/edit.html.twig', array(
            'seo' => $seo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a seo entity.
     *
     * @Route("/{id}", name="seo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Seo $seo)
    {
        $form = $this->createDeleteForm($seo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seo);
            $em->flush();
        }

        return $this->redirectToRoute('seo_index');
    }

    /**
     * Creates a form to delete a seo entity.
     *
     * @param Seo $seo The seo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Seo $seo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seo_delete', array('id' => $seo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
