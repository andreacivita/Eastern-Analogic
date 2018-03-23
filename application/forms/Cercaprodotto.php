<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Form_Cercaprodotto extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->setAction('authenticate');
        $this->setName('cerca'); //setta name e id del form

        $this->addElement('text', 'cerca', [
            'filters'    => ['StringTrim'],
            'required'   => true,
            'class'      => 'form-control',

            'placeholder'=> 'Cerca',

        ]);

        $this->addElement('submit', 'Cerca', [
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
