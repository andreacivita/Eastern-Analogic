<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Form_Cercaprodotto extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setAction('authenticate');
        $this->setName('cerca'); //setta name e id del form

        $this->addElement('text', 'cerca', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'class'      => 'form-control',

            'placeholder'=> 'Cerca',

        ));


        $this->addElement('submit', 'Cerca', array(
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

