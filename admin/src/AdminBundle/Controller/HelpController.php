<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Help;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Help controller.
 *
 * @Route("help")
 */
class HelpController extends Controller
{
    /**
     * Finds and displays a help entity.
     *
     * @Route("/{id}", name="help_show")
     * @Method("GET")
     */
    public function showAction(Help $help)
    {
        return $this->render('AdminBundle:Help:show.html.twig', array(
            'help' => $help,
            'datas' => $this->getData($help),
        ));
    }

    /**
     * Displays a form to edit an existing help entity.
     *
     * @Route("/{id}/edit", name="help_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Help $help)
    {
        $editForm = $this->createForm('AdminBundle\Form\HelpType', $help);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $help->setUpdatedAt(new \DateTime("now"));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('help_edit', array('id' => $help->getId()));
        }

        return $this->render('AdminBundle:Help:edit.html.twig', array(
            'help' => $help,
            'edit_form' => $editForm->createView(),
        ));
    }
    private function getData($element){
        $dataArray = array();
        foreach ($element->getSections() as $section) {
            $dataArray[]=array(
                'title'=>$section->getTitle(),
                'description'=>$section->getDescription(),
            );
        }
        return $dataArray;
    }
}
