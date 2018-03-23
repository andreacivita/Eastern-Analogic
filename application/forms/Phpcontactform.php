<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Form_Phpcontactform extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->setAction('mail');
        $this->setName('contatti'); //setta name e id del form
        $this->addElement('text', 'name', [
            'filters'    => ['StringTrim'],
            'validators' => [
                ['StringLength', true, [3, 64]],
            ],
            'required'         => true,
            'placeholder'      => 'Nome e Cognome',
            'class'            => 'form-control',
        ]);
        $this->addElement('text', 'email', [
            'filters'    => ['StringTrim'],
            'validators' => [
                ['EmailAddress', 'StringLength', true, [3, 64],
                ],
            ],
            'required'   => true,
            'class'      => 'form-control',

            'placeholder'=> 'Email',

        ]);
        $this->addElement('text', 'mobile', [
            'filters'     => ['StringTrim', 'Digits'],
            'class'       => 'form-control',
            'placeholder' => 'Telefono',

        ]);
        $this->addElement('textarea', 'msg', [
        'filters'      => ['StringTrim'],
            'required' => true,
        'class'        => 'form-control',
        'placeholder'  => 'Il tuo Messaggio',

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
