<?php
namespace controllers;

use \core\Controller;
use \models\User;


class LoginController extends Controller {
	public function index(){

		$this->loadTemplate('login');
	}

	public function login(){
	    if (isset($_POST['email']) && !empty($_POST['email'])){
	        $user = new User();
	        $email = addslashes($_POST['email']);
	        $pass = $_POST['pass'];

	        if($user->login($email, $pass)){
	    ?>
	            <script>
	                window.location.href = "<?php echo BASE_URL; ?>";
	            </script>
	    <?php
	        } else{
	    ?>
	            <div class='alert alert-danger'>
	                <h3>Error!</h3>
	                <p>Incorrect user and / or pass</p>
	            </div>
	    <?php
	        }
	    }
	}

	public function logout(){
		unset($_SESSION['userID']);
    	header('Location: '.BASE_URL);
	}
}