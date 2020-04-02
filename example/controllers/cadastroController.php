<?php
class cadastroController extends Controller {
	public function index(){
		$data = array(
			"title" => 'Classificados - Cadastro'
		);

		$this->loadTemplate('cadastro', $data);
	}

	public function cadastrar(){
        if(isset($_POST['nome']) && !empty($_POST['nome'])){
            $nome = $_POST['nome'];
            $idade = $_POST['idade'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            if(!empty($idade) && !empty($email) && !empty($senha) && !empty($tel)){
                $u = new Usuario();
                
                if(!empty($tel)){
                    if($u->cadastrar($nome, $email, $senha, $tel)){
    				?>
                        <div class='alert alert-success'>
                           <h3>Sucesso!</h3>
                           <p>O usuário foi cadastrado com sucesso! <a href='<?php echo BASE_URL; ?>login'>Faça o login</a></p>
                        </div>
    				<?php
                    } else{
    				?>
                        <div class='alert alert-danger'>
                           <h3>Erro!</h3>
                           <p>O usuário já está cadastrado! <a href='<?php echo BASE_URL; ?>login'>Faça o login</a></p>
                        </div>
    				<?php
                    }
                }
            } else{
    		?>
                <div class='alert alert-danger'>
                   <h3>Erro!</h3>
                   <p>Nem todos os campos obrigatórios foram preenchidos</p>
                </div>
    		<?php
            }
        }
	}
}