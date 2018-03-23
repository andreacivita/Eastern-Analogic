<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Model_Acl extends Zend_Acl
{
    public function __construct()
    {
        $this->addRole(new Zend_Acl_Role('guest'))
             ->add(new Zend_Acl_Resource('error'))
             ->add(new Zend_Acl_Resource('index'))
             ->add(new Zend_Acl_Resource('public'))
             ->allow('guest', ['error', 'index', 'public']);

        $this->addRole(new Zend_Acl_Role('user'), 'guest')
             ->add(new Zend_Acl_Resource('user'))
             ->allow('user', 'user');

        $this->addRole(new Zend_Acl_Role('tecnico'), 'user')
             ->add(new Zend_Acl_Resource('tecnico'))
             ->allow('tecnico', 'tecnico');

        $this->addRole(new Zend_Acl_Role('staff'), 'tecnico')
             ->add(new Zend_Acl_Resource('staff'))
             ->allow('staff', 'staff');

        $this->addRole(new Zend_Acl_Role('admin'), 'staff')
             ->add(new Zend_Acl_Resource('admin'))
             ->allow('admin', 'admin');
    }
}
