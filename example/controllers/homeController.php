<?php
class homeController extends Controller {
	public function index(){
		$a = new Anuncio();
		$u = new Usuario();
		$c = new Categoria();
		
		$filtros = array(
		    'categoria' => '',
		    'preco' => '',
		    'estado' => ''
		);

		if(isset($_GET['filtro'])){
		    $filtros = $_GET['filtro'];
		}

		$totProd = $a->countAnuncios($filtros);

		// Paginação
		$p = 1;
		if(isset($_GET['p']) && !empty($_GET['p'])){
		    $p = addslashes($_GET['p']);
		}

		if(isset($_SESSION['userID']) && !empty($_SESSION['userID'])){
			$nome = $u->getName($_SESSION['userID']);
		} else {
			$nome = '';
		}

		$data = array(
			'title' => 'Classificados - Home',
			'nome' => $nome,
			'filtros' => $filtros,
			'p' => $p,
			'totProd' => $totProd,
			'totUsuarios' => $u->countUsuarios(),
			'categorias' => $c->getCategorias(),
			'anuncios' => $a->getAnuncios($p, 2, $filtros),
			'totPages' => $a->totPaginas(2, $totProd)
		);

		$this->loadTemplate('home', $data);
	}
}
?>