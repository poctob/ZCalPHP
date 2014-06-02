<?php

namespace XpressTek\ZCBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CalendarType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('id', 'hidden')
                ->add('name')
                ->add('isActive', 'checkbox', array('required' => false))
                ->add('startDate', 'date', array('widget' => 'single_text'))
                ->add('endDate', 'date', array('widget' => 'single_text'))
                ->add('save', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'XpressTek\ZCBundle\Entity\Calendar',
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'calendar';
    }

}
