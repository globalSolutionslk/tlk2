<?php

class User extends Zend_Db_Table_Abstract
{
    protected $_name = 'users';
    protected $_primary= 'idCompanies';

    public function getAllUsers()
    {
        $db = Zend_Registry::get('db');
        $username = "Malith";
        $query = "select * from {$this->_name} where Name = 'saminda'";

        return $db->fetchAll($query);
    }

}

