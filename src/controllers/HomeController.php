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
		// Keywords of home page
		$keywords = array('home', 'mvc-in-php');

		$params = array(
			'title' => 'Home',
			'keywords' => $keywords,
			'robots' => 'index'
		);

		$this->loadTemplate("home", $params);
	}
}
