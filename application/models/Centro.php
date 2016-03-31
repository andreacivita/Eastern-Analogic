<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Model_Centro extends Zend_Db_Table_Abstract
{
    public function getCentro()
    {

        $tabella = new Application_Model_DbTable_Centro();

        $array=$this->fetchAll($tabella->select());
        return $array;
    }

    public function getCentroById($id)
    {

        $tabella = new Application_Model_DbTable_Centro();
        $array=$this->fetchAll($tabella->select()->where('idcentro = ?', $id));
        return $array;

    }

    public function insertCentro($dati)
    {
        $tabella = new Application_Model_DbTable_Centro();
        return $tabella->insert($dati);
    }

    public function editCentroById($dati, $id)
    {
        $tabella = new Application_Model_DbTable_Centro();
        return $tabella->update($dati, "idcentro = ". $id);
    }
    public function deleteCentro($id)
    {
        $tabella = new Application_Model_DbTable_Centro();
        $tabella->delete("idcentro = ".$id);
    }


}

