<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Model_DbTable_Prodotto extends Zend_Db_Table_Abstract
{
    protected $_name = 'prodotto';
    protected $_primary = 'idprodotto';
    protected $_rowClass = 'Application_Model_DbTable_Prodotto';
}
