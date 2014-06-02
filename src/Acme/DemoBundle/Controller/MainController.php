<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * Description of MainController
 *
 * @author Alex Pavlunenko <alexp at xpresstek.net>
 */
class MainController {
    //put your code here
    public function contactAction()
    {
        return new Response('<h1>Contact page</h1>');
    }
}
