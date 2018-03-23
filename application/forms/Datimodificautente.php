<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Form_Datimodificautente extends Zend_Form
{
    protected $_centriModel;

    public function init()
    {
        $this->setMethod('post');

        $this->setName('utente'); //setta name e id del form
        $this->addElement('text', 'nome', [
            'filters'    => ['StringTrim'],
            'validators' => [
                ['StringLength', true, [3, 64]],
            ],
            'required'         => true,
            'placeholder'      => 'Nome',
            'class'            => 'form-control',
        ]);
        $this->addElement('text', 'cognome', [
            'filters'    => ['StringTrim'],
            'validators' => [
                ['StringLength', true, [3, 64]],
            ],
            'required'         => true,
            'placeholder'      => 'Cognome',
            'class'            => 'form-control',
        ]);

        $this->addElement('text', 'email', [
            'filters'    => ['StringTrim'],
            'validators' => [
                ['StringLength', true, [3, 64],
                ],
            ],
            'required'   => true,
            'class'      => 'form-control',

            'placeholder'=> 'Email',

        ]);
        $this->addElement('password', 'password', [
            'filters'    => ['StringTrim'],
            'validators' => [
                ['StringLength', true, [3, 64]],
            ],
            'required'         => false,
            'placeholder'      => 'Lascia la password vuota per non modificare',
            'class'            => 'form-control',
        ]);
        $this->addElement('select', 'ruolo', [

            'multiOptions' => ['tecnico' => 'Tecnico', 'staff' => 'Staff', 'admin' => 'Amministratore'],
            'class'        => 'form-control',
        ]);
        $categories = []; //dichiaro un array che conterrà le opzioni della select

        $this->_centriModel = new Application_Model_Centro(); //creo un istanza del model centro.
        $cats = $this->_centriModel->getCentro()->toArray(); //creo un array chiamato cats che conterrà tutti i centri

       foreach ($cats as $cat) {
           $categories[$cat['idcentro']] = $cat['nome'];
       }

        $this->addElement('select', 'idcentro', [
            'required'     => true,
            'multiOptions' => $categories,
            'class'        => 'form-control',
        ]);

        $this->addElement('submit', 'Invia', [
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
