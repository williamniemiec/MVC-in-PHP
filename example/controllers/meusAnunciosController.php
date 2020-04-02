<?php
class meusAnunciosController extends Controller {
	public function index(){
	    if(empty($_SESSION['userID'])){
	    	header("Location: ".BASE_URL);
	    	exit;
	    }
		
		$a = new Anuncio();
	    $u = new Usuario();

		if(isset($_SESSION['userID']) && !empty($_SESSION['userID'])){
			$nome = $u->getName($_SESSION['userID']);
		} else {
			$nome = '';
		}

	    $data = array(
	    	'title' => 'Classificados - Meus anúncios',
	    	'anuncios' => $a->getMeusAnuncios(),
	    	'nome' => $nome
	    );

		$this->loadTemplate('meusAnuncios', $data);
	}

	public function verificaAnuncioAddSucesso(){
		if(isset($_SESSION['anuncio_add'])){
        	unset($_SESSION['anuncio_add']);
	    	?>
	        <div class='alert alert-success' role='alert'>
	            Anúncio cadastrado com sucesso!
	            <button class='close' data-dismiss='alert' aria-label='Fechar'>
	                <span aria-hidden='true'>&times;</span>
	            </button>
	        </div>
	    	<?php
    	}
	}

	public function excluir($id){
		$a = new Anuncio();

		try {
	        $a->delete($id);
	    } catch(Exception $e){}

	    header('Location: '.BASE_URL);
	}

	public function editarAnuncio($id_anuncio){
		if(empty($id_anuncio) || empty($_SESSION['userID'])){
		    header('Location: '.BASE_URL);
		}

		$a = new Anuncio();
		$c = new Categoria();
        $categorias = $c->getCategorias();
        $u = new Usuario();

		if(isset($_SESSION['userID']) && !empty($_SESSION['userID'])){
			$nome = $u->getName($_SESSION['userID']);
		} else {
			$nome = '';
		}

		$data = array(
			'title' => 'Anuncio - Editar',
			'nome' => $nome,
			'anuncio' => $a->getAnuncio($id_anuncio),
			'categorias' => $categorias,
			'id_anuncio' => $id_anuncio,
			'a' => $a
		);

		$this->loadTemplate('editarAnuncio', $data);
	}

	public function salvarEdicao($id_anuncio){
		if( isset($_POST['titulo']) && !empty($_POST['titulo']) && 
        isset($_POST['valor']) && !empty($_POST['valor'])){
			$a = new Anuncio();
	        $titulo = addslashes($_POST['titulo']);
	        $descricao = addslashes($_POST['descricao']);
	        $valor = str_replace(',', '.', $_POST['valor']);
	        $valor = floatval($valor);
	        $catId = intval($_POST['cat']);
	        $estado = intval($_POST['estado']);

	        try{
	            if($a->getStatus($id_anuncio) == -1){
	                throw new Exception('Erro ao pegar estado do anuncio');
	            }
	            if (isset($_FILES['img']['tmp_name']) && !empty($_FILES['img']['tmp_name'])){
	                /*
	                echo '<pre>';
	                print_r($_FILES);
	                echo '</pre>';
	                exit;
	                */
	                // Verifica se houve erro no envio de algum arquivo
	                if(isset($_FILES['img']['name'][0]) && !empty($_FILES['img']['name'][0])){
	                    foreach($_FILES['img']['tmp_name'] as $path){
	                        if(empty($path)){
	                            throw new Exception('Erro no envio das imagens (tamanho excedido!)');
	                        }
	                    }
	                }

	                $imgsPath = $a->savePhotos($_FILES['img'], $id_anuncio);
	                //$a->addImages($id_anuncio, $imgsPath);
	            }

	            $a->editAnuncio($id_anuncio, $titulo, $descricao, $valor, $catId, $estado);
	        
	        } catch(Exception $e){
	    ?>    
	            <div class='alert alert-danger'>
	                <h3>Erro!</h3>
	                <p><?php echo $e->getMessage(); ?></p>
	            </div>
	    <?php
	        }
	    }
	}
}