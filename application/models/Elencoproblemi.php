<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Model_ElencoProblemi extends Zend_Db_Table_Abstract
{
    //manca getproblema by id prodotto

    public function getElencoByProdotto($id)
    {

        $tabella =  new Application_Model_DbTable_Elencoproblemi();
        $array=$this->fetchAll($tabella->select()->where('idprodotto = ?', $id));

        return $array;

    }
    public function insertElencoItem($dati)
    {
        $tabella = new Application_Model_DbTable_Elencoproblemi();
        return $tabella->insert($dati);
    }


    public function deleteElencoItem($id)
    {
        $tabella = new Application_Model_DbTable_Elencoproblemi();
        $tabella->delete("idelencoproblemi = ".$id);
    }
    public function deleteElencoByProdotto($id)
    {
        $tabella = new Application_Model_DbTable_Elencoproblemi();
        $tabella->delete("idprodotto = ".$id);
    }
    public function deleteElencoByProblema($id)
    {
        $tabella = new Application_Model_DbTable_Elencoproblemi();
        $tabella->delete("idproblema = ".$id);
    }


}

