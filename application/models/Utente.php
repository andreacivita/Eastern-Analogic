<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Model_Utente extends Zend_Db_Table_Abstract
{
    public function getUtente()
    {

        $tabella = new Application_Model_DbTable_Utente();

        $array=$this->fetchAll($tabella->select());
        return $array;
    }
    public function getUtenteById($id)
    {

        $tabella = new Application_Model_DbTable_Utente();
        return $this->fetchAll($tabella->select()->where('idutente = ?', $id));

    }
    public function getUtenteByEmail($email)
    {

        $tabella = new Application_Model_DbTable_Utente();
        return $this->fetchAll($tabella->select()->where('email = ?', $email));

    }
    public function insertUtente($dati)
    {
        $tabella = new Application_Model_DbTable_Utente();
        return $tabella->insert($dati);
    }
    public function editUtenteById($dati, $id)
    {
        $tabella = new Application_Model_DbTable_Utente();
        return $tabella->update($dati, "idutente = ". $id);
    }
    public function deleteUtente($id)
    {
        $tabella = new Application_Model_DbTable_Utente();
        $tabella->delete("idutente = ".$id);
    }
    public function getUtenteExceptPassword($id){
        $tabella = new Application_Model_DbTable_Utente();
        $campi=array('idutente','nome','cognome','email','ruolo','idcentro');
        return $this->fetchAll($tabella->select()->from('utente',$campi)->where('idutente = ?', $id));
    }
}

