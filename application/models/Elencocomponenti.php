<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Model_ElencoComponenti extends Zend_Db_Table_Abstract
{


    public function getElencoByProdotto($id)
    {

        $tabella =  new Application_Model_DbTable_Elencocomponenti();
        $array=$this->fetchAll($tabella->select()->where('idprodotto = ?', $id));

        return $array;

    }
    public function insertElencoItem($dati)
    {
        $tabella = new Application_Model_DbTable_Elencocomponenti();
        return $tabella->insert($dati);
    }


    public function deleteElencoItem($id)
    {
        $tabella = new Application_Model_DbTable_Elencocomponenti();
        $tabella->delete("idelencocomponenti = ".$id);
    }
    public function deleteElencoByProdotto($id)
    {
        $tabella = new Application_Model_DbTable_Elencocomponenti();
        $tabella->delete("idprodotto = ".$id);
    }
    public function deleteElencoByComponente($id)
    {
        $tabella = new Application_Model_DbTable_Elencocomponenti();
        $tabella->delete("idcomponente = ".$id);
    }


}

