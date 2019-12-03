<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        return $this->render('accueil/accueil.html.twig');
    }

    /**
     * @Route("/home", name="home_direction")
     */
    public function redirectAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');

        if($authChecker->isGranted('ROLE_ADMIN')){
            return $this->render('@EasyAdmin/default/layout.html.twig');
        }elseif ($authChecker->isGranted('ROLE_USER')){
            $user= $this->getUser();
            return $this->render('@User/Default/index.html.twig', array('user' => $user));
        }else{
            return $this->render('views/Default/index.html.twig');
        }

    }
    
    /**
    	* @Route("/{_locale}/", name="translation_twig")
    */
    public function translationTwig() {
    	return $this->render('accueil/accueil.html.twig');
    }    
    
    /**
    	* @Route("/{_locale}/contact", name="contact")
    */
    public function translationContactTwig() {
    	return $this->render('autres/contact.html.twig');
    }
    
    /**
    	* @Route("/{_locale}/about-us", name="about-us")
    */
    public function translationAboutUsTwig() {
    	return $this->render('autres/about-us.html.twig');
    }
    
    /**
    	* @Route("/{_locale}/notice", name="notice")
    */
    public function translationNoticeTwig() {
    	return $this->render('autres/notice.html.twig');
    }
}
