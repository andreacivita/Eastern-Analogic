<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Model_Prodotto extends Zend_Db_Table_Abstract
{
    public function getProdotto()
    {

        $tabella = new Application_Model_DbTable_Prodotto();

        $array=$this->fetchAll($tabella->select());
        return $array;
    }

    public function getProdottoById($id)
    {

        $tabella = new Application_Model_DbTable_Prodotto();
        $array=$this->fetchAll($tabella->select()->where('idprodotto = ?', $id));
        return $array;

    }
    public function cercaProdotto($stringa)
    {

        $tabella = new Application_Model_DbTable_Prodotto();
        $array=$this->fetchAll($tabella->select()->where('modello LIKE  ?', $stringa));

        return $array;
    }

    public function insertProdotto($dati)
    {
        $tabella = new Application_Model_DbTable_Prodotto();
        return $tabella->insert($dati);
    }

    public function editProdottoById($dati, $id)
    {
        $tabella = new Application_Model_DbTable_Prodotto();
        return $tabella->update($dati, "idprodotto = ". $id);
    }
    public function deleteProdotto($id)
    {
        $tabella = new Application_Model_DbTable_Prodotto();
        $tabella->delete("idprodotto = ".$id);
    }


}

