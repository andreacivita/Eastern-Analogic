<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class UserController extends Zend_Controller_Action
{
    protected $_authService;

    public function init()
    {
        $this->_authService = new Application_Service_Auth();
    }

    public function indexAction()
    {
        /*
         * ATTENZIONE: Il controller USER ha lo scopo di gestire due condizioni: indirizzare l'utente al proprio pannello e gestire il logout.
         * l'indexAction controlla il ruolo dell'utente che ha effettuato il login, e reindirizza l'utente nel proprio controller
         * Es: utente loggato = tecnico => redirect a TecnicoController
         */

        //questo script converte il risultato della getIdentity in un array, e lo memorizza dentro array. Il risultato è un array
        //in cui al primo posto (indice 0) è memorizzato il vettore che contiene le informazioni dell'utente loggato.
        $array = $this->_authService->getIdentity()->toArray();
        $ruolo = $array[0]['ruolo']; //In questo modo estraggo il ruolo dell'utente loggato dall'array e lo memorizzo in una variabile
        //controllo il ruolo ed eseguo il redirect
        if ($ruolo == 'admin') {
            $this->_helper->redirector('index', 'admin');
        }
        if ($ruolo == 'staff') {
            $this->_helper->redirector('index', 'staff');
        }
        if ($ruolo == 'tecnico') {
            $this->_helper->redirector('index', 'public');
        }
        // se per qualche motivo il ruolo non combacia con nessuno dei precedenti ma l'utente è comunque riuscito ad accedere
        // all'UserController, allora lo reindirizzo verso il controller public.

        $this->_helper->redirector('index', 'public');
    }

    public function logoutAction()
    {
        //elimino l'identità del login e reindirizzo l'utente alla parte pubblica del sito
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index', 'public');
    }
}
