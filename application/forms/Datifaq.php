<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Form_Datifaq extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');

        $this->setName('faq'); //setta name e id del form
        $this->addElement('textarea', 'domanda', array(
            'cols'    =>    '50',
            'rows'    =>    '3',
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 150))
            ),
            'required'   => true,
            'placeholder'      => 'Domanda',
            'class' => 'form-control'
        ));

        $this->addElement('textarea', 'risposta', array(
            'cols'    =>    '50',
            'rows'    =>    '10',
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 400))
            ),
            'required'   => true,
            'placeholder'      => 'Risposta',
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

