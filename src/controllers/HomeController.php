<?php
namespace controllers;

use core\Controller;


/**
 * Main controller. It will be responsible for site's main page behavior.
 */
class HomeController extends Controller 
{
    //-----------------------------------------------------------------------
    //        Methods
    //-----------------------------------------------------------------------
    /**
     * @Override
     */
	public function index ()
	{
		$params = array(
			'title' => 'Home',
			'description' => "A website made using MVC-in-PHP framework",
			'keywords' => array('home', 'mvc-in-php'),
			'robots' => 'index'
		);

		$this->loadTemplate("home", $params);
	}
}
