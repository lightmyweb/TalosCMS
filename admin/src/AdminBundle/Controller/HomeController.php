<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Home;
use AdminBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Home controller.
 *
 * @Route("home")
 */
class HomeController extends Controller
{
    /**
     * Lists all home entities.
     *
     * @Route("/", name="home_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $homes = $em->getRepository('AdminBundle:Home')->findAll();

        return $this->render('AdminBundle:Home:index.html.twig', array(
            'homes' => $homes,
        ));
    }

    /**
     * Lists all project entities.
     *
     * @Route("/order", name="home_order")
     * @Method("GET")
    */
    public function orderAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('AdminBundle:Project')->findBy(
            array(), 
            array('projectinhomeposition' => 'ASC'));

        return $this->render('AdminBundle:Home:order.html.twig', array(
            'projects' => $projects,
        ));
    }

    // public function uppdateOrderProjectHomeAction($entity = null ,$value = null){
    //     $result = 0;
    //     $project = $this->em->getRepository('AdminBundle:Project')->findOneById($value);
    //     if( $project  ){
    //         $project->setProjectPositionHome();
    //         $this->em->flush();
    //         return 1;
    //     }

    //     dump($value);die;
    // }

    /**
     * Creates a new home entity.
     *
     * @Route("/new", name="home_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $home = new Home();
        $form = $this->createForm('AdminBundle\Form\HomeType', $home);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $home->setCreatedAt(new \DateTime("now"));
            $home->setUser( $this->getUser() );
            $em = $this->getDoctrine()->getManager();
            $em->persist($home);
            $em->flush();

            return $this->redirectToRoute('home_edit', array('id' => $home->getId()));
        }

        return $this->render('AdminBundle:Home:new.html.twig', array(
            'home' => $home,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a home entity.
     *
     * @Route("/{id}", name="home_show")
     * @Method("GET")
     */
    public function showAction(Home $home)
    {
        $deleteForm = $this->createDeleteForm($home);

        return $this->render('AdminBundle:Home:show.html.twig', array(
            'home' => $home,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing home entity.
     *
     * @Route("/{id}/edit", name="home_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Home $home)
    {
        $deleteForm = $this->createDeleteForm($home);
        $editForm = $this->createForm('AdminBundle\Form\HomeType', $home);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
           
            foreach ($em->getRepository('AdminBundle:Project')->findAll() as $project ) {
                $project->setHome(null);
            }
            

            $home->setUpdatedAt(new \DateTime("now"));
            $home->setUpdateuser( $this->getUser() );
            
            foreach ($request->request->get('adminbundle_home')['projects'] as $id ) {
                $em->getRepository('AdminBundle:Project')->findOneById($id)->setHome($home);
            }
           
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute('home_edit', array('id' => $home->getId()));
        }

        return $this->render('AdminBundle:Home:edit.html.twig', array(
            'home' => $home,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a home entity.
     *
     * @Route("/{id}", name="home_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Home $home)
    {
        $form = $this->createDeleteForm($home);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($home);
            $em->flush();
        }

        return $this->redirectToRoute('home_index');
    }

    /**
     * Creates a form to delete a home entity.
     *
     * @param Home $home The home entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Home $home)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('home_delete', array('id' => $home->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
