<?php

/**
 * This class is responsible for providing model objects to the application.
 * It is a form of DI prevention.
 */
class ModelFactory
{
	/**
	 * Gets the name of the model to load
     *
     * @param string $modelName the name of the model
     *
     * @return string The model name (string)
	**/
	protected static function getModelName($modelName)
	{
		return ucfirst($modelName);
	}

	/**
	 * require_once's the correct file, when passed a cleaned modelName
     *
	 * @param string  $modelName The name of the model to load
     * @param boolean $module    The module to look in
     *
     * @return
	**/
	protected static function requireModel($modelName, $module = false)
	{
		//if a module is specified, use the normal app's models dir (for that module) instead of Actinium
		if ($module)
		{
			require_once APPLICATION_PATH . "/modules/$module/models/$modelName.php";
		}
		else //otherwise, it's an Actinium include
		{
			if (file_exists(APPLICATION_PATH . "/Models/$modelName.php"))
			{
				require_once APPLICATION_PATH . "/Models/$modelName.php";
			}
			else
			{
				require_once APPLICATION_PATH . "/models/$modelName.php";
			}
		}
	}

	/**
	 * Try to find a model given a model name and an optional module to look in
     *
	 * @param string $modelName The name of the model to load
	 * @param bool   $module    The module to look in
	 * @param bool   $returnNew Should I return a new instance of the model?
     *
	 * @return mixed The matching model object found, if $returnNew is TRUE
	**/
	public static function loadModel($modelName, $module = false, $returnNew = true)
	{
		//get the right model name to load
		$modelName = self::getModelName($modelName);

		//require the model
		self::requireModel($modelName, $module);

		if ($returnNew)
		{
			return new $modelName();
		}
	}
}
