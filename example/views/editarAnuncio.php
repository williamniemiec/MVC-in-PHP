<div class='container'>
    <h1>Edição de anúncio</h1>
    <?php $this->salvarEdicao($id_anuncio); ?>
    <form id='anuncio_form' method='POST' enctype='multipart/form-data'>
        <div class='form-group'>
            <label for='titulo'>Título</label>
            <input id='titulo' type='text' name='titulo' class='form-control' value="<?php echo $anuncio['titulo'] ?>" />
        </div>
        <div class='form-group'>
            <label for='descricao'>Descrição</label>
            <textarea id='descricao' name='descricao' class='form-control'><?php echo $anuncio['descricao'] ?></textarea>
        </div>
        <div class='form-group'>
            <label for='cat'>Categoria</label>
            <select name='cat' id='cat' class='custom-select'>
                <?php
                foreach($categorias as $categoria){
                    $catId = $categoria['id'];
                    $catName  = $categoria['nome'];
                    echo $categoria;
                    $catAnuncio = $a->getCategoria($id_anuncio);
                ?>
                <?php
                    if($catId == $catAnuncio){
                ?>
                        <option value="<?php echo $catId; ?>" selected='selected'> <?php echo $catName; ?> </option>
                <?php 
                    }else{
                ?>
                        <option value="<?php echo $catId; ?>"> <?php echo $catName; ?> </option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class='form-group'>
            <label for='valor'>Valor</label>
            <div class='input-group'>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>R$</span>
                </div>
                <input id='valor' type='text' name='valor' class='form-control' value="<?php echo $anuncio['valor'] ?>" />
            </div>
        </div>
        <div class='form-group'>
            <label for='estado'>Estado</label>
            <select name='estado' id='estado' class='custom-select'>
                <?php
                $estado = $anuncio['estado'];
                if($estado == '1'):
                ?>
                    <option value='1' selected='selected'>Novo</option>
                    <option value='0'>Usado</option>
                <?php
                else:
                ?>
                    <option value='1'>Novo</option>
                    <option value='0' selected='selected'>Usado</option>
                <?php
                endif
                ?>
                
            </select>
        </div>
        <div class='images'>
            Imagens<br /><br />

            <a href='' class='btn btn-primary' data-toggle='modal' data-target='#addImg'>Adicionar fotos</a>
            <hr />
            <div class='card '>
                <div class='card-header bg-dark text-light'>
                    
                    <a href='' class='btn btn-link text-light' data-toggle='collapse' data-target='#galeria_body'>Galeria</a>
                </div>
                <div id='galeria_body' class='collapse show'>
                    <div class='card-body d-flex flex-wrap justify-content-around'>
                        <?php
                        $imgs = $a->getImages($id_anuncio);
                        foreach($imgs as $img){
                            $url = BASE_URL.$img['url'];
                        ?>
                            <div class='galeria img-thumbnail d-flex flex-column justify-content-between align-items-center'>
                                <img src=<?php echo $url; ?> />
                                <a href="imagem_excluir.php?id=<?php echo $img['id']; ?>" class='btn btn-danger btn-block'>Excluir</a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div id='addImg' class='modal fade'>
                <div class='modal-dialog modal-centered'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h3 class='modal-title'>Adicionar fotos</h3>
                            <button class='close' data-dismiss='modal' aria-label='Fechar'>&times;</button>
                        </div>
                        <div class='modal-body'>
                            <input name='img[]' type='file' accept='.jpg, .png' data-max-size='2000000' class='file upload-file' multiple data-show-upload='true' data-show-caption='true' />
                            <br />
                            <p class='text-center'>Tamanho: <span class='upload-file-size'>0 MB</span> / 2 MB</p>
                        </div>
                        <div class='modal-footer'>
                            <!-- <a href='' class='btn btn-success'>Enviar</a> -->
                            <button class='btn btn-danger' data-dismiss='modal' aria-label='Enviar'>Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class='form-group'>
            <input type='submit' value='Salvar' class='btn btn-outline-primary' />
        </div>
    </form>
</div>