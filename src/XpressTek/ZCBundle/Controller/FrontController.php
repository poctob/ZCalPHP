<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace XpressTek\ZCBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of FrontController
 *
 * @author Alex Pavlunenko <alexp at xpresstek.net>
 */
class FrontController extends Controller{
    
    public function indexAction()
    {
        return $this->render
                ('XpressTekZCBundle:Front:index.html.twig');
    }
}
