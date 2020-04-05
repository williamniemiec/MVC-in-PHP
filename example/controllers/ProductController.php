<?php
namespace controllers;

use \core\Controller;
use \models\Ad;
use \models\User;


class ProductController extends Controller {
	public function index(){

	}

	public function open($id){
		$ad = new Ad();
		$user = new User();

		if(!empty($id)){
		    $id = addslashes($id);
		} else {
			header("Location: ".BASE_URL);
			exit;
		}

		if(isset($_SESSION['userID']) && !empty($_SESSION['userID'])){
			$name = $user->getName($_SESSION['userID']);
		} else {
			$name = '';
		}

		$ad = $ad->getAd($id);
		$images = $ad->getImages($id);
		$phone = $user->getPhone($ad['id_user']);
		$firstTime = true;

		$data = array(
			'title' => $ad['title'].' - E-commerce',
			'ad' => $ad,
			'images' => $images,
			'name' => $name,
			'phone' => $phone,
			'firstTime' => $firstTime
		);
		$this->loadTemplate("product", $data);
	}
}