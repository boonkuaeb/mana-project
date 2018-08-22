<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("about/{name}", name="about_page", defaults={"name"=null})
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aboutAction($name)
    {
        if ($name) {
            $user = $this->getDoctrine()
                ->getRepository('AppBundle:User')
                ->findOneBy(array('name'=>$name));

            if (false === $user instanceof User) {
                throw $this->createNotFoundException(
                    'No user named '.$name.' found!'
                );
            }
        }
        return $this->render('about/index.html.twig', array('user' => $user));
    }
}
