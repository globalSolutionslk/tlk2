<?php

/**
 *
 */
class Vendors_IndexController extends Zend_Controller_Action
{
    public function init()
    {
        $this->_helper->layout->setLayout('adminLayout');
    }

    public function indexAction()
    {
//        $companyModel = ModelFactory::loadModel('user');
//        $data = $companyModel->getAllUsers();
//        print_r($data);die;
    }
}
