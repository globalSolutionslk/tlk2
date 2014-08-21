<?php

/**
 * Responsible for the authentication of a user via the login form
 * This also handles removing authentication tokens.
 */
class Vendors_authenticationController extends Zend_Controller_Action
{
	/**
	 * Render the login form and handle authentication requests
	 * 
	 * @return void
	 */
	public function indexAction()
	{
        print_r('sss');die;
		$request = $this->getRequest();
		
		// Check if we have a POST request
		if ($request->isPost())
		{
			// Get our form and validate it
			require_once APPLICATION_PATH . '/forms/LoginForm.php';
			$form = new LoginForm();

			if (!$form->isValid($request->getPost()))
			{
				//todo: update the view with error messages
				$this->view->errors = true;
				
				return;
			}

			$email = $this->_getParam('email');
			$password = $this->_getParam('password');

			// Check if this user has activated their account
			$authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table_Abstract::getDefaultAdapter());
			$authAdapter->setTableName('Users');
			$authAdapter->setIdentityColumn('Email');
			$authAdapter->setCredentialColumn('Password');
			$authAdapter->setIdentity($email);
			$authAdapter->setCredential($this->_getHashedPassword($password));

			$auth = Zend_Auth::getInstance();
			$result = $auth->authenticate($authAdapter);
			
			$userModel = ModelFactory::loadModel('User');
			
			if (!$result->isValid() || !$userModel->isScrazzlEmployee($email))
			{
				Zend_Registry::get('logger')->debug('auth result ' . print_r($result, 1));

				//todo: update the view with error messages
				$this->view->errors = true;
				
				return;
			}
			
			// Check if the produc url is set in order to redirect at the product page
			$url = $this->_getParam('u');
					
			if (isset($url) && $url != "")
			{
				$this->_redirect($url);
			}
			else
			{
				$userModel = ModelFactory::loadModel('user');
				$user = $userModel->findByEmail($email);
				$this->_redirect('/');
			}
			
		}
		else
		{
			$this->view->request = $request;
		}
	}

	/**
	 * Log the user out by deleting the authentication tokens
	 * and redirecting to the logout page.
	 * 
	 * @return void
	 */
	public function logoutAction()
	{
		Zend_Session::namespaceUnset('users');
		Zend_Session::namespaceUnset('groups');
		Zend_Session::namespaceUnset('acl');

		Zend_Auth::getInstance()->clearIdentity();
	}
	
	/**
	 * Return a hashed version of the user password.
	 * TODO: this needs to include a salt
	 * 
	 * @param string $password password
	 * 
	 * @return string
	 */
	protected function _getHashedPassword($password)
	{
		return sha1($password);
	}
}
