<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Form_Loginform extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->setAction('authenticate');
        $this->setName('contatti'); //setta name e id del form

        $this->addElement('text', 'email', [
            'filters'    => ['StringTrim'],
            'required'   => true,
            'class'      => 'form-control',

            'placeholder'=> 'Email',

        ]);

        $this->addElement('password', 'password', [
            'filters'    => ['StringTrim'],
            'validators' => [
                ['StringLength', true, [3, 64]],
            ],
            'required'         => true,
            'placeholder'      => 'Password',
            'class'            => 'form-control',
        ]);
        $this->addElement('submit', 'Invia', [
            'class' => 'btn btn-success',
        ]);

        $this->setDecorators([
            'FormElements',
            ['HtmlTag', ['tag' => 'table', 'class' => 'zend_form']],
            ['Description', ['placement' => 'prepend', 'class' => 'formerror']],
            'Form',
        ]);
    }
}
