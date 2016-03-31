<?php
/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */
class App_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract 
{
	protected $_acl;
	protected $_role;
	protected $_auth;

	public function __construct()
	{
        $this->_auth = Zend_Auth::getInstance();
        if($this->_auth->hasIdentity()) {
            $temparray = $this->_auth->getIdentity()->toArray(); //il risultato di getIdentity->toArray è un array il cui primo elemento è un vettore.
            $array = $temparray[0]; //perciò, inserisco il primo elemento dell'array temporaneo all'interno di questa variabile, che potrò usare come un array associativo.
            $this->_role = $array['ruolo'];
        }
        else {
            $this->_role = 'guest';
        }
    	$this->_acl = new Application_Model_Acl();    	
	}

    public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		if (!$this->_acl->isAllowed($this->_role, $request->getControllerName()))
			if($this->_role=='guest') $this->_request->setModuleName('default')->setControllerName('index')->setActionName('index');
			else $this->_request->setModuleName('default')->setControllerName('user')->setActionName('index');
	}
}
