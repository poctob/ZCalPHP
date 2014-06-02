<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace XpressTek\ZCBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use XpressTek\ZCBundle\Entity\Event;
use Symfony\Component\HttpFoundation\Response;
use XpressTek\ZCBundle\Form\EventType;

/**
 * Description of EventController
 *
 * @author Alex Pavlunenko <alexp at xpresstek.net>
 */
class EventController extends Controller {

    public function listAction($calendar_id) {
        /*  $event = new Event();
          $event_form = $this->createForm(new EventType(), $event);

          $event_form->handleRequest($request);
          if ($event_form->isValid()) {

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


          return $this->redirect($this->generateUrl('list_calendars'));
          } */

        $event = new Event();
        $event_form = $this->createForm(new EventType(), $event);

       // $event_form->handleRequest($request);
         return $this->render
                        ('XpressTekZCBundle:Back:events.html.twig', 
                 array('event_form' => $event_form->createView(),
                     'calendar_id' => $calendar_id));
    }

    /**
     * 
     * @return array
     */
    public function listJsonAction() {
        $events = $this->getDoctrine()
                ->getRepository('XpressTekZCBundle:Event')
                ->findAll();

        $events_json = $this->container->get('serializer')->serialize($events, 'json');

        return new Response($events_json);
    }

    private function getTemplate(Event $event) {
        $event_form = $this->createForm('event', $event);
        $template = $this->renderView
                ('XpressTekZCBundle:Back:events.html.twig', 
                array('event_form' => $event_form->createView()));

        return $template;
    }

    public function newAction(Request $request) {
        $event = new Event();
        $event_form = $this->createForm('event', $event);
        $event_form->handleRequest($request);
        if($event_form->isValid())
        {
             $em = $this->getDoctrine()->getManager();
        }
        return new Response($this->getTemplate($event));
    }

}
