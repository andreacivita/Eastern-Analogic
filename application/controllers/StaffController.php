<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class StaffController extends Zend_Controller_Action
{

    protected $_problemaModel;
    protected $_problemaform;
    protected $_problemaform2;
    protected $_elencoModel;
    protected $_prodottoModel;

    public function init()
    {
        //problema
        $this->_problemaModel= new Application_Model_Problema();
        $this->view->problemaform=$this->inserisciproblemaAction();
        if ($this->_hasParam('idproblema')) {
            $this->view->problemaform2 = $this->modificaproblemaAction();
        }
        $this->_prodottoModel= new Application_Model_Prodotto();
        $this->_elencoModel= new Application_Model_Elencoproblemi();
    }

    public function indexAction()
    {
        // action body
    }


    public function gestioneprodottiAction()
    {
        $this->view->headTitle('Eastern Analogic - Gestione Prodotti');
        $this->_elencoprodotto=$this->_prodottoModel->getProdotto()->toArray();
        $this->view->assign('elencoprodotto', $this->_elencoprodotto);

    }

    /* gestione associazione problemi -> prodotto */
    public function associaproblemiAction(){
        if ($this->_hasParam('idprodotto')==false)
            $this->_helper->redirector('gestioneprodotti', 'staff');

        $idprodotto=$this->_getParam('idprodotto'); //prendo il parametro idprodotto
        $idprodotto=$this->_getParam('idprodotto'); //prendo il parametro idprodotto
        $array=$this->_prodottoModel->getProdottoById($idprodotto)->toArray();
        $nomeprodotto=$array[0]['modello'];

        $this->view->assign('modello',$nomeprodotto);
        $elencoproblemiModel= new Application_Model_Elencoproblemi();
        $associazioni=$elencoproblemiModel->getElencoByProdotto($idprodotto)->toArray();

        $elencoassociazioni=array();

        $c=0;
        foreach($associazioni as $associazione){

            $problema=$associazioni[$c];
            $idassociazione=$problema['idelencoproblemi'];


            $prodotto=$this->_problemaModel->getProblemaById($problema['idproblema'])->toArray();


            $dati=$prodotto[0];


            array_push($elencoassociazioni,array("idassociazione" => $idassociazione, "problema"=>$dati['problema'], "idprodotto"=> $idprodotto));
            $c++;
        }

        $this->view->assign(array('elencoassociazioni' => $elencoassociazioni));



        $elencoproblemiform= new Application_Form_Elencoproblema();
        $elencoproblemiform->setAction($this->_helper->url->url(array(
            'controller' => 'staff',
            'action' => 'associaproblemipost',
            'idprodotto' => $idprodotto),
            'default'
        ));
        $this->view->assign('elencoproblemi', $elencoproblemiform);


    }

    public function associaproblemipostAction(){
        $idprodotto=$this->_getParam('idprodotto');
        $idproblema=$this->_getParam('idproblema');
        $dati= array();
        $dati['idprodotto']=$idprodotto;
        $dati['idproblema']=$idproblema;

        $this->_elencoModel->insertElencoItem($dati);
        $params=array();
        $params['idprodotto']=$idprodotto;
        $this->_helper->redirector('associaproblemi',
            'staff',
            null,
            array('idprodotto' => $idprodotto));



    }

    public function eliminaassociazioneAction() {
        $idass=$this->_getParam('idassociazione');
        $idprodotto=$this->_getParam('idprodotto');
        $this->_elencoModel->deleteElencoItem($idass);
        $this->_helper->redirector('associaproblemi',
            'staff',
            null,
            array('idprodotto' => $idprodotto));

    }

    /* gestione problemi */

    public function gestioneproblemiAction()
    {
        $this->view->headTitle('Eastern Analogic - Gestione problemi');
        $this->_elencoproblema=$this->_problemaModel->getProblema()->toArray();
        $this->view->assign('elencoproblemi', $this->_elencoproblema);
    }
    public function inserisciproblemaAction()
    {
        $this->_problemaform= new Application_Form_Datiproblema();
        $this->_problemaform->setAction("inserisciproblemapost");
        return $this->_problemaform;
    }
    public function inserisciproblemapostAction()
    {
        $request = $this->getRequest(); //vede se esiste una richiesta
        if (!$request->isPost()) { //controlla che sia stata passata tramite post
            return $this->_helper->redirector('inserisciproblema'); // se non c'è un passaggio tramite post, reindirizza all' inseriscicentroAction
        }
        $form=$this->_problemaform;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('inserisciproblema');
        }

        $datiform=$form->getValues(); //datiform è un array


        $this->_problemaModel->insertProblema($datiform);
        $this->_helper->redirector('gestioneproblemi'); //dopo aver effettuato l'inserimento, rimando l'utente alla schermata di gestione

    }

    public function modificaproblemaAction()
    {
        if ($this->_hasParam('idproblema')==false)
            $this->_helper->redirector('gestioneproblemi');
        $idproblema=$this->_getParam('idproblema'); //riceve il parametro dalla url ../idproblema/x
        $this->_problemaModel=new Application_Model_Problema();
        $array=$this->_problemaModel->getProblemaById($idproblema)->toArray();
        $problema=$array[0]; //prendo il primo elemento dell'array (le informazioni del problema) e le metto in una variabile per manipolarla più facilmente
        $this->_problemaform2= new Application_Form_Datiproblema();
        $this->_problemaform2->populate($problema);
        $this->_problemaform2->setAction($this->_helper->url->url(array(
            'controller' => 'staff',
            'action' => 'modificaproblemapost',
            'idproblema' => $idproblema),
            'default'
        ));

        return $this->_problemaform2;

    }

    public function modificaproblemapostAction()
    {
        $request = $this->getRequest(); //vede se esiste una richiesta
        if (!$request->isPost()) { //controlla che sia stata passata tramite post
            return $this->_helper->redirector('modificaproblema'); // se non c'è un passaggio tramite post, reindirizza all' inserisciproblemaAction
        }



        $form=$this->_problemaform2;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('modificaproblema');
        }

        $datiform=$form->getValues(); //datiform è un array

        $idproblema=$this->_getParam('idproblema');


        $this->_problemaModel->editproblemaById($datiform, $idproblema);
        $this->_helper->redirector('gestioneproblemi'); //dopo aver effettuato l'inserimento, rimando l'utente alla schermata di gestione

    }
    public function eliminaproblemaAction()
    {
        if ($this->_hasParam('idproblema')==false)
            $this->_helper->redirector('gestioneproblemi');
        $idproblema=$this->_getParam('idproblema'); //riceve il parametro dalla url ../idproblema/x
        $this->_problemaModel->deleteproblema($idproblema);
        $this->_helper->redirector('gestioneproblemi');
    }

    /*fine problemi*/



}

