<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Form_Datifaq extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');

        $this->setName('faq'); //setta name e id del form
        $this->addElement('textarea', 'domanda', [
            'cols'       => '50',
            'rows'       => '3',
            'filters'    => ['StringTrim'],
            'validators' => [
                ['StringLength', true, [3, 150]],
            ],
            'required'         => true,
            'placeholder'      => 'Domanda',
            'class'            => 'form-control',
        ]);

        $this->addElement('textarea', 'risposta', [
            'cols'       => '50',
            'rows'       => '10',
            'filters'    => ['StringTrim'],
            'validators' => [
                ['StringLength', true, [3, 400]],
            ],
            'required'         => true,
            'placeholder'      => 'Risposta',
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
