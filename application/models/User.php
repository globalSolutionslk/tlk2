<?php

class User extends Zend_Db_Table_Abstract
{
    protected $_name = 'users';
    protected $_primary= 'idCompanies';

    public function getUser($email)
    {
        $db = Zend_Registry::get('db');
        $query = "select * from {$this->_name} where Email = ".$db->quote($email);

        return $db->fetchRow($query);
    }

}

