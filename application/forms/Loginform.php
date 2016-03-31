<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Form_Loginform extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setAction('authenticate');
        $this->setName('contatti'); //setta name e id del form

        $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'class'      => 'form-control',

            'placeholder'=> 'Email',

        ));

        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'         => true,
            'placeholder'      => 'Password',
            'class' => 'form-control'
        ));
        $this->addElement('submit', 'Invia', array(
            'class' => 'btn btn-success'
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));

    }


}

