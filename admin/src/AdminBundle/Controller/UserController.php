<?php
namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\Response;
use AdminBundle\Form\UserType;
use AdminBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * users controller.
 *
 * @Route("users")
 */

class UserController extends Controller
{   
        /**
     * Lists all users entities.
     *
     * @Route("/", name="admin_users")
     * @Method("GET")
     */
    public function indexAction()
    {
       
        $page_title = 'Utilisateurs';
        $page_content = 'Liste des utilisateurs';
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository("AdminBundle:User")->findAll();
        $current_user = $this->get('security.token_storage')->getToken()->getUser();
        $current_user_role = $current_user->getRole();
        return $this->render(
            'AdminBundle:User:index.html.twig',
            array(
                'users' => $users,
                'page_title' => $page_title,
                'page_content' => $page_content,
                'current_user_role' => $current_user_role
                )
        );

    }
        /**
     * Creates a new user entity.
     *
     * @Route("/new", name="admin_new_user")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
       // $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $user = new User();
        $form = $this->createForm('AdminBundle\Form\UserType', $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
             if ($form->isValid()){

                $em = $this->getDoctrine()->getManager();

                $plainPassword = $form->get('password')->getData();
                if (!empty($plainPassword))  {  
                    $password = $this->get('security.password_encoder')
                    ->encodePassword($user, $user->getPassword());
                    $user->setPassword($password);
                }
                $user->setDateCreate(new \DateTime('now'));
                $em->persist($user);
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'Ajout effectué avec succès');
                return $this->redirect($this->generateUrl(
                    'admin_users',
                    array('id' => $user->getIdUser())
                ));
            }

        }
        return $this->render('AdminBundle:User:new.html.twig', array(
            'page_title' => 'Ajouter un Utilisateur',
            'form' => $form->createView(),
        ));
    }

        /**
     * edit user entity.
     *
     * @Route("/edit/{id}", name="admin_edit_user")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $data,$id,$result = 0)
    {
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AdminBundle:User')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

       
        $form = $this->createForm('AdminBundle\Form\UserType', $entity, array(
            'action' => $this->generateUrl('admin_update_user', array('id' => $entity->getIdUser())),
            'method' => 'PUT',
        ));

      
        return $this->render('AdminBundle:User:new.html.twig', array(
            'page_title' => 'Modifier l\'utilisateur',
            'form' => $form->createView(),
            'result' =>$data->query->get('result')
        ));
    }

        /**
     * update entity.
     *
     * @Route("/update/{id}", name="admin_update_user")
     * @Method({"GET", "POST","PUT"})
     */
    public function updateAction(Request $request, $id)
    {
        
        
        $em = $this->getDoctrine()->getManager();
        // $user = new User();
        $entity = $em->getRepository('AdminBundle:User')->find($id);
        $originalPassword = $entity->getPassword(); 

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        $editForm = $this->createForm('AdminBundle\Form\UserType', $entity, array(
            'action' => $this->generateUrl('admin_update_user', array('id' => $entity->getIdUser())),
            'method' => 'PUT',
        ));
        
        $editForm->handleRequest($request);
            $result = false;
        if ($editForm->isValid()) {
            
            $plainPassword = $editForm->get('password')->getData();
            if (!empty($plainPassword))  {  
                $password = $this->get('security.password_encoder')
                ->encodePassword($entity, $entity->getPassword());
                $entity->setPassword($password);
            }else{
                $entity->setPassword($originalPassword);
            }
            
            $em->persist($entity);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Mise à jour a été effectuée');
            return $this->redirect(
                $this->generateUrl(
                    'admin_edit_user', 
                    array(
                        'id' => $id,
                        'result'=>1
                    )
                )
            );
        }

        return array(
            'entity'      => $entity,
        );
    }

        /**
     * update statement entity.
     *
     * @Route("/updatestate/{id}", name="admin_updatestate_user")
     * @Method({"GET", "POST","PUT"})
     */
    public function updatestateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:User')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $state = $entity->GetIsActive();

        if(!$state)
            $entity->SetIsActive(true);
        else
            $entity->SetIsActive(false);

        $em->persist($entity);
        $em->flush();

        $request->getSession()->getFlashBag()->add('success', 'Mise à jour a été effectuée');
        return $this->redirect($this->generateUrl('admin_users', array('id' => $id)));

    }

         /**
     * delete
     *
     * @Route("/delete/{id}", name="admin_delete_user")
     * @Method({"GET", "POST","PUT"})
     */
    public function deleteAction(Request $request, $id)
    {   
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AdminBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        $this->findEntitiesRelatedToUSer($id);
        $em->remove($entity);
        $em->flush();
        
        $request->getSession()->getFlashBag()->add('success', 'Suppression effectuée avec succès');
        return $this->redirect($this->generateUrl('admin_users'));
    }


    private function findEntitiesRelatedToUSer($id){
        $em = $this->getDoctrine()->getManager();
        $locales = $em->getRepository('AdminBundle:Locale')->findAll();
        $pages = $em->getRepository('AdminBundle:Page')->findAll();

        foreach ($locales as $element) {
            if ( $element->getUSer()->getIdUser() == $id ){
                $element->setUSer(null);
            }
        }
        foreach ($pages as $element) {
            if ( $element->getUSer()->getIdUser() == $id ){
                $element->setUSer(null);
            }
        }

    }



}
