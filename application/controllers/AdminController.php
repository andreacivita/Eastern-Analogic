<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class AdminController extends Zend_Controller_Action
{
    /**
     * Dichiarazione degli attributi utilizzati dalle action del controller.
     * Per il principio dell'information hiding, tutti gli attributi sono stati resi protected e non sono accessibili direttamente.
     */
    protected $_authService;
    protected $active;
    //attributi relative ai centri
    protected $_elencocentri;
    protected $_centroform;
    protected $_centroform2;
    protected $_centroModel;
    //attributi relativi agli utenti
    protected $_utenteModel;
    protected $_utenteform;
    protected $_utenteform2;
    //attributi relativi alle faq
    protected $_faqModel;
    protected $_faqform;
    protected $_faqform2;
    //attributi relativi ai componenti
    protected $_componenteModel;
    protected $_componenteform;
    protected $_componenteform2;
    //attributi relativi ai prodotti
    protected $_prodottoModel;
    protected $_prodottoform;
    protected $_prodottoform2;
    protected $_elencoprodotto;

    //attributi relativi all'elenco dei componenti
    protected $_elencocomponenteModel;
    //attributi relativi all'elenco dei problemi
    protected $_elencoproblemaModel;

    /**
     * Il metodo init viene eseguito prima di qualsiasi Action richiesta dall'utente.
     * Viene sfruttato per creare le instanze delle classi form e model.
     * La variabile active è responsabile della colorazione del menù.
     */
    public function init()
    {
        $this->active = 'gestione';
        $this->view->assign('active', $this->active);
        $this->_authService = new Application_Service_Auth();
        //centri
        $this->_centroModel = new Application_Model_Centro();
        $this->view->centroform = $this->inseriscicentroAction();
        if ($this->_hasParam('idcentro')) {
            $this->view->centroform2 = $this->modificacentroAction();
        }
        //utenti
        $this->_utenteModel = new Application_Model_Utente();
        $this->view->utenteform = $this->inserisciutenteAction();
        if ($this->_hasParam('idutente')) {
            $this->view->utenteform2 = $this->modificautenteAction();
        }
        //faq
        $this->_faqModel = new Application_Model_Faq();
        $this->view->faqform = $this->inseriscifaqAction();
        if ($this->_hasParam('idfaq')) {
            $this->view->faqform2 = $this->modificafaqAction();
        }
        //componente
        $this->_componenteModel = new Application_Model_Componente();
        $this->view->componenteform = $this->inseriscicomponenteAction();
        if ($this->_hasParam('idcomponente')) {
            $this->view->componenteform2 = $this->modificacomponenteAction();
        }
        //prodotto
        $this->_prodottoModel = new Application_Model_Prodotto();
        $this->view->prodottoform = $this->inserisciprodottoAction();
        if ($this->_hasParam('idprodotto')) {
            $this->view->prodottoform2 = $this->modificaprodottoAction();
        }
        $this->_elencocomponenteModel = new Application_Model_Elencocomponenti();
        $this->_elencoproblemaModel = new Application_Model_Elencoproblemi();
    }

    /**
     * il metodo Index Action si occupa esclusivamente di acquisire il nome e il cognome dell'utente connnesso.
     */
    public function indexAction()
    {
        //estraggo i dati relativi al nome e cognome dell'utente.
        $array = $this->_authService->getIdentity()->toArray();
        $datiutente = $array[0];
        $nome = $datiutente['nome'];
        $cognome = $datiutente['cognome'];
        $completo = $nome.' '.$cognome;
        $this->view->assign('nome', $completo);
    }

    /**
     * GESTIONE DEI CENTRI ASSISTENZA.
     */
    public function gestionecentriAction()
    {
        $this->view->headTitle('Eastern Analogic - Gestione Centri Assistenza');
        $this->active = '';
        $this->view->assign('active', $this->active);
        // Controller che visualizza i centri di assistenza

        $this->_elencocentri = $this->_centroModel->getCentro()->toArray();
        //$this->elencocentri contiene TUTTI i centri (esegue una select generica)
        $this->view->assign('elencocentri', $this->_elencocentri);
    }

    public function inseriscicentroAction()
    {
        $this->_centroform = new Application_Form_Daticentro();
        $this->_centroform->setAction('inseriscicentropost');
        //$this->view->form=$this->_centroform;
        return $this->_centroform;
    }

    public function modificacentroAction()
    {
        if ($this->_hasParam('idcentro') == false) {
            $this->_helper->redirector('gestionecentri');
        }
        $idcentro = $this->_getParam('idcentro'); //riceve il parametro dalla url ../idcentro/x
        $this->_centroModel = new Application_Model_Centro();
        $array = $this->_centroModel->getCentroById($idcentro)->toArray();
        $centro = $array[0]; //prendo il primo elemento dell'array (le informazioni del centro) e le metto in una variabile per manipolarla più facilmente
        $this->_centroform2 = new Application_Form_Daticentro();
        $this->_centroform2->populate($centro);
        $this->_centroform2->setAction($this->_helper->url->url([
            'controller' => 'admin',
            'action'     => 'modificacentropost',
            'idcentro'   => $idcentro, ],
            'default'
        ));

        return $this->_centroform2;
    }

    public function eliminacentroAction()
    {
        if ($this->_hasParam('idcentro') == false) {
            $this->_helper->redirector('gestionecentri');
        }
        $idcentro = $this->_getParam('idcentro'); //riceve il parametro dalla url ../idcentro/x
        $this->_centroModel->deleteCentro($idcentro);
        $this->_helper->redirector('gestionecentri');
    }

    public function inseriscicentropostAction()
    {
        $request = $this->getRequest(); //vede se esiste una richiesta
        if (!$request->isPost()) { //controlla che sia stata passata tramite post
            return $this->_helper->redirector('inseriscicentro'); // se non c'è un passaggio tramite post, reindirizza all' inseriscicentroAction
        }

        $form = $this->_centroform;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');

            return $this->render('inseriscicentro');
        }

        $datiform = $form->getValues(); //datiform è un array
        $datiform['interno'] = strtolower($datiform['interno']);
        $this->_centroModel->insertCentro($datiform);
        $this->_helper->redirector('gestionecentri');
        //dopo aver effettuato l'inserimento, rimando l'utente alla schermata di gestione
    }

    public function modificacentropostAction()
    {
        $request = $this->getRequest(); //vede se esiste una richiesta
        if (!$request->isPost()) { //controlla che sia stata passata tramite post
            return $this->_helper->redirector('modificacentro');
            // se non c'è un passaggio tramite post, reindirizza all' inseriscicentroAction
        }

        $form = $this->_centroform2;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');

            return $this->render('modificacentro');
        }

        $datiform = $form->getValues(); //datiform è un array
        $datiform['interno'] = strtolower($datiform['interno']);
        $idcentro = $this->_getParam('idcentro');

        $this->_centroModel->editCentroById($datiform, $idcentro);
        $this->_helper->redirector('gestionecentri');
        //dopo aver effettuato l'inserimento, rimando l'utente alla schermata di gestione
    }

    /* FINE GESTIONE CENTRI */

    /* GESTIONE UTENTI */

    public function gestioneutentiAction()
    {
        $this->view->headTitle('Eastern Analogic - Gestione Utenti');
        $this->active = '';
        $this->view->assign('active', $this->active);
        // Controller che visualizza i centri di assistenza

        $this->_elencoutenti = $this->_utenteModel->getUtente()->toArray();

        $this->view->assign('elencoutenti', $this->_elencoutenti);
        $elencoidcentri = $this->_utenteModel->getUtente();
        $elencocentri = [];
        $elencoidcentri = $elencoidcentri->toArray();
        foreach ($elencoidcentri as $associazione) {
            if (null != $associazione['idcentro']) {
                $centro = $this->_centroModel->getCentroById($associazione['idcentro'])->toArray();
                $informazioni = $centro[0];
                $nome_centro = $informazioni['nome'];
                array_push($elencocentri, ['nomecentro' => $nome_centro]);
            }
        }
        $this->view->assign('elencoutenti', $this->_elencoutenti);
        $this->view->assign('elencocentri', $elencocentri);
    }

    public function inserisciutenteAction()
    {
        $this->_utenteform = new Application_Form_Datiutente();
        $this->_utenteform->setAction('inserisciutentepost');
        //$this->view->form=$this->_centroform;
        return $this->_utenteform;
    }

    public function modificautenteAction()
    {
        if ($this->_hasParam('idutente') == false) {
            $this->_helper->redirector('gestioneutenti');
        }
        $idutente = $this->_getParam('idutente'); //riceve il parametro dalla url ../idcentro/x
        $this->_utenteModel = new Application_Model_Utente();
        $array = $this->_utenteModel->getUtenteExceptPassword($idutente)->toArray();
        $utente = $array[0]; //prendo il primo elemento dell'array (le informazioni del centro) e le metto in una variabile per manipolarla più facilmente

        $this->_utenteform2 = new Application_Form_Datimodificautente();
        $this->_utenteform2->populate($utente);
        $this->_utenteform2->setAction($this->_helper->url->url([
            'controller' => 'admin',
            'action'     => 'modificautentepost',
            'idutente'   => $idutente, ],
            'default'
        ));

        return $this->_utenteform2;
    }

    public function eliminautenteAction()
    {
        if ($this->_hasParam('idutente') == false) {
            $this->_helper->redirector('gestioneutenti');
        }
        $idutente = $this->_getParam('idutente'); //riceve il parametro dalla url ../idcentro/x
        $this->_utenteModel->deleteUtente($idutente);
        $this->_helper->redirector('gestioneutenti');
    }

    public function inserisciutentepostAction()
    {
        $request = $this->getRequest(); //vede se esiste una richiesta
        if (!$request->isPost()) { //controlla che sia stata passata tramite post
            return $this->_helper->redirector('inserisciutente'); // se non c'è un passaggio tramite post, reindirizza all' inseriscicentroAction
        }

        $form = $this->_utenteform;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');

            return $this->render('inserisciutente');
        }

        $datiform = $form->getValues(); //datiform è un array
        $datiform['password'] = md5($datiform['password']);
        $this->_utenteModel->insertUtente($datiform);

        $this->_helper->redirector('gestioneutenti'); //dopo aver effettuato l'inserimento, rimando l'utente alla schermata di gestione
    }

    public function modificautentepostAction()
    {
        $request = $this->getRequest(); //vede se esiste una richiesta
        $idutente = $this->_getParam('idutente');
        if (!$request->isPost()) { //controlla che sia stata passata tramite post
            return $this->_helper->redirector('modificautente');
        }
        $form = $this->_utenteform2;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');

            return $this->render('modificautente');
        }
        $datiform = $form->getValues(); //datiform è un array
        //controllo che la password passata esista.
        //se esiste, creo un hash e la modifico
        if ($datiform['password'] != '') {
            $datiform['password'] = md5($datiform['password']);
        } else {
            //se non esiste una password, allora elimino il valore password dall'array e modifico il record lasciando
            //la vecchia passwrd
            unset($datiform['password']);
        }
        //finito il controllo sulla password, aggiorno il record.
        $this->_utenteModel->editUtenteById($datiform, $idutente);

        $this->_helper->redirector('gestioneutenti'); //dopo aver effettuato l'inserimento, rimando l'utente alla schermata di gestione
    }

    /* FINE GESTIONE UTENTI */

    /* GESTIONE FAQ */

    public function gestionefaqAction()
    {
        $this->view->headTitle('Eastern Analogic - Gestione Faq');
        $this->active = '';
        $this->view->assign('active', $this->active);
        // Controller che visualizza le faq del sito

        $this->_elencofaq = $this->_faqModel->getFaq()->toArray();
        $this->view->assign('elencofaq', $this->_elencofaq);
    }

    public function inseriscifaqAction()
    {
        $this->_faqform = new Application_Form_Datifaq();
        $this->_faqform->setAction('inseriscifaqpost');
        //$this->view->form=$this->_centroform;
        return $this->_faqform;
    }

    public function modificafaqAction()
    {
        if ($this->_hasParam('idfaq') == false) {
            $this->_helper->redirector('gestionefaq');
        }
        $idfaq = $this->_getParam('idfaq'); //riceve il parametro dalla url ../idcentro/x
        $this->_faqModel = new Application_Model_Faq();
        $array = $this->_faqModel->getFaqById($idfaq)->toArray();
        $faq = $array[0]; //prendo il primo elemento dell'array (le informazioni del centro) e le metto in una variabile per manipolarla più facilmente
        $this->_faqform2 = new Application_Form_Datifaq();
        $this->_faqform2->populate($faq);
        $this->_faqform2->setAction($this->_helper->url->url([
            'controller' => 'admin',
            'action'     => 'modificafaqpost',
            'idfaq'      => $idfaq, ],
            'default'
        ));

        return $this->_faqform2;
    }

    public function eliminafaqAction()
    {
        if ($this->_hasParam('idfaq') == false) {
            $this->_helper->redirector('gestionefaq');
        }
        $idfaq = $this->_getParam('idfaq'); //riceve il parametro dalla url ../idcentro/x
        $this->_faqModel->deleteFaq($idfaq);
        $this->_helper->redirector('gestionefaq');
    }

    public function inseriscifaqpostAction()
    {
        $request = $this->getRequest(); //vede se esiste una richiesta
        if (!$request->isPost()) { //controlla che sia stata passata tramite post

            return $this->_helper->redirector('inseriscifaq'); // se non c'è un passaggio tramite post, reindirizza all' inseriscicentroAction
        }

        $form = $this->_faqform;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');

            return $this->render('inseriscifaq');
        }

        $datiform = $form->getValues(); //datiform è un array

        $this->_faqModel->insertFaq($datiform);
        $this->_helper->redirector('gestionefaq'); //dopo aver effettuato l'inserimento, rimando l'utente alla schermata di gestione
    }

    public function modificafaqpostAction()
    {
        $request = $this->getRequest(); //vede se esiste una richiesta
        if (!$request->isPost()) { //controlla che sia stata passata tramite post
            return $this->_helper->redirector('modificafaq'); // se non c'è un passaggio tramite post, reindirizza all' inseriscifaqAction
        }

        $form = $this->_faqform2;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');

            return $this->render('modificafaq');
        }

        $datiform = $form->getValues(); //datiform è un array
        $idfaq = $this->_getParam('idfaq');

        $this->_faqModel->editFaqById($datiform, $idfaq);
        $this->_helper->redirector('gestionefaq'); //dopo aver effettuato l'inserimento, rimando l'utente alla schermata di gestione
    }

    /* FINE GESTIONE FAQ */

    /* GESTIONE COMPONENTE */

    public function gestionecomponentiAction()
    {
        $this->view->headTitle('Eastern Analogic - Gestione Componenti');
        $this->_elencocomponente = $this->_componenteModel->getComponente()->toArray();
        $this->view->assign('elencocomponente', $this->_elencocomponente);
    }

    public function inseriscicomponenteAction()
    {
        $this->_componenteform = new Application_Form_Daticomponente();
        $this->_componenteform->setAction('inseriscicomponentepost');
        //$this->view->form=$this->_centroform;
        return $this->_componenteform;
    }

    public function inseriscicomponentepostAction()
    {
        $request = $this->getRequest(); //vede se esiste una richiesta
        if (!$request->isPost()) { //controlla che sia stata passata tramite post
            return $this->_helper->redirector('inseriscicomponente'); // se non c'è un passaggio tramite post, reindirizza all' inseriscicentroAction
        }

        $form = $this->_componenteform;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');

            return $this->render('inseriscicomponente');
        }
        $generic = 'generic-cpu.jpg';
        $datiform = $form->getValues(); //datiform è un array
        //se la foto non è stata inserita, allora inserisco una foto generica
        if ($datiform['foto'] == '') {
            $datiform['foto'] = $generic;
        }
        $this->_componenteModel->insertComponente($datiform);
        $this->_helper->redirector('gestionecomponenti'); //dopo aver effettuato l'inserimento, rimando l'utente alla schermata di gestione
    }

    public function modificacomponenteAction()
    {
        if ($this->_hasParam('idcomponente') == false) {
            $this->_helper->redirector('gestionecomponenti');
        }
        $idcomponente = $this->_getParam('idcomponente'); //riceve il parametro dalla url ../idcomponente/x
        $this->_componenteModel = new Application_Model_Componente();
        $array = $this->_componenteModel->getComponenteById($idcomponente)->toArray();
        $componente = $array[0]; //prendo il primo elemento dell'array (le informazioni del componente) e le metto in una variabile per manipolarla più facilmente
        $this->_componenteform2 = new Application_Form_Daticomponente();
        $this->_componenteform2->populate($componente);
        $this->_componenteform2->setAction($this->_helper->url->url([
            'controller'   => 'admin',
            'action'       => 'modificacomponentepost',
            'idcomponente' => $idcomponente, ],
            'default'
        ));

        return $this->_componenteform2;
    }

    public function modificacomponentepostAction()
    {
        $request = $this->getRequest(); //vede se esiste una richiesta
        if (!$request->isPost()) { //controlla che sia stata passata tramite post
            return $this->_helper->redirector('modificacomponente'); // se non c'è un passaggio tramite post, reindirizza all' inseriscicomponenteAction
        }
        $form = $this->_componenteform2;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');

            return $this->render('modificacomponente');
        }

        $datiform = $form->getValues(); //datiform è un array
        $idcomponente = $this->_getParam('idcomponente');
        //se non è stata inserita una nuova foto, allora mantengo nel db quella vecchia
        if ($datiform['foto'] == '') {
            unset($datiform['foto']);
        }
        $this->_componenteModel->editComponenteById($datiform, $idcomponente);
        $this->_helper->redirector('gestionecomponenti'); //dopo aver effettuato l'inserimento, rimando l'utente alla schermata di gestione
    }

    public function eliminacomponenteAction()
    {
        if ($this->_hasParam('idcomponente') == false) {
            $this->_helper->redirector('gestionecomponenti');
        }
        $idcomponente = $this->_getParam('idcomponente'); //riceve il parametro dalla url ../idcomponente/x
        $this->_componenteModel->deleteComponente($idcomponente);
        $this->_helper->redirector('gestionecomponenti');
    }

    /* FINE GESTIONE COMPONENTE */

    /* GESTIONE PRODOTTI */

    public function inserisciprodottoAction()
    {
        $this->_prodottoform = new Application_Form_Datiprodotto();
        $this->_prodottoform->setAction('inserisciprodottopost');
        //$this->view->form=$this->_centroform;
        return $this->_prodottoform;
    }

    public function inserisciprodottopostAction()
    {
        $request = $this->getRequest(); //vede se esiste una richiesta
        if (!$request->isPost()) { //controlla che sia stata passata tramite post
            return $this->_helper->redirector('inserisciprodotto'); // se non c'è un passaggio tramite post, reindirizza all' inseriscicentroAction
        }

        $form = $this->_prodottoform;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');

            return $this->render('inserisciprodotto');
        }

        $datiform = $form->getValues(); //datiform è un array
        $datiform['modello'] = strtolower($datiform['modello']);
        $generic = 'generic-server.jpg';
        if ($datiform['foto'] == '') {
            $datiform['foto'] = $generic;
        }

        $this->_prodottoModel->insertProdotto($datiform);
        $this->_helper->redirector('gestioneprodotti', 'staff'); //dopo aver effettuato l'inserimento, rimando l'utente alla schermata di gestione
    }

    public function modificaprodottoAction()
    {
        if ($this->_hasParam('idprodotto') == false) {
            $this->_helper->redirector('gestioneprodotti', 'staff');
        }
        $idprodotto = $this->_getParam('idprodotto'); //riceve il parametro dalla url ../idprodotto/x
        $this->_prodottoModel = new Application_Model_Prodotto();
        $array = $this->_prodottoModel->getProdottoById($idprodotto)->toArray();
        $prodotto = $array[0]; //prendo il primo elemento dell'array (le informazioni del prodotto) e le metto in una variabile per manipolarla più facilmente
        $this->_prodottoform2 = new Application_Form_Datiprodotto();
        $this->_prodottoform2->populate($prodotto);
        $this->_prodottoform2->setAction($this->_helper->url->url([
            'controller' => 'admin',
            'action'     => 'modificaprodottopost',
            'idprodotto' => $idprodotto, ],
            'default'
        ));

        return $this->_prodottoform2;
    }

    public function modificaprodottopostAction()
    {
        $request = $this->getRequest(); //vede se esiste una richiesta
        if (!$request->isPost()) { //controlla che sia stata passata tramite post
            return $this->_helper->redirector('gestioneprodotti', 'staff'); // se non c'è un passaggio tramite post, reindirizza all' inserisciprodottoAction
        }
        $form = $this->_prodottoform2;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');

            return $this->render('modificaprodotto');
        }
        $idprodotto = $this->_getParam('idprodotto');
        $datiform = $form->getValues(); //datiform è un array
        //se la foto non è stata inserita, mantengo la precedente
        if ($datiform['foto'] == '') {
            unset($datiform['foto']);
        }
        $this->_prodottoModel->editProdottoById($datiform, $idprodotto);
        $this->_helper->redirector('gestioneprodotti', 'staff'); //dopo aver effettuato l'inserimento, rimando l'utente alla schermata di gestione
    }

    public function eliminaprodottoAction()
    {
        if ($this->_hasParam('idprodotto') == false) {
            $this->_helper->redirector('gestioneprodotti', 'staff');
        }
        $idprodotto = $this->_getParam('idprodotto'); //riceve il parametro dalla url ../idprodotto/x
        $this->_prodottoModel->deleteProdotto($idprodotto);
        $this->_helper->redirector('gestioneprodotti', 'staff');
    }

    /* FINE GESTIONE PRODOTTI */

    /*associazione componenti */

    public function associacomponentiAction()
    {
        if ($this->_hasParam('idprodotto') == false) {
            $this->_helper->redirector('gestioneprodotti', 'staff');
        }
        $idprodotto = $this->_getParam('idprodotto'); //prendo il parametro idprodotto
        $array = $this->_prodottoModel->getProdottoById($idprodotto)->toArray();
        $nomeprodotto = $array[0]['modello'];
        $this->view->assign('modello', $nomeprodotto);
        $elencocomponentiform = new Application_Form_Elencocomponente();
        $elencocomponentiform->setAction($this->_helper->url->url([
            'controller' => 'admin',
            'action'     => 'associacomponentipost',
            'idprodotto' => $idprodotto, ],
            'default'
        ));
        $this->view->assign('elencocomponenti', $elencocomponentiform);
        $elencocomponentiModel = new Application_Model_ElencoComponenti();
        $associazioni = $elencocomponentiModel->getElencoByProdotto($idprodotto)->toArray();

        $elencoassociazioni = [];

        $c = 0;
        foreach ($associazioni as $associazione) {
            $vettore = $associazioni[$c];

            $idassociazione = $vettore['idelencocomponenti'];

            $componente = $this->_componenteModel->getComponenteById($vettore['idcomponente'])->toArray();

            $dati = $componente[0];

            array_push($elencoassociazioni, ['idassociazione' => $idassociazione, 'componente'=>$dati['modello'], 'idprodotto'=> $idprodotto]);
            $c++;
        }

        $this->view->assign(['elencoassociazioni' => $elencoassociazioni]);
    }

    public function associacomponentipostAction()
    {
        $idprodotto = $this->_getParam('idprodotto');
        $idcomponente = $this->_getParam('idcomponente');
        $dati = [];
        $dati['idprodotto'] = $idprodotto;
        $dati['idcomponente'] = $idcomponente;

        $this->_elencocomponenteModel = new Application_Model_ElencoComponenti();
        $this->_elencocomponenteModel->insertElencoItem($dati);
        $params = [];
        $params['idprodotto'] = $idprodotto;
        $this->_helper->redirector('associacomponenti',
            'admin',
            null,
            ['idprodotto' => $idprodotto]);
    }

    public function eliminaassociazionecomponenteAction()
    {
        if ($this->_hasParam('idassociazione') == false) {
            $this->_helper->redirector('gestioneprodotti', 'staff');
        }
        $idass = $this->_getParam('idassociazione');
        $idprodotto = $this->_getParam('idprodotto');
        $this->_elencocomponenteModel = new Application_Model_ElencoComponenti();

        $this->_elencocomponenteModel->deleteElencoItem($idass);
        $this->_helper->redirector('associacomponenti',
            'admin',
            null,
            ['idprodotto' => $idprodotto]);
    }
}
