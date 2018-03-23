<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Model_DbTable_Problema extends Zend_Db_Table_Abstract
{
    protected $_name = 'problema';
    protected $_primary = 'idproblema';
    protected $_rowClass = 'Application_Model_DbTable_Problema';
}
