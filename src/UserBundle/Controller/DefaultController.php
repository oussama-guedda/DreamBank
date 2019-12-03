<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\User;
use AppBundle\Entity\Image;
use UserBundle\Form\UserType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user= $this->getUser();
        return $this->render('@User/Default/index.html.twig', array('user' => $user));
    }

    public function modifierAction()
    {
        $user= $this->getUser();

        $form = $this->createForm(UserType::class, $user,
                array('action' => $this->generateUrl('user_modifier_suite',array('id' => $user->getId())) ));
        $form->add('submit', SubmitType::class, array('label' => 'Modifier'));
        return $this->render('@User/Default/modifier.html.twig', array('monFormulaire' => $form->createView(),'user' => $user));
    }

    public function modifierSuiteAction(Request $request, $id) {
        $entityManager = $this->getDoctrine()->getManager();
        $user=$entityManager->getRepository('AppBundle:User')->find($id) ;
        $form = $this->createForm(UserType::class, $user,
        array('action' => $this->generateUrl('user_modifier_suite',
                array('id' => $user->getId())) ));
            $form->add('submit', SubmitType::class, array('label' => 'Modifier'));
            $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {
              $entityManager->persist($user);
             $entityManager->flush();
           $url = $this->generateUrl('user_homepage',array('user'=>$user));
            return $this->redirect($url);}
         return $this>render('@User/Default/modifier.html.twig', array('monFormulaire' => $form->createView()));
    }


}
