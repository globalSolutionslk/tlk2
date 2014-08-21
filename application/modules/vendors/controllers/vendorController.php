<?php

class Vendors_vendorController extends Zend_Controller_Action
{
    public function preDispatch()
    {

        $auth_user = new Zend_Session_Namespace('user_info');

        if(!$auth_user->userEmail)
        {
            Zend_Session::namespaceUnset('user_info');
            $this->_redirect('/vendors/authentication/');
        }
    }
}