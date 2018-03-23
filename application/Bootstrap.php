<?php
/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/.
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected $_logger;
    protected $_view;

    protected function _initRequest()
    {
        /*
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
        */
    }

    protected function _initDefaultModuleAutoloader()
    {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('App_');
        $this->getResourceLoader()
            ->addResourceType('modelResource', 'models/resources', 'Resource');
    }

    protected function _initDbParms()
    {
        include_once 'include/connect.php';
        $db = new Zend_Db_Adapter_Pdo_Mysql([
            'host'     => $HOST,
            'username' => $USER,
            'password' => $PASSWORD,
            'dbname'   => $DB,
            'charset'  => 'utf8',
        ]);

        Zend_Db_Table_Abstract::setDefaultAdapter($db);
        $db->query("SET NAMES 'utf8';");
    }

    protected function _initFrontControllerPlugin()
    {
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new App_Controller_Plugin_Acl());
    }
}
