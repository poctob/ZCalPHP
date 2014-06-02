<?php

namespace XpressTek\ZCBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('XpressTekZCBundle:Default:index.html.twig', array('name' => $name));
    }
}
