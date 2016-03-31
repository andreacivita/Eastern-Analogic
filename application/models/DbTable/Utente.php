<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */

class Application_Model_DbTable_Utente extends Zend_Db_Table_Abstract
{

    protected $_name = 'utente';
    protected $_primary = 'idutente';
    protected $_rowClass = 'Application_Model_DbTable_Utente';

}

