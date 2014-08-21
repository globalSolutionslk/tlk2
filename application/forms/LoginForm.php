<?php

/**
 * Responsible for the validation model of the login form
 */
class LoginForm extends Zend_Form
{
	/**
	 * Init the form elements
	 * 
	 * @return void
	 */
	public function init()
	{
		$username = $this->makeTextEntry("Username:","email");
		$password = $this->makePasswordEntry("Password:","password");

		$this->addElements(array($username,$password));
	}

	/**
	 * Generic text entry
	 * 
	 * @param string $elementName element name
	 * @param int    $elementId   element id
	 * 
	 * @return Zend_Form_Element_Text $textEntry
	 */
	private function makeTextEntry($elementName, $elementId)
	{
		$textEntry = new Zend_Form_Element_Text($elementId);
		$textEntry->setRequired(true);
		$textEntry->addValidator('NotEmpty');
		
		return $textEntry;
	}

	/**
	 * Create a password entry element
	 *
	 * @param string $elementName element id 
	 * @param int    $elementId   element id
	 * 
	 * @return Zend_Form_Element_Password $passwordEntry
	 */
	private function makePasswordEntry($elementName, $elementId)
	{
		$passwordEntry = new Zend_Form_Element_Password($elementId);
		$passwordEntry->setRequired(true);
		$passwordEntry->addValidator('NotEmpty');

		return $passwordEntry;
	}
}
