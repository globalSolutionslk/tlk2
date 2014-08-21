<?php

require_once APPLICATION_PATH . '/Classes/ModelFactory.php';

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initConfig()
    {
        $this->_config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV, array('allowModifications' => true));
        Zend_Registry::set('appConfig', $this->_config);
    }

    protected function _initDb()
    {
        $config = $this->_config;
        $dbConfig = $config->databases->master;

        Zend_Db_Table_Abstract::setDefaultAdapter(Zend_Db::factory('Pdo_Mysql', $dbConfig));
        $db = Zend_Db::factory('Pdo_Mysql', $dbConfig);
        $db->setFetchMode(Zend_Db::FETCH_OBJ);

        Zend_Registry::set('db', $db);
    }

}

