<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace XpressTek\ZCBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use XpressTek\ZCBundle\Entity\Event;
use XpressTek\ZCBundle\Entity\Calendar;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use XpressTek\ZCBundle\Form\EventType;

/**
 * Description of EventController
 *
 * @author Alex Pavlunenko <alexp at xpresstek.net>
 */
class EventController extends Controller {

    public function listAction($calendar_id) {
        return $this->render
                        ('XpressTekZCBundle:Back:events.html.twig', array('calendar_id' => $calendar_id));
    }

    /**
     * Asyncronously returns list of events for a specified calendar in JSON
     * format
     * @param $calendar_id Id of the calendar
     * @return array
     */
    public function listJsonAction($calendar_id) {

        $events_json = "";
        if ($calendar_id > 0) {            
            $calendar = $this->getDoctrine()
                    ->getRepository('XpressTekZCBundle:Calendar')
                    ->find($calendar_id);

            $events_json = $this->container->get('serializer')->serialize($calendar->getEvents(), 'json');
        }
        return new Response($events_json);
    }

    private function getTemplate(Event $event) {
        $event_form = $this->createForm('event', $event);
        $template = $this->renderView
                ('XpressTekZCBundle:Back:events.html.twig', array('event_form' => $event_form->createView()));

        return $template;
    }

    /**
     * Adds new event to the database
     * @param Integer $calendar_id Id of the calendar
     * @param \Symfony\Component\HttpFoundation\Request $request Form data
     * @return type Rendered page.
     */
    public function newAction($calendar_id, Request $request) {
        $this->processRequest($calendar_id, $request);
        $event = new Event();
        $event_form = $this->createForm(new EventType(), $event);

        return $this->render
                        ('XpressTekZCBundle:Back:event_new.html.twig', array('event_form' => $event_form->createView(),
                    'calendar_id' => $calendar_id));
    }

    private function processRequest($calendar_id, Request $request) {
        if (isset($request)) {
            $event = new Event();
            $event_form = $this->createForm('event', $event);
            $event_form->handleRequest($request);
            if ($event_form->isValid()) {
                
                $request_event=$request->request->get("event");
                $days = array();
                
                foreach($event->getWeekDayKeys() as $key => $value)
                {
                    if(array_key_exists($key, $request_event))
                    {
                        $days[$key] = $request_event[$key];
                    }
                }   
                $event->setWeekdayMask($days);

                $em = $this->getDoctrine()->getManager();
                
                $event_id = $event->getId();
                if ($event_id > 0) {
                    $new_event = $em->getRepository('XpressTekZCBundle:Event')
                            ->find($event_id);
                    $new_event->cloneEntity($event);

                    $this->get('session')->getFlashBag()->add(
                            'notice', 'Item Saved');
                } else {
                    
                    $calendar = $em->find('XpressTekZCBundle:Calendar', 
                            $calendar_id);
                    
                    $calendar->addEvent($event);
                    $event->setCalendar($calendar);
                    $em->persist($event);
                    $this->get('session')->getFlashBag()->add(
                            'notice', 'Item Created');
                }
                $em->flush();
            }
        }
    }

}
