<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Form_Daticomponente extends Zend_Form
{

    public function init()
    {

        $path=APPLICATION_PATH;
        $path.="/../public/images/componenti/";

        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setName('componente'); //setta name e id del form

        $this->addElement('text', 'marca', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'   => true,
            'placeholder'      => 'Marca del componente',
            'class' => 'form-control'
        ));
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
                array('Size', false, 20480000),
                array('Extension', false, array('jpg', 'png'))),
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
            'placeholder'      => 'Descrizione del componente',
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

