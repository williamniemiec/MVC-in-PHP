<?php
class sobreController extends Controller {
	public function index(){
		$u = new Usuario();
		
		if(isset($_SESSION['userID']) && !empty($_SESSION['userID'])){
			$nome = $u->getName($_SESSION['userID']);
		} else {
			$nome = '';
		}

		$data = array(
			'title' => 'Classificados - Sobre',
			'nome' => $nome
		);
		$this->loadTemplate('sobre', $data);
	}
}