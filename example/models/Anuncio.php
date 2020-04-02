<?php
function imageToJpg($maxWidth, $maxHeight, $extensao_orig, $filepath){
    list($width_orig, $height_orig) = getimagesize($filepath);
    $ratio = $width_orig/$height_orig;

    if($maxWidth/$maxHeight > $ratio){ // Aumenta largura
        $maxWidth = $maxHeight * $ratio;
    } else {    // Aumenta altura
        $maxHeight = $maxWidth / $ratio;
    }

    // Redimenciona imagem
    $img = imagecreatetruecolor($maxWidth, $maxHeight);
    if($extensao_orig == 'jpeg'){
        $original = imagecreatefromjpeg($filepath);
    }
    else {
        $original = imagecreatefrompng($filepath);
    }

    imagecopyresampled($img, $original, 0, 0, 0, 0, $maxWidth, $maxHeight, $width_orig, $height_orig);

    imagejpeg($img, $filepath, 80);
}

class Anuncio extends Model {
    public function getMeusAnuncios(){
        $sql = $this->db->query("
            SELECT *,
            (select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1) as url 
            FROM anuncios 
            WHERE id_usuario = ".$_SESSION['userID']);
        
        return $sql->fetchAll();
    }

    public function getAnuncios($page, $numAnunciosExibidosPorPagina, $filtros){
        $retorno = array();
        $arrayFiltros = array('1=1');

        // Paginação
        // -1 pq paginação começa em zero, mas visualmente em 1
        $offset = ($page - 1) * $numAnunciosExibidosPorPagina;

        // Verifica filtros
        if(!empty($filtros['categoria'])){
            $arrayFiltros[] = "anuncios.id_categoria = :id_categoria";
        }
        
        if(!empty($filtros['preco'])){
            if($filtros['preco'] == '500+'){
                $arrayFiltros[] = "anuncios.valor >= :preco";
            }
            else{
                $arrayFiltros[] = "anuncios.valor BETWEEN :preco1 AND :preco2";
            }
        }
        
        if($filtros['estado'] != ''){
            $arrayFiltros[] = "anuncios.estado = :estado";
        }


        $sql = $this->db->prepare("SELECT *, 
            (select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1) as url, 
            (select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria 
            FROM anuncios 
            WHERE ".implode(' AND ', $arrayFiltros)." 
            ORDER BY id DESC 
            LIMIT $offset, $numAnunciosExibidosPorPagina");
        
        if(!empty($filtros['categoria'])){
            $sql->bindValue(':id_categoria', $filtros['categoria']);
        }
        
        if(!empty($filtros['preco'])){
            if($filtros['preco'] == '500+'){
                $sql->bindValue(':preco', 500);
            }
            else{
                $tmp = explode('-', $filtros['preco']);
                $sql->bindValue(':preco1', $tmp[0]);
                $sql->bindValue(':preco2', $tmp[1]);
            }
        }
        
        if(($filtros['estado']) != ''){
            $sql->bindValue(':estado', $filtros['estado']);
        }

        $sql->execute();


        if($sql->rowCount() > 0){
            $retorno = $sql->fetchAll();
        }

        return $retorno;
    }

    public function totPaginas($numAnunciosExibidosPorPagina, $totAnuncios){
        //$totAnuncios = $this->countAnuncios($filtros);
        return ceil($totAnuncios/$numAnunciosExibidosPorPagina);
    }

    public function getAnuncio($id_anuncio){
        $retorno = array();

        $sql = $this->db->prepare('SELECT *, 
            (select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria 
            FROM anuncios 
            WHERE id = :id_anuncio');
        $sql->bindValue(':id_anuncio', $id_anuncio);
        $sql->execute();

        if($sql->rowCount() > 0){
            $retorno = $sql->fetch();
        }

        return $retorno;
    }

    public function addAnuncio($id_usuario, $titulo, $descricao, $valor, $estado, $catID, $imgs){
        $sql = $this->db->prepare('INSERT INTO anuncios SET id_usuario = :userId, id_categoria = :catId, titulo = :titulo, descricao = :descricao, valor = :valor, estado = :estado');
        $sql->bindValue(':userId', $id_usuario);
        $sql->bindValue(':catId', $catID);
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':estado', $estado);
        $sql->execute();

        $id_anuncio = $pdo->lastInsertId();

        $this->savePhotos($imgs, $id_anuncio);
    }

    // Recebe array do form imgs e retorna array com paths das imagens
    public function savePhotos($arrayImgs, $id_anuncio){
        $totFiles = count($arrayImgs['tmp_name']);
        $imgs = array();

        for($i = 0; $i < $totFiles; $i++){
            if (!empty($arrayImgs['tmp_name'][$i]) && 
                ($arrayImgs['type'][$i] == 'image/jpeg' || $arrayImgs['type'][$i] == 'image/png')){
                $nomeArquivo = md5(time().rand(0,100));
                $extensao = explode('/', $arrayImgs['type'][$i])[1];
                //$filepath = 'assets/images/anuncios/'.$nomeArquivo.'.'.$extensao;
                $filepath = 'assets/images/anuncios/'.$nomeArquivo.'.jpg';
                move_uploaded_file($arrayImgs['tmp_name'][$i], $filepath);
                array_push($imgs, $filepath);

                // Redimenciona imagem se for muito grande para 500x500 e salva como .jpg
                imageToJpg(500, 500, $extensao, $filepath);

                // Insere imagem no banco de dados
                $sql = $this->db->prepare("INSERT INTO anuncios_imagens SET id_anuncio = :id_anuncio, url = :url");
                $sql->bindValue(':id_anuncio', $id_anuncio);
                $sql->bindValue(':url', $filepath);
                $sql->execute();
            }
            else{
                return null;
            }
        }

        return $imgs;
    }

    public function getImages($id_anuncio){
        $retorno = array();
        
        $sql = $this->db->query("SELECT * FROM anuncios_imagens WHERE id_anuncio = $id_anuncio");
        
        if($sql->rowCount() > 0){
            $retorno = $sql->fetchAll();
        }
        
        return $retorno;
    }

    public function getTitle($id_anuncio){
        $titulo = '';

        $sql = $this->db->query("SELECT titulo FROM anuncios WHERE id = ".$id_anuncio);
        
        if($sql->rowCount() > 0){
            $titulo = $sql->fetch()['titulo'];
        }

        return $titulo;
    }

    public function getDescription($id_anuncio){
        $desc = '';

        $sql = $this->db->query("SELECT descricao FROM anuncios WHERE id = ".$id_anuncio);
        
        if($sql->rowCount() > 0){
            $desc = $sql->fetch()['descricao'];
        }
        
        return $desc;
    }

    public function getValue($id_anuncio){
        $val = 0;

        $sql = $this->db->query("SELECT valor FROM anuncios WHERE id = ".$id_anuncio);
        
        if($sql->rowCount() > 0){
            $val = $sql->fetch()['valor'];
        }

        return $val;
    }

    public function getStatus($id_anuncio){
        $status = -1;

        $sql = $this->db->query("SELECT estado FROM anuncios WHERE id = ".$id_anuncio);
        if($sql->rowCount() > 0){
            $status = $sql->fetch()['estado'];
        }

        return $status;
    }

    public function editAnuncio($id_anuncio, $titulo, $descricao, $valor, $catId, $estado){

        $sql = $this->db->prepare("UPDATE anuncios SET titulo = :titulo, descricao = :descricao, valor = :valor, estado = :estado, id_categoria = :catId WHERE id = :id_anuncio");
        //$sql = $pdo->query("UPDATE anuncios SET titulo = '$titulo', descricao = '$descricao', valor = '$valor', estado = $estado, id_categoria = '$catId' WHERE id = ".$id_anuncio);
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':estado', $estado);
        $sql->bindValue(':catId', $catId);
        $sql->bindValue(':id_anuncio', $id_anuncio);
        $sql->execute();

    }

    public function deleteImg($id_img){
        $id_anuncio = 0;

        // Pega url para remover fisicamente o arquivo
        $sql = $this->db->prepare("SELECT id_anuncio,url FROM anuncios_imagens WHERE id = :id_img");
        $sql->bindValue(':id_img', $id_img);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $sql->fetch();
            $url = $sql['url'];
            $id_anuncio = $sql['id_anuncio'];
            unlink($url);
        }

        // Exclui da tabela anuncios_imagens
        $sql = $this->db->prepare("DELETE FROM anuncios_imagens WHERE id = :id_img");
        $sql->bindValue(':id_img', $id_img);
        $sql->execute();

        return $id_anuncio;
    }

    public function delete($id_anuncio){
        $sql = $this->db->prepare("DELETE FROM anuncios_imagens WHERE id_anuncio = :id_anuncio");
        $sql->bindValue(':id_anuncio', $id_anuncio);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM anuncios WHERE id = :id_anuncio");
        $sql->bindValue(':id_anuncio', $id_anuncio);
        $sql->execute();
    }

    

    public function getCategoria($id_anuncio){
        $sql = $this->db->query("SELECT id_categoria FROM anuncios WHERE id = ".$id_anuncio);
        $anuncio = $sql->fetch();

        return $anuncio['id_categoria'];
    }

    public function countAnuncios($filtros = array('categoria' => '', 'preco' => '', 'estado' => '')){
        $arrayFiltros = array('1=1');

        // Verifica filtros
        if(!empty($filtros['categoria'])){
            $arrayFiltros[] = "anuncios.id_categoria = :id_categoria";
        }
        
        if(!empty($filtros['preco'])){
            if($filtros['preco'] == '500+'){
                $arrayFiltros[] = "anuncios.valor >= :preco";
            }
            else{
                $arrayFiltros[] = "anuncios.valor BETWEEN :preco1 AND :preco2";
            }
        }
        
        if($filtros['estado'] != ''){
            $arrayFiltros[] = "anuncios.estado = :estado";
        }

        $sql = $this->db->prepare("SELECT id FROM anuncios WHERE ".implode(' AND ', $arrayFiltros));
        
        if(!empty($filtros['categoria'])){
            $sql->bindValue(':id_categoria', $filtros['categoria']);
        }
        
        if(!empty($filtros['preco'])){
            if($filtros['preco'] == '500+'){
                $sql->bindValue(':preco', 500);
            }
            else{
                $tmp = explode('-', $filtros['preco']);
                $sql->bindValue(':preco1', $tmp[0]);
                $sql->bindValue(':preco2', $tmp[1]);
            }
        }
        
        if(($filtros['estado']) != ''){
            $sql->bindValue(':estado', $filtros['estado']);
        }

        $sql->execute();

        return $sql->rowCount();
    }
}
?>