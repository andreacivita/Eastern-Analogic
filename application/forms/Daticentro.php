<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Form_Daticentro extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('centro'); //setta name e id del form
        $this->addElement('text', 'nome', [
            'filters'    => ['StringTrim'],
            'validators' => [
                ['StringLength', true, [3, 64]],

            ],
            'required'         => true,
            'placeholder'      => 'Nome del centro',
            'class'            => 'form-control',
        ]);
        $this->addElement('text', 'telefono', [
            'filters'     => ['StringTrim', 'Digits'],
            'class'       => 'form-control',
            'required'    => true,
            'placeholder' => 'Telefono del Centro',

        ]);
        $this->addElement('text', 'email', [
            'filters'    => ['StringTrim'],
            'validators' => [
                ['EmailAddress', 'StringLength', true, [3, 64],
                ],
            ],
            'required'   => true,
            'class'      => 'form-control',

            'placeholder'=> 'Email del Centro',

        ]);
        $this->addElement('text', 'interno', [
            'filters'    => ['StringTrim'],
            'validators' => [
                ['StringLength', true, [2, 2]],
            ],
            'required'         => true,
            'placeholder'      => 'Centro interno (si/no)',
            'class'            => 'form-control',
        ]);
        $this->addElement('text', 'coordinate', [
            'filters'          => ['StringTrim'],
            'required'         => true,
            'placeholder'      => 'Coordinate ',
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
