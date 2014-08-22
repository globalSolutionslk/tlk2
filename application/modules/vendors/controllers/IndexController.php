<?php
include_once("vendorController.php");

class Vendors_IndexController extends Vendors_vendorController
{
    public function init()
    {
        $this->_helper->layout->setLayout('adminLayout');
    }

    public function indexAction()
    {
        $vid = $this->_getParam('vendorid');
        $auth_user = new Zend_Session_Namespace('user_info');

        if($auth_user->userId!=$vid)
        {
//            Zend_Session::namespaceUnset('user_info');
            $this->_redirect('/vendors/authentication/');
        }

//        $companyModel = ModelFactory::loadModel('user');
//        $data = $companyModel->getAllUsers();
//        print_r($data);die;
    }
}
