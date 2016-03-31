<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class PublicController extends Zend_Controller_Action
{
    protected $elencocentri;
    protected $elencofaq;
    protected $_form;
    protected $_loginform;
    protected $_authService;
    protected $active;
    protected $_prodottoModel;
    protected $_componenteModel;
    protected $_elencocomponenteModel;
    protected $_problemaModel;
    protected $_elencoproblemaModel;
    protected $_cercaform;


    public function init()
    {
        $this->active=""; //inizializzo variabile active. Questa variabile serve per assegnare la classe css "active" agli elementi <li> del menù
        $this->_authService = new Application_Service_Auth();
        $this->view->form=$this->contattiAction();
        $this->view->loginform=$this->loginAction();
        $this->view->cercaform=$this->elencoprodottiAction();
        $this->_problemaModel= new Application_Model_Problema();
        $this->_componenteModel= new Application_Model_Componente();


    }

    public function indexAction()
    {
        $this->view->headTitle('Eastern Analogic - Tower, Rack & Blade Server');
        $this->active="index"; //assegno alla variabile il nome dell'action. In questo modo, avrò contenuti diversi a seconda della view da visualizzare.
        $this->view->assign('active', $this->active);

    }
    public function aboutAction()
    {
        $this->active="about";
        $this->view->assign('active', $this->active);
        $this->view->headTitle('Eastern Analogic - Chi siamo');

    }
    public function loginAction()
    {
        $this->active="null";
        $this->view->assign('active', $this->active);
        $this->_loginform= new Application_Form_Loginform();
        return $this->_loginform;

    }

    public function authenticateAction()
    {
        $this->view->headTitle('Eastern Analogic - Login');

        $request = $this->getRequest(); //vede se esiste una richiesta

        if (!$request->isPost()) { //controlla che sia stata passata tramite post
            return $this->_helper->redirector('login'); // se non c'è un passaggio tramite post, reindirizza al loginAction
        }
        $logform=$this->_loginform;

        if (!$logform->isValid($request->getPost())) {
            $logform->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('login');
        }
        $datiform=$logform->getValues();
        $datiform['password']=md5($datiform['password']);
        if (false === $this->_authService->authenticate($datiform)) {
            $logform->setDescription('Autenticazione fallita. Riprova');
            return $this->render('login');
        }
        $this->_authService->getIdentity()->ruolo;

        if(Zend_Auth::getInstance()->hasIdentity())
        {
            $this->_helper->redirector('index', 'user');
        }
    }

    public function centriAction()
    {
        $this->view->headTitle('Eastern Analogic - Centri Assistenza');
        $this->active="centri";
        $this->view->assign('active', $this->active);
        // Controller che visualizza i centri di assistenza
        $centro= new Application_Model_Centro();
        $this->elencocentri=$centro->getCentro()->toArray(); //$this->elencocentri contiene TUTTI i centri (esegue una select generica)
       /*
       INTEGRAZIONE GOOGLE MAPS
       Nel codice JavaScript per creare una mappa con i relativi marker esiste una variabile chiamata location.
       Questa variabile contiene tutti i dati relativi ai marker (punti di riferimento nella mappa) in questo formato
       var location = [ ['marker1','dati1'],['marker2','dati2'] ];
       il codice seguente estrae dall'array elencocentri TUTTI i dati dei centri assistenza e li inserisce nella variabile $stringa,
       che sarà formattata per essere identica a location (var js).
       */
        $stringa="var locations = [ ";
        $turl1 = $this->view->baseUrl('images/map-green.png'); //setto la posizione del file map-green.png dentro alla variabile turl1( temp - url)
        $turl2 = $this->view->baseUrl('images/map-purple.png');
        $url1=", '". $turl1 ."']"; //url1 conterrà la posizione del segnaposto verde della mappa
        $url2=", '". $turl2 ."']"; //url1 conterrà la posizione del segnaposto viola della mappa
        $i=0; //variabile contatore
        foreach ($this->elencocentri as $array)
        {

            if ($i > 1) { //seguendo il formato della variabile location ( [],[],[]) , so che ogni elemento separa il successivo da una virgola.
            //se i è > 0 allora significa che non sto analizzando il primo elemento, e dunque dovrò inserire una virgola.
                $stringa.=",";
                //il  controllo è in testa alla creazione della stringa perchè cosi una volta arrivato all'ultimo elemento non verrà inserita una virgola
                //se fosse stato in coda, avrei trovato gli elemeni in questo formato
                //[],[],[], <- anche l'ultimo elemento ha una virgola, e non rispetta il formato di google -> [],[].[]
            }
            $i++;
            if ($array['idcentro']!=1):

            $nome=$array['nome'];
            $telefono=$array['telefono'];
            $email=$array['email'];
            $coordinate=$array['coordinate'];
            //estraggo tutti i dati dell'array in variabili
            $stringa.="['". $nome . " ', 'undefined', '" . $telefono . "', '".$email." ', 'undefined', ".$coordinate; //creo la stringa
            if ($array['interno']=="si")
               $stringa .=  $url1; //se il centro è dell'azienda, allora assegno il puntatore verde
            else
                $stringa .=  $url2; //se è un centro assistenza esterno, assegno il puntatore viola
                endif;
        }
        //una volta uscito dal ciclo posso chiudere la stringa
        $stringa .= "  ];";
        $this->view->assign('location', $stringa); //la assegno alla view. verrà mostrata all'interno dello script js
        //<script>
        //istruzioni varie in js
        //<?php echo $this->location;
        //</script>
        //in questo modo, il server processerà tutta la pagina view, e invierà al client una funzione javascript settata con i dati del database.
    }

    public function faqAction()
    {
        $this->view->headTitle('Eastern Analogic - Faq');
        $this->active="faq";
        $this->view->assign('active', $this->active);
        $faq= new Application_Model_Faq();
        $this->elencofaq=$faq->getFaq()->toArray(); //$this->elencofaq contiene TUTTE le faq (esegue una select generica)
        $this->view->assign('elenco',$this->elencofaq);
        //print_r($this->elencofaq);


    }

    public function contattiAction()
    {

        $this->active="contatti";
        $this->view->assign('active', $this->active);
        $this->_form= new Application_Form_Phpcontactform(); //instanzio una form
        return $this->_form;

    }

    public function mailAction()
    {

        $request = $this->getRequest(); //vede se esiste una richiesta
        if (!$request->isPost()) { //controlla che sia stata passata tramite post
            return $this->_helper->redirector('contatti'); // se non c'è un passaggio tramite post, reindirizza al contattiAction
        }


        $form=$this->_form;


       if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('contatti');
        }

       $datiform=$form->getValues();

        $name    = $datiform["name"];
        $email   = $datiform["email"];
        $mobile  = $datiform["mobile"];
        $msg     = $datiform["msg"];
        $to      = $email; //la mail torna al mittente (usata per test)
        //$to='email@dominio.it';

        if (isset($email) && isset($name) && isset($msg)) {


        $subject = $name . " ha inviato un messaggio";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
        $headers .= "From: ".$name." <".$email.">\r\n"."Reply-To: ".$email."\r\n" ;
        $msg     = "From: $name<br/> Email: $email <br/> Mobile: $mobile <br/>Message: $msg";



        $mail =  mail($to, $subject, $msg, $headers);

        if($mail)
        {
            $class="alert alert-success";
            $strong="Congratulazioni!";
            $text=" Il tuo messaggio è stato inviato correttamente";
            $this->view->assign('class',$class);
            $this->view->assign('strong',$strong);
            $this->view->assign('text',$text);
        }

        else
        {
            $class="alert alert-error";
            $strong="Ops!";
            $text=" Sembra che il tuo messaggio non sia stato invato";
            $this->view->assign('class',$class);
            $this->view->assign('strong',$strong);
            $this->view->assign('text',$text);

        }

         }

    }
    public function elencoprodottiAction(){
        $this->active="prodotti";
        $this->view->assign('active', $this->active);
        $this->_prodottoModel=new Application_Model_Prodotto();
        $this->_elencoprodotto=$this->_prodottoModel->getProdotto()->toArray();
        $this->view->assign('elencoprodotto', $this->_elencoprodotto);
        $this->_cercaform= new Application_Form_Cercaprodotto();
        $this->_cercaform->setAction("cercaprodotto");
        return $this->_cercaform;


    }
    public function schedaprodottoAction(){
        if($this->_hasParam('idprodotto')==false)
                $this->_helper->redirector('elencoprodotti', 'public');
        $this->active="prodotti";
        $this->view->assign('active', $this->active);
        $idprodotto=$this->_getParam('idprodotto');
        $this->_prodottoModel=new Application_Model_Prodotto();
        $array=$this->_prodottoModel->getProdottoById($idprodotto)->toArray();
        $prodotto=$array[0]; //prendo il primo elemento dell'array (le informazioni del prodotto) e le metto in una variabile per manipolarla più facilmente
        $this->view->assign('prodotto', $prodotto);
        //mi creo il vettore dei problemi corrispondenti
        $idprodotto=$this->_getParam('idprodotto'); //prendo il parametro idprodotto
        //visualizzazione problemi
        $elencoproblemiModel= new Application_Model_Elencoproblemi();
        $associazioni=$elencoproblemiModel->getElencoByProdotto($idprodotto)->toArray();

        $elencoassociazioni=array();

        $c=0;
        foreach($associazioni as $associazione){

            $problema=$associazioni[$c];
            $idassociazione=$problema['idelencoproblemi'];
            $prodotto=$this->_problemaModel->getProblemaById($problema['idproblema'])->toArray();
            $dati=$prodotto[0];
            array_push($elencoassociazioni,array("idassociazione" => $idassociazione, "problema"=>$dati['problema'], "soluzione"=>$dati['soluzione'], "idprodotto"=> $idprodotto));
            $c++;
        }

        $this->view->assign(array('elencoproblemi' => $elencoassociazioni));
        //visualizzazione componenti
        $elencocomponentiModel= new Application_Model_Elencocomponenti();
        $associazioni=$elencocomponentiModel->getElencoByProdotto($idprodotto)->toArray();

        $elencocomponenti=array();

        $c=0;
        foreach($associazioni as $associazione){

            $vettore=$associazioni[$c];

            $idassociazione=$vettore['idelencocomponenti'];


            $componente=$this->_componenteModel->getComponenteById($vettore['idcomponente'])->toArray();


            $dati=$componente[0];
            $str_componente= $dati['marca']. " " . $dati['modello'];
            $url=$this->_helper->url->url(array(
                'controller' => 'tecnico',
                'action' => 'visualizzacomponente',
                'idcomponente' => $dati['idcomponente']),
                'default'
            );


            array_push($elencocomponenti,array("idassociazione" => $idassociazione, "nome"=>$str_componente, "url"=>$url, "idcomponente"=> $dati['idcomponente']));
            $c++;
        }


        $this->view->assign(array('elencocomponenti' => $elencocomponenti));



    }

    public function cercaprodottoAction(){
        $request = $this->getRequest(); //vede se esiste una richiesta
        if (!$request->isPost()) { //controlla che sia stata passata tramite post
            return $this->_helper->redirector('elencoprodotti'); // se non c'è un passaggio tramite post, reindirizza al contattiAction
        }
        $form=$this->_cercaform;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: inserisci il nome di un prodotto.');
            return $this->render('elencoprodotti');
        }
        $datiform=$form->getValues();
        $pippo=$this->setstring($datiform['cerca']);
        //$pippo=$this->setstring($pippo);
        $this->_prodottoModel=new Application_Model_Prodotto();
        $prodotti=$this->_prodottoModel->cercaProdotto($pippo)->toArray();
        $this->view->assign('elencoprodotto', $prodotti);
        $this->render('elencoprodotti');
    }

    private function setstring($stringa){
        /*
        Ricevo come parametro la stringa da cercare.
        La rendo minuscola (nell'inserimento, i prodotti vengono memorizzati sempre minuscoli)
        Formatto la stringa in questa maniera:
        Se trovo il carattere jolly * => lo sostituisco con % e restituisco la stringa.
        Se non lo trovo e ho confrontato tutti i caratteri, restituisco la stringa.
        */
        $stringa=strtolower($stringa);
        $lunghezza=strlen($stringa);
        $c=0;
        $var="";
       while ($c<$lunghezza) {
           $var .= substr($stringa, $c, 1);
           if (substr($var, $c, 1) == '*') {
               $var{$c} = '%';
               return $var;
           } else
               $c++;
       }

        return $var;
    }

}

