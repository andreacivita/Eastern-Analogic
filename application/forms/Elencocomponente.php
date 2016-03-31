<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Form_Elencocomponente extends Zend_Form
{

    protected $_componenteModel;
    public function init()
    {
        $this->setMethod('post');


        $this->setName('elencocomponente'); //setta name e id del form
        $categories = array(); //dichiaro un array che conterrà le opzioni della select
        $this->_componenteModel = new Application_Model_Componente(); //creo un istanza del model centro.
        $cats = $this->_componenteModel->getComponente()->toArray(); //creo un array chiamato cats che conterrà tutti i problemi


        foreach ($cats as $cat) {
            $categories[$cat['idcomponente']] = $cat['modello'];
        }


        $this->addElement('select', 'idcomponente', array(
            'required' => true,
            'multiOptions' => $categories,
            'class' => 'form-control'
        ));



        $this->addElement('submit', 'Associa', array(
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

