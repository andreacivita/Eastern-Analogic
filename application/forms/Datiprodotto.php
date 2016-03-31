<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Form_Datiprodotto extends Zend_Form
{

    public function init()
    {

        $path=APPLICATION_PATH;
        $path.="/../public/images/prodotti/";

        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setName('prodotto'); //setta name e id del form

        $this->addElement('text', 'modello', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'   => true,
            'placeholder'      => 'Nome del modello',
            'class' => 'form-control'
        ));
        $this->addElement('file', 'foto', array(

            'destination' => $path,
            'validators' => array(

                array('Count', false, 1),
                array('Size', false, 2048000),
                array('Extension', false, array('jpg', 'png', 'gif'))),
            'class' => 'form-control'

        ));
        $this->addElement('textarea', 'descrizione', array(
            'cols'    =>    '50',
            'rows'    =>    '10',
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3))
            ),
            'required'   => true,
            'placeholder'      => 'Descrizione del prodotto',
            'class' => 'form-control'
        ));
        $this->addElement('textarea', 'installazione', array(
            'cols'    =>    '50',
            'rows'    =>    '10',
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3))
            ),
            'required'   => true,
            'placeholder'      => 'Modalità di installazione',
            'class' => 'form-control'
        ));
        $this->addElement('textarea', 'uso', array(
            'cols'    =>    '50',
            'rows'    =>    '10',
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3))
            ),
            'required'   => true,
            'placeholder'      => 'Note di buon uso',
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

