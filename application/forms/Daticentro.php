<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Form_Daticentro extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setName('centro'); //setta name e id del form
        $this->addElement('text', 'nome', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64)),


            ),
            'required'   => true,
            'placeholder'      => 'Nome del centro',
            'class' => 'form-control'
        ));
        $this->addElement('text', 'telefono', array(
            'filters' => array('StringTrim', 'Digits'),
            'class' => 'form-control',
            'required'   => true,
            'placeholder' => 'Telefono del Centro'

        ));
        $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array( 'EmailAddress','StringLength', true, array(3, 64)
                )
            ),
            'required'   => true,
            'class'      => 'form-control',

            'placeholder'=> 'Email del Centro',

        ));
        $this->addElement('text', 'interno', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(2, 2))
            ),
            'required'   => true,
            'placeholder'      => 'Centro interno (si/no)',
            'class' => 'form-control'
        ));
        $this->addElement('text', 'coordinate', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'placeholder'      => 'Coordinate ',
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

