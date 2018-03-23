<?php

/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Application_Model_DbTable_Faq extends Zend_Db_Table_Abstract
{
    protected $_name = 'faq';
    protected $_primary = 'idfaq';
    protected $_rowClass = 'Application_Model_DbTable_Faq';
}
