<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Model_Componente extends Zend_Db_Table_Abstract
{
    public function getComponente()
    {

        $tabella = new Application_Model_DbTable_Componente();

        $array=$this->fetchAll($tabella->select());
        return $array;
    }

    public function getComponenteById($id)
    {

        $tabella = new Application_Model_DbTable_Componente();
        $array=$this->fetchAll($tabella->select()->where('idcomponente = ?', $id));
        return $array;

    }

    public function insertComponente($dati)
    {
        $tabella = new Application_Model_DbTable_Componente();
        return $tabella->insert($dati);
    }

    public function editComponenteById($dati, $id)
    {
        $tabella = new Application_Model_DbTable_Componente();
        return $tabella->update($dati, "idcomponente = ". $id);
    }
    public function deleteComponente($id)
    {
        $tabella = new Application_Model_DbTable_Componente();
        $tabella->delete("idcomponente = ".$id);
    }


}

