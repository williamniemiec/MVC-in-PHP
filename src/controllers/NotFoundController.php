<?php
namespace controllers;

use core\Controller;


/**
 * It will be responsible for site's page not found behavior.
 */
class NotFoundController extends Controller 
{
    //-----------------------------------------------------------------------
    //        Methods
    //-----------------------------------------------------------------------
    /**
     * @Override
     */
	public function index()
	{
        $params = array(

        );

		$this->loadTemplate('404', $params);
	}
}
