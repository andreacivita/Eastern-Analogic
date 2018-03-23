<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Form_Daticomponente extends Zend_Form
{
    public function init()
    {
        $path = APPLICATION_PATH;
        $path .= '/../public/images/componenti/';

        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setName('componente'); //setta name e id del form

        $this->addElement('text', 'marca', [
            'filters'    => ['StringTrim'],
            'validators' => [
                ['StringLength', true, [3, 64]],
            ],
            'required'         => true,
            'placeholder'      => 'Marca del componente',
            'class'            => 'form-control',
        ]);
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

            'validators' => [
                ['Count', false, 1],
                ['Size', false, 20480000],
                ['Extension', false, ['jpg', 'png']], ],
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
            'placeholder'      => 'Descrizione del componente',
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
