<?php
namespace Core;


/**
 * Class responsible for opening views.
 */
class Controller
{
    //-----------------------------------------------------------------------
    //        Methods
    //-----------------------------------------------------------------------
	/**
	 * Shows a view
	 *
	 * @param $viewname View's name
	 * @param $viewData View's parameters
	 */
	public function loadView ($viewName, $viewData = array())
	{
		extract($viewData);				// Transforms array keys into variables
		require 'Views/'.$viewName.'.php';
	}

	/**
	 * Shows a view inside a template
	 *
	 * @param $viewname View's name
	 * @param $viewData View's parameters
	 */
	public function loadTemplate ($viewName, $viewData = array())
	{
		extract($viewData);				// Transforms array keys into variables
		require 'Views/template.php';
	}
}
