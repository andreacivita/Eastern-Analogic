<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Form_Datimodificautente extends Zend_Form
{

    protected $_centriModel;

    public function init()
    {
        $this->setMethod('post');

        $this->setName('utente'); //setta name e id del form
        $this->addElement('text', 'nome', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'   => true,
            'placeholder'      => 'Nome',
            'class' => 'form-control'
        ));
        $this->addElement('text', 'cognome', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'   => true,
            'placeholder'      => 'Cognome',
            'class' => 'form-control'
        ));

        $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64)
                )
            ),
            'required'   => true,
            'class'      => 'form-control',

            'placeholder'=> 'Email',

        ));
        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'   => false,
            'placeholder'      => 'Lascia la password vuota per non modificare',
            'class' => 'form-control'
        ));
        $this->addElement('select', 'ruolo', array(

            'multiOptions' => array('tecnico' => 'Tecnico', 'staff' => 'Staff', 'admin' => 'Amministratore'),
            'class' => 'form-control'
        ));
        $categories = array(); //dichiaro un array che conterrà le opzioni della select

        $this->_centriModel = new Application_Model_Centro(); //creo un istanza del model centro.
        $cats = $this->_centriModel->getCentro()->toArray(); //creo un array chiamato cats che conterrà tutti i centri


       foreach ($cats as $cat) {
            $categories[$cat['idcentro']] = $cat['nome'];
        }


        $this->addElement('select', 'idcentro', array(
            'required' => true,
            'multiOptions' => $categories,
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

