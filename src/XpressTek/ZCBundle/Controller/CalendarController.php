<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace XpressTek\ZCBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use XpressTek\ZCBundle\Form\CalendarType;
use XpressTek\ZCBundle\Entity\Calendar;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of CalendarController
 *
 * @author Alex Pavlunenko <alexp at xpresstek.net>
 */
class CalendarController extends Controller {

    public function listAction(Request $request) {

        $calendar = new Calendar();
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


            return $this->redirect($this->generateUrl('list_calendars'));
        }
        return $this->render
                        ('XpressTekZCBundle:Back:index.html.twig', array('calendar_form' => $calendar_form->createView()));
    }

    private function getTemplate(Calendar $calendar) {
        $calendar_form = $this->createForm('calendar', $calendar);
        $template = $this->renderView
                ('XpressTekZCBundle:Back:index.html.twig', 
                array('calendar_form' => $calendar_form->createView()));

        return $template;
    }

    /**
     * 
     * @return array
     * @Rest\View()
     */
    public function listJsonAction() {
        $calendars = $this->getDoctrine()
                ->getRepository('XpressTekZCBundle:Calendar')
                ->findAll();
        
        $calendars_json = $this->container->get('serializer')->serialize($calendars, 'json');

        return new Response($calendars_json);
    }

    /**
     * 
     * @param \XpressTek\ZCBundle\Entity\Calendar $calendar
     * @return array
     * @Rest\View()
     * @ParamConverter("calendar", class="XpressTekZCBundle:Calendar")     * 
     */
    public function getCalendarAction(Calendar $calendar) {
        return array('calendar' => $calendar);
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $calendar = $em->getRepository('XpressTekZCBundle:Calendar')
                ->find($id);
        $em->remove($calendar);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
                'notice', 'Item Deleted'
        );
        return $this->newAction();
    }

    public function newAction() {
        $calendar = new Calendar();        
        return new Response($this->getTemplate($calendar));
    }

    public function editAction($id) {
        $calendar = $this->getDoctrine()
                ->getRepository('XpressTekZCBundle:Calendar')
                ->find($id);
        return new Response($this->getTemplate($calendar));
    }

}
