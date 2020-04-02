<?php
class produtoController extends Controller {
	public function index(){

	}

	public function abrir($id){
		$a = new Anuncio();
		$u = new Usuario();

		if(!empty($id)){
		    $id = addslashes($id);
		} else {
			header("Location: ".BASE_URL);
			exit;
		}

		if(isset($_SESSION['userID']) && !empty($_SESSION['userID'])){
			$nome = $u->getName($_SESSION['userID']);
		} else {
			$nome = '';
		}

		$anuncio = $a->getAnuncio($id);
		$images = $a->getImages($id);
		$telefone = $u->getTelefone($anuncio['id_usuario']);
		$firstTime = true;

		$data = array(
			'title' => $anuncio['titulo'].' - Classificados',
			'anuncio' => $anuncio,
			'images' => $images,
			'nome' => $nome,
			'telefone' => $telefone,
			'firstTime' => $firstTime
		);
		$this->loadTemplate("produto", $data);
	}
}