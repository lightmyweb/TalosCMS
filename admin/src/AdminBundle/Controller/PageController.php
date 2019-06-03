<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use MediaBundle\Service\MasnoryGridService;

/**
 * Page controller.
 *
 * @Route("page")
 */
class PageController extends Controller
{
    /**
     * Lists all page entities.
     *
     * @Route("/", name="page_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pages = $em->getRepository('AdminBundle:Page')->findAll();

        return $this->render('AdminBundle:Page:index.html.twig', array(
            'pages' => $pages,
        ));
    }

    /**
     * Creates a new page entity.
     *
     * @Route("/new", name="page_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $page = new Page();
        $form = $this->createForm('AdminBundle\Form\PageType', $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            
            $page->setCreatedAt(new \DateTime("now"));
            $page->setUser( $this->getUser() );
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();
            if(  $request->request->get('resultMasnory') != ''){
                $json = $request->request->get('resultMasnory');
                $json = str_replace('','\"',$json);
                $finalArray = json_decode($json, true);
                $service = new MasnoryGridService($this->getDoctrine()->getManager());
                
                $service->setNewEntries($finalArray,$page,'page');
            }
            if( $request->request->get('saveAndStay') ){
                return $this->redirectToRoute('page_edit', array('id' => $page->getId()));
            }else{
                return $this->redirectToRoute('page_index');
            }
        }

        return $this->render('AdminBundle:Page:new.html.twig', array(
            'page' => $page,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a page entity.
     *
     * @Route("/{id}", name="page_show")
     * @Method("GET")
     */
    public function showAction(Page $page)
    {
        $deleteForm = $this->createDeleteForm($page);

        return $this->render('AdminBundle:Page:show.html.twig', array(
            'page' => $page,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing page entity.
     *
     * @Route("/{id}/edit", name="page_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Page $page)
    {
        $deleteForm = $this->createDeleteForm($page);
        $editForm = $this->createForm('AdminBundle\Form\PageType', $page);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            if(  $request->request->get('resultMasnory') != ''){
                $json = $request->request->get('resultMasnory');
                $json = str_replace('','\"',$json);
                $finalArray = json_decode($json, true);
                $service = new MasnoryGridService($this->getDoctrine()->getManager());
                $service->setNewEntries($finalArray,$page,'page');
            }
            $page->setUpdatedAt(new \DateTime("now"));
            $page->setUpdateuser( $this->getUser() );
            $this->getDoctrine()->getManager()->flush();
            if( $request->request->get('saveAndStay') ){
                return $this->redirectToRoute('page_edit', array('id' => $page->getId()));
            }else{
                return $this->redirectToRoute('page_index');
            }
        }

        return $this->render('AdminBundle:Page:edit.html.twig', array(
            'page' => $page,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a page entity.
     *
     * @Route("/{id}", name="page_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Page $page)
    {
        $form = $this->createDeleteForm($page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($page);
            $em->flush();
        }

        return $this->redirectToRoute('page_index');
    }

    /**
     * Creates a form to delete a page entity.
     *
     * @param Page $page The page entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Page $page)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('page_delete', array('id' => $page->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
