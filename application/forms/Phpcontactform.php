<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Form_Phpcontactform extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setAction('mail');
        $this->setName('contatti'); //setta name e id del form
        $this->addElement('text', 'name', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'   => true,
            'placeholder'      => 'Nome e Cognome',
            'class' => 'form-control'
        ));
        $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array( 'EmailAddress','StringLength', true, array(3, 64)
                )
            ),
            'required'   => true,
            'class'      => 'form-control',

            'placeholder'=> 'Email',

        ));
        $this->addElement('text', 'mobile', array(
            'filters' => array('StringTrim', 'Digits'),
            'class' => 'form-control',
            'placeholder' => 'Telefono'

        ));
        $this->addElement('textarea', 'msg', array(
        'filters' => array('StringTrim'),
            'required' => true,
        'class' => 'form-control',
        'placeholder' => 'Il tuo Messaggio'

    ));
        $this->addElement('submit', 'Invia', array(
        'class' => 'btn btn-success btn-lg'
    ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));

    }


}

