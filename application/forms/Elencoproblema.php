<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Form_Elencoproblema extends Zend_Form
{
    protected $_problemiModel;

    public function init()
    {
        $this->setMethod('post');

        $this->setName('elencoproblema'); //setta name e id del form
        $categories = []; //dichiaro un array che conterrà le opzioni della select
        $this->_problemiModel = new Application_Model_Problema(); //creo un istanza del model centro.
        $cats = $this->_problemiModel->getProblema()->toArray(); //creo un array chiamato cats che conterrà tutti i problemi

        foreach ($cats as $cat) {
            $categories[$cat['idproblema']] = $cat['problema'];
        }

        $this->addElement('select', 'idproblema', [
            'required'     => true,
            'multiOptions' => $categories,
            'class'        => 'form-control',
        ]);

        $this->addElement('submit', 'Associa', [
            'class' => 'btn btn-success btn-lg',
        ]);

        $this->setDecorators([
            'FormElements',
            ['HtmlTag', ['tag' => 'table', 'class' => 'zend_form']],
            ['Description', ['placement' => 'prepend', 'class' => 'formerror']],
            'Form',
        ]);
    }
}
