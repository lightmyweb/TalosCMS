<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Project controller.
 *
 * @Route("project")
 */
class ProjectController extends Controller
{
    /**
     * Lists all project entities.
     *
     * @Route("/", name="project_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('AdminBundle:Project')->findBy(array(), array('projectPosition' => 'ASC'));

        return $this->render('AdminBundle:Project:index.html.twig', array(
            'projects' => $projects,
        ));
    }

    /**
     * Creates a new project entity.
     *
     * @Route("/new", name="project_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $project = new Project();
        $form = $this->createForm('AdminBundle\Form\ProjectType', $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $project->setCreatedAt(new \DateTime("now"));
            $project->setUser( $this->getUser() );

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            if( $request->request->get('saveAndStay') ){
                return $this->redirectToRoute('project_edit', array('id' => $project->getId()));
            }else{
                return $this->redirectToRoute('project_index');
            }
        }

        return $this->render('AdminBundle:Project:new.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * Lists all project entities.
     *
     * @Route("/order", name="project_order")
     * @Method("GET")
     */
    public function orderAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('AdminBundle:Project')->findBy(array(), array('projectPosition' => 'ASC'));

        return $this->render('AdminBundle:Project:order.html.twig', array(
            'projects' => $projects,
        ));
    }

    /**
     * Displays a form to edit an existing project entity.
     *
     * @Route("/{id}/edit", name="project_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Project $project)
    {
        $deleteForm = $this->createDeleteForm($project);
        $editForm = $this->createForm('AdminBundle\Form\ProjectType', $project);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $project->setUpdatedAt(new \DateTime("now"));
            $project->setUpdateuser( $this->getUser() );
            $this->getDoctrine()->getManager()->flush();

            if( $request->request->get('saveAndStay') ){
                return $this->redirectToRoute('project_edit', array('id' => $project->getId()));
            }else{
                return $this->redirectToRoute('project_index');
            }
        }

        return $this->render('AdminBundle:Project:edit.html.twig', array(
            'project' => $project,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a project entity.
     *
     * @Route("/{id}", name="project_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Project $project)
    {
        $form = $this->createDeleteForm($project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();
        }

        return $this->redirectToRoute('project_index');
    }

    /**
     * Creates a form to delete a project entity.
     *
     * @param Project $project The project entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Project $project)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('project_delete', array('id' => $project->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
