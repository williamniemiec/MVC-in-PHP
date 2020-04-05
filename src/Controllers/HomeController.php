<?php
namespace Controllers;

use \Core\Controller;


/**
 * Main controller. It will be responsible for site's main pase behavior.
 */
class HomeController extends Controller 
{
    #-----------------------------------------------------------------------
    #        Methods
    #-----------------------------------------------------------------------
	public function index ()
	{
		$params = array(
			
		);

		$this->loadTemplate("home", $params);
	}
}
