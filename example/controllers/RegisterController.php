<?php
namespace controllers;

use \core\Controller;
use \models\User;


class RegisterController extends Controller {
	public function index(){
		$data = array(
			"title" => 'E-commerce - Register'
		);

		$this->loadTemplate('register', $data);
	}

	public function register() {
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $name = $_POST['name'];
            $age = $_POST['age'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            if(!empty($age) && !empty($email) && !empty($pass) && !empty($phone)){
                $user = new User();
                
                if(!empty($phone)){
                    if($user->register($name, $email, $pass, $phone)){
    				?>
                        <div class='alert alert-success'>
                           <h3>Success!</h3>
                           <p>User has been successfully registered! <a href='<?php echo BASE_URL; ?>login'>Login</a></p>
                        </div>
    				<?php
                    } else{
    				?>
                        <div class='alert alert-danger'>
                           <h3>Error!</h3>
                           <p>The user is already registered! <a href='<?php echo BASE_URL; ?>login'>Login</a></p>
                        </div>
    				<?php
                    }
                }
            } else{
    		?>
                <div class='alert alert-danger'>
                   <h3>Error!</h3>
                   <p>Not all required fields have been filled.</p>
                </div>
    		<?php
            }
        }
	}
}