<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Model_Problema extends Zend_Db_Table_Abstract
{
    public function getProblema()
    {
        $tabella = new Application_Model_DbTable_Problema();

        $array = $this->fetchAll($tabella->select());

        return $array;
    }

    public function getProblemaById($id)
    {
        $tabella = new Application_Model_DbTable_Problema();
        $array = $this->fetchAll($tabella->select()->where('idproblema = ?', $id));

        return $array;
    }

    public function insertProblema($dati)
    {
        $tabella = new Application_Model_DbTable_Problema();

        return $tabella->insert($dati);
    }

    public function editProblemaById($dati, $id)
    {
        $tabella = new Application_Model_DbTable_Problema();

        return $tabella->update($dati, 'idproblema = '.$id);
    }

    public function deleteProblema($id)
    {
        $tabella = new Application_Model_DbTable_Problema();
        $tabella->delete('idproblema = '.$id);
    }
}
