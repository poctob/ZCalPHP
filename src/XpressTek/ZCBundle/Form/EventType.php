<?php

namespace XpressTek\ZCBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('id', 'hidden')
                ->add('calendar_id', 'hidden')
                ->add('title')
                ->add('validFrom','date', array('widget' => 'single_text'))
                ->add('validTo','date', array('widget' => 'single_text'))
                ->add('startTime', 'time', array('widget' => 'single_text'))
                ->add('endTime','time', array('widget' => 'single_text'))
                ->add('isAllDay','checkbox', array('required' => false))
                ->add('everyDay', null, array('mapped' => false, 'required' => false))
                ->add('Monday', null, array('mapped' => false,'required' => false))
                ->add('Tuesday', null, array('mapped' => false,'required' => false))
                ->add('Wednesday', null, array('mapped' => false,'required' => false))
                ->add('Thursday', null, array('mapped' => false,'required' => false))
                ->add('Friday', null, array('mapped' => false,'required' => false))
                ->add('Saturday', null, array('mapped' => false,'required' => false))
                ->add('Sunday', null, array('mapped' => false,'required' => false))
                ->add('save', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'XpressTek\ZCBundle\Entity\Event',
            'csrf_protection' => true
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'event';
    }

}
