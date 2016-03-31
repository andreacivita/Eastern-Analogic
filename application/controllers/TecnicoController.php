<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class TecnicoController extends Zend_Controller_Action
{

    protected $_componente;
    protected $_componenteModel;

    public function init()
    {
        $this->_componenteModel= new Application_Model_Componente();
    }

    public function indexAction()
    {
        // action body
    }
    public function visualizzacomponenteAction()
    {
        if ($this->_hasParam('idcomponente')) {

            $idcomponente = $this->_getParam('idcomponente'); //prendo il parametro idprodotto
            $this->_componente = $this->_componenteModel->getComponenteById($idcomponente)->toArray();
            $this->view->assign('componente', $this->_componente);
        }
        else {

            if ($this->_hasParam('idprodotto')) {
                $this->_helper->redirector('schedaprodotto',
                    'public',
                    null,
                    array('idprodotto' => $this->_getParam('idprodotto')));
            }
            $this->_helper->redirector('elencoprodotti', 'public');
        }
    }


}

