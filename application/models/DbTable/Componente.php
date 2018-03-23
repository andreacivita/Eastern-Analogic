<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Model_DbTable_Componente extends Zend_Db_Table_Abstract
{
    protected $_name = 'componente';
    protected $_primary = 'idcomponente';
    protected $_rowClass = 'Application_Model_DbTable_Componente';
}
