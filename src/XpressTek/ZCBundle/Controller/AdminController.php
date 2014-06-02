<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace XpressTek\ZCBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use XpressTek\ZCBundle\Form\CalendarType;
use XpressTek\ZCBundle\Entity\Calendar;
use Symfony\Component\HttpFoundation\Request;


/**
 * Description of AdminController
 *
 * @author Alex Pavlunenko <alexp at xpresstek.net>
 */
class AdminController extends Controller {

    public function indexAction(Request $request) {

   /*     $calendar = new Calendar();
        $calendar_form = $this->createForm(new CalendarType(), $calendar);

        $calendar_form->handleRequest($request);
        if ($calendar_form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $cal_id = $calendar->getId();
            if ($cal_id > 0) {
                $new_calendar = $em->getRepository('XpressTekZCBundle:Calendar')
                        ->find($cal_id);

                $new_calendar->cloneEntity($calendar);


                $this->get('session')->getFlashBag()->add(
                        'notice', 'Item Saved'
                );
            } else {
                $em->persist($calendar);
                $this->get('session')->getFlashBag()->add(
                        'notice', 'Item Created');
            }
            $em->flush();


            return $this->redirect($this->generateUrl('admin'));
        }
        return $this->render
                        ('XpressTekZCBundle:Back:index.html.twig', array('calendar_form' => $calendar_form->createView(),
                    'calendars' => $calendars));*/
    }

}
