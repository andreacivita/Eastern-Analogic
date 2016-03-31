<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Form_Datiproblema extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');

        $this->setName('problema'); //setta name e id del form
        $this->addElement('textarea', 'problema', array(
            'cols'    =>    '50',
            'rows'    =>    '3',
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'   => true,
            'placeholder'      => 'Inserisci una breve descrizione del malfunzionamento',
            'class' => 'form-control'
        ));

        $this->addElement('textarea', 'soluzione', array(
            'cols'    =>    '50',
            'rows'    =>    '10',
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3))
            ),
            'required'   => true,
            'placeholder'      => 'Inserisci la soluzione del malfunzionamento',
            'class' => 'form-control'
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

