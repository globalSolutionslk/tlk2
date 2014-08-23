<?php

class Vendors_authenticationController extends Zend_Controller_Action
{
	public function indexAction()
	{
        if ($this->getRequest()->isPost())
        {
            $email = $this->_getParam('login_email');
            $password = $this->_getParam('login_pass');

            $userModel = ModelFactory::loadModel('user');
            $user = $userModel->getUser($email);

            if($user->Password == $this->_getHashedPassword($password))
            {
                $auth_user = new Zend_Session_Namespace('user_info');
                $auth_user->userId = $user->idusers;
                $auth_user->userEmail = $email;
                $auth_user->profileName = $user->Name;
                $auth_user->profileImage = $user->UrlPicture;

                $auth_user->setExpirationSeconds(600);
                $this->_redirect('/vendors/index/index/vendorid/'.$user->idusers);
            }
        }
	}

    protected function _getHashedPassword($password)
    {
        return sha1($password);
    }
}
