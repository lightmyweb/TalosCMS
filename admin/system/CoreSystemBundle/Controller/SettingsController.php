<?php

namespace CoreSystemBundle\Controller;

use CoreSystemBundle\Entity\Settings;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Setting controller.
 *
 * @Route("settings")
 */
class SettingsController extends Controller
{
    /**
     * Displays a form to edit an existing setting entity.
     *
     * @Route("/{id}/edit", name="settings_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Settings $setting)
    {
        $editForm = $this->createForm('CoreSystemBundle\Form\SettingsType', $setting);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('settings_edit', array('id' => $setting->getId()));
        }

        return $this->render('CoreSystemBundle:Settings:edit.html.twig', array(
            'setting' => $setting,
            'edit_form' => $editForm->createView(),
        ));
    }

}
