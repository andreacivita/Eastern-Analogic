<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Model_DbTable_Elencocomponenti extends Zend_Db_Table_Abstract
{
    protected $_name = 'elencocomponenti';
    protected $_primary = 'idelencocomponenti';
    protected $_rowClass = 'Application_Model_DbTable_Elencocomponenti';
}
