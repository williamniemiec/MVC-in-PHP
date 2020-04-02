<?php
class loginController extends Controller {
	public function index(){

		$this->loadTemplate('login');
	}

	public function login(){
	    if (isset($_POST['email']) && !empty($_POST['email'])){
	        $u = new Usuario();
	        $email = addslashes($_POST['email']);
	        $senha = $_POST['senha'];

	        if($u->entrar($email, $senha)){
	    ?>
	            <script>
	                window.location.href="<?php echo BASE_URL; ?>";
	            </script>
	    <?php
	        } else{
	    ?>
	            <div class='alert alert-danger'>
	                <h3>Erro!</h3>
	                <p>O usuário e/ou senha incorretos</p>
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