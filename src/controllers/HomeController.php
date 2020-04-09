<?php
namespace controllers;

use \core\Controller;


/**
 * Main controller. It will be responsible for site's main page behavior.
 */
class HomeController extends Controller 
{
    //-----------------------------------------------------------------------
    //        Methods
    //-----------------------------------------------------------------------
    /*
     @Override
     */
	public function index ()
	{
		$params = array(
			'title' => 'Home'
		);

		$this->loadTemplate("home", $params);
	}
}
