<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Locale;
use AdminBundle\Service\LocaleService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Locale controller.
 *
 * @Route("locale")
 */
class LocaleController extends Controller
{

    /**
     * Lists all locale entities.
     *
     * @Route("/", name="locale_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $locales = $em->getRepository('AdminBundle:Locale')->findAll();

        return $this->render('AdminBundle:Locales:index.html.twig', array(
            'locales' => $locales,
        ));
    }

    /**
     * Creates a new locale entity.
     *
     * @Route("/new", name="locale_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $locale = new Locale();
        $form = $this->createForm('AdminBundle\Form\LocaleType', $locale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $locale->setUser( $this->getUser() );
            $locale->setCreatedAt( new \DateTime("now") );
            $em->persist($locale);
            $em->flush();
            
            $path = $this->get('kernel')->getRootDir().'/../config/';
            $service = new LocaleService($path);
            $service->setNewLocales($locale->getSlug());
            $this->cacheSys();
            return $this->redirectToRoute('locale_index');
        }

        return $this->render('AdminBundle:Locales:new.html.twig', array(
            'locale' => $locale,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a locale entity.
     *
     * @Route("/{id}", name="locale_show")
     * @Method("GET")
     */
    public function showAction(Locale $locale)
    {
        $deleteForm = $this->createDeleteForm($locale);

        return $this->render('AdminBundle:Locales:show.html.twig', array(
            'locale' => $locale,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing locale entity.
     *
     * @Route("/{id}/edit", name="locale_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Locale $locale)
    {
        $deleteForm = $this->createDeleteForm($locale);
        $editForm = $this->createForm('AdminBundle\Form\LocaleType', $locale);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('locale_index');
        }

        return $this->render('AdminBundle:Locales:edit.html.twig', array(
            'locale' => $locale,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a locale entity.
     *
     * @Route("/{id}", name="locale_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Locale $locale)
    {
        $form = $this->createDeleteForm($locale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($locale);
            $em->flush();
        }

        return $this->redirectToRoute('locale_index');
    }

    /**
     * Creates a form to delete a locale entity.
     *
     * @param Locale $locale The locale entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Locale $locale)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('locale_delete', array('id' => $locale->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    private function cacheSys(){
        $kernel = $this->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(array(
        'command' => 'cache:clear',
        '--env' => "dev",
        '--no-warmup' => true
        ));
        $output = new BufferedOutput();
        $application->run($input, $output);
        $content = $output->fetch();
    }
}
