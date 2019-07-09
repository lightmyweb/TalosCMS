<?php
 

namespace AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Security;
use AdminBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\JsonResponse;


class LoginController extends Controller
{
    public function indexAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){
            return $this->redirectToRoute('backend_index');
        }
        $session = $request->getSession();
        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(Security::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
            $session->remove(Security::AUTHENTICATION_ERROR);
        }
        return $this->render('AdminBundle:Login:index.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(Security::LAST_USERNAME),
            'error'         => $error,
            'project_name' => $this->container->getParameter('project_name') 
        ));

    }

    public function motPasseOublieAction(Request $data){
        $em = $this->getDoctrine()->getManager();
        $salt = $data->query->get('u');
        $hostname = $data->getHost();
        if(isset($salt)){
            $user = $em->getRepository('AdminBundle:User')->findBy(
                array(
                    'salt'=>$salt,
                )
            );
            if(isset($user[0])){
                return $this->render('AdminBundle:Login:mot_passe_oublie.html.twig', array(
                    'salt' => $salt,
                ));
            }
        }
        $email = $data->request->get('email') ;https://lightmyweb.fr/v2/web/
        $user = $em->getRepository('AdminBundle:User')->findBy(
            array(
                'email'=>$email,
            )
        );
        if(isset($user[0])){
            $em = $this->getDoctrine()->getManager();
            $projectTitle = $em->getRepository('AdminBundle:Settings')->findOneById(1)->getTitle();
            $projectEmail = $em->getRepository('AdminBundle:Settings')->findOneById(1)->getEmail();
            $lien = $hostname.$this->generateUrl('admin_mot_passe_oublie').'?u='.$user[0]->getSalt();
            $message = 'Bonjour '.$user[0]->getFirstName().',<br><br>';
            $message .= 'Nous avons reçu une demande de réinitialisation de votre mot de passe '.$projectTitle.'.<br><br>';
            $message .= '<a href="'.$lien.'">Cliquez ici pour changer votre mot de passe.</a>';  
            $subject = 'Réinitialisation du mot de passe Infocancer';
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $headers .= "From: ".$projectTitle." <".$projectEmail.">" . "\r\n";
            mail($email, $subject, $message, $headers);            
            $dataArray = array(
                'result' => 1
            );
            return new JsonResponse($dataArray);
        }
        $dataArray = array(
            'result' => 0
        );
        return new JsonResponse($dataArray);
    }
    public function nouveauMotPasseAction(Request $data){
        $em = $this->getDoctrine()->getManager();

        $new_password = $data->request->get('new_password');
        $salt = $data->request->get('salt');

        $user = $em->getRepository('AdminBundle:User')->findBy(
            array(
                'salt'=>$salt,
            )
        );

        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user[0], $new_password);

        $user[0]->setPassword($encoded);

        $this->getDoctrine()->getManager()->flush();

        return $this->render('AdminBundle:Login:mot_passe_oublie.html.twig', array(
            'confirme_new_password' => '1',
        ));
    }
}
