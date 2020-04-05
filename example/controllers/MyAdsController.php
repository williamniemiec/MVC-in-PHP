<?php
namespace controllers;

use \core\Controller;
use \models\Ad;
use \models\User;
use \models\Category;


class MyAdsController extends Controller {
	public function index(){
	    if(empty($_SESSION['userID'])){
	    	header("Location: ".BASE_URL);
	    	exit;
	    }
		
		$ad = new Ad();
	    $user = new User();

		if(isset($_SESSION['userID']) && !empty($_SESSION['userID'])){
			$name = $user->getName($_SESSION['userID']);
		} else {
			$name = '';
		}

	    $data = array(
	    	'title' => 'E-commerce - My ads',
	    	'ads' => $ad->getMyAds(),
	    	'name' => $name
	    );

		$this->loadTemplate('myAds', $data);
	}

	public function wasAdSuccessfulAdded(){
		if(isset($_SESSION['ad_ad'])){
        	unset($_SESSION['ad_ad']);
	    	?>
	        <div class='alert alert-success' role='alert'>
	            Ad successfully registered!
	            <button class='close' data-dismiss='alert' aria-label='Close'>
	                <span aria-hidden='true'>&times;</span>
	            </button>
	        </div>
	    	<?php
    	}
	}


	public function add()
	{
		$ad = new Ad();
		$user = new User();

		// Form sent
		if( isset($_POST['title']) && !empty($_POST['title']) && 
        isset($_POST['price']) && !empty($_POST['price'])){
	        $id_user = intval($_SESSION['userID']);
	        $title = addslashes($_POST['title']);
	        $description = addslashes($_POST['description']);
	        $price = str_replace(',', '', $_POST['price']);
	        $price = floatval($price);
	        $state = intval($_POST['state']);
	        $id_category = intval($_POST['category']);
	        $imgs = $_FILES['img'];
	        //$imgsPath = $ad->savePhotos($imgs);

	        try{
	            $_SESSION['ad_added'] = $ad->add($id_user, $title, $description, $price, $state, $id_category, $imgs);
	            if ($_SESSION['ad_added'] == true) {
	            	header("Location: ".BASE_URL);
	            	exit;
	            }
	        } catch(Exception $e){}
        }

        $c = new Category();
        $categories = $c->getCategories();

		$data = array(
			"title" => "My ads - New ad",
			"name" => $user->getName($_SESSION['userID']),
			"categories" => $categories

		);

		$this->loadTemplate('addAd', $data);
	}


	public function delete($id){
		$ad = new Ad();

		try {
	        $ad->delete($id);
	    } catch(Exception $e){}

	    header('Location: '.BASE_URL);
	}

	public function edit($id_ad){
		if(empty($id_ad) || empty($_SESSION['userID'])){
		    header('Location: '.BASE_URL);
		}

		$ad = new Ad();
		$c = new Category();
        $categories = $c->getCategories();
        $user = new User();

		if(isset($_SESSION['userID']) && !empty($_SESSION['userID'])){
			$name = $user->getName($_SESSION['userID']);
		} else {
			$name = '';
		}

		$data = array(
			'title' => 'E-commerce - Edit',
			'name' => $name,
			'adInfo' => $ad->getAd($id_ad),
			'categories' => $categories,
			'id_ad' => $id_ad,
			'ad' => $ad
		);

		$this->loadTemplate('editAd', $data);
	}

	public function saveEdition($id_ad){
		if( isset($_POST['title']) && !empty($_POST['title']) && 
        isset($_POST['price']) && !empty($_POST['price'])){
			$ad = new Ad();
	        $title = addslashes($_POST['title']);
	        $description = addslashes($_POST['description']);
	        $price = str_replace(',', '.', $_POST['price']);
	        $price = floatval($price);
	        $id_category = intval($_POST['cat']);
	        $state = intval($_POST['state']);

	        try{
	            if($ad->getStatus($id_ad) == -1){
	                throw new Exception('Error getting status of the ad');
	            }
	            if (isset($_FILES['img']['tmp_name']) && !empty($_FILES['img']['tmp_name'])){
	                // Verifica se houve erro no envio de algum arquivo
	                if(isset($_FILES['img']['name'][0]) && !empty($_FILES['img']['name'][0])){
	                    foreach($_FILES['img']['tmp_name'] as $path){
	                        if(empty($path)){
	                            throw new Exception('Error sending images (size exceeded!)');
	                        }
	                    }
	                }

	                $imgsPath = $ad->savePhotos($_FILES['img'], $id_ad);
	            }

	            $ad->editAnuncio($id_ad, $title, $description, $price, $id_category, $state);
	        
	        } catch(Exception $e){
	    ?>    
	            <div class='alert alert-danger'>
	                <h3>Error!</h3>
	                <p><?php echo $e->getMessage(); ?></p>
	            </div>
	    <?php
	        }
	    }
	}
}