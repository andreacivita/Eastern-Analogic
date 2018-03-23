<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Form_Datiprodotto extends Zend_Form
{
    public function init()
    {
        $path = APPLICATION_PATH;
        $path .= '/../public/images/prodotti/';

        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setName('prodotto'); //setta name e id del form

        $this->addElement('text', 'modello', [
            'filters'    => ['StringTrim'],
            'validators' => [
                ['StringLength', true, [3, 64]],
            ],
            'required'         => true,
            'placeholder'      => 'Nome del modello',
            'class'            => 'form-control',
        ]);
        $this->addElement('file', 'foto', [

            'destination' => $path,
            'validators'  => [

                ['Count', false, 1],
                ['Size', false, 2048000],
                ['Extension', false, ['jpg', 'png', 'gif']], ],
            'class' => 'form-control',

        ]);
        $this->addElement('textarea', 'descrizione', [
            'cols'       => '50',
            'rows'       => '10',
            'filters'    => ['StringTrim'],
            'validators' => [
                ['StringLength', true, [3]],
            ],
            'required'         => true,
            'placeholder'      => 'Descrizione del prodotto',
            'class'            => 'form-control',
        ]);
        $this->addElement('textarea', 'installazione', [
            'cols'       => '50',
            'rows'       => '10',
            'filters'    => ['StringTrim'],
            'validators' => [
                ['StringLength', true, [3]],
            ],
            'required'         => true,
            'placeholder'      => 'Modalità di installazione',
            'class'            => 'form-control',
        ]);
        $this->addElement('textarea', 'uso', [
            'cols'       => '50',
            'rows'       => '10',
            'filters'    => ['StringTrim'],
            'validators' => [
                ['StringLength', true, [3]],
            ],
            'required'         => true,
            'placeholder'      => 'Note di buon uso',
            'class'            => 'form-control',
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
