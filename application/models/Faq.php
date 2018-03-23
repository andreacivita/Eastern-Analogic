<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Model_Faq extends Zend_Db_Table_Abstract
{
    public function getFaq()
    {
        $tabella = new Application_Model_DbTable_Faq();

        $array = $this->fetchAll($tabella->select());

        return $array;
    }

    public function getFaqById($id)
    {
        $tabella = new Application_Model_DbTable_Faq();
        $array = $this->fetchAll($tabella->select()->where('idfaq = ?', $id));

        return $array;
    }

    public function insertFaq($dati)
    {
        $tabella = new Application_Model_DbTable_Faq();

        return $tabella->insert($dati);
    }

    public function editFaqById($dati, $id)
    {
        $tabella = new Application_Model_DbTable_Faq();

        return $tabella->update($dati, 'idfaq = '.$id);
    }

    public function deleteFaq($id)
    {
        $tabella = new Application_Model_DbTable_Faq();
        $tabella->delete('idfaq = '.$id);
    }
}
