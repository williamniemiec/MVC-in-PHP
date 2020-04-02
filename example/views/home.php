<div class='container-fluid'>
    <div class='jumbotron'>
        <h3>Nós temos hoje <?php echo $totProd; ?> <?php echo ($totProd == 1)?('produto'):('produtos') ?></h3>
        <p>E <?php echo $totUsuarios; ?> <?php echo ($totUsuarios == 1)?('usuario cadastrado'):('usuarios cadastrados') ?>.</p>
    </div>
    <div class=row>
        <div class='col-3'>
            <h5>Pesquisa avançada</h5>
            <form method='GET'>
                <div class='form-group'>
                    <label for='cat'>Categoria</label>
                    <select id='cat' name='filtro[categoria]' class='form-control'>
                        <option></option>
                        <?php foreach($categorias as $categoria): ?>
                        <option value='<?php echo $categoria["id"] ?>'  <?php echo ($filtros['categoria'] == $categoria['id'])?'selected=selected':''; ?> >   <?php echo $categoria['nome'] ?>    </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class='form-group'>
                    <label for='preco'>Preço</label>
                    <select id='preco' name='filtro[preco]' class='form-control'>
                        <option></option>
                        <option value='0-50'    <?php echo ($filtros['preco'] == '0-50')?'selected=selected':'' ?> >                                R$ 0 - 50       </option>
                        <option value='51-100'  <?php echo ($filtros['preco'] == '51-100')?'selected=selected':'' ?> >   R$ 51 - 100     </option>
                        <option value='101-200' <?php echo ($filtros['preco'] == '101-200')?'selected=selected':'' ?> >   R$ 101 - 200    </option>
                        <option value='201-500' <?php echo ($filtros['preco'] == '201-500')?'selected=selected':'' ?> >   R$ 201 - 500    </option>
                        <option value='500+'    <?php echo ($filtros['preco'] == '500+')?'selected=selected':'' ?> >                                &gt; R$ 500     </option>
                    </select>
                </div>
                <div class='form-group'>
                    <label for='estado'>Estado</label>
                    <select id='estado' name='filtro[estado]' class='form-control'>
                        <option></option>
                        <option value=1 <?php echo ($filtros['estado'] == '1')?'selected=selected':'' ?> >    Novo    </option>
                        <option value=0 <?php echo ($filtros['estado'] == '0')?'selected=selected':'' ?> >    Usado   </option>
                    </select>
                </div>
                <div class='form-group'>
                    <input type='submit' value='Buscar' class='btn btn-outline-primary' />
                </div>
            </form>
        </div>
        <div class='col'>
            <h5>Últimos anúncios</h5>
            <table class='table table-striped'>
                <tbody>
                    <?php foreach($anuncios as $anuncio): ?>
                    <tr class=''>
                        <td class=''>
                            <?php
                            if(empty($anuncio['url'])){
                                $anuncio['url'] = '<?php BASE_URL; ?>assets/images/noImage.png';
                            }
                            ?>
                            <img src="<?php BASE_URL; ?><?php echo $anuncio['url']; ?>" border='0' class='ultimos-anuncio-img' />
                        </td>
                        <td class=''>
                            <a href="<?php BASE_URL; ?>produto/abrir/<?php echo $anuncio['id']; ?>"><?php echo $anuncio['titulo']; ?></a><br />
                            <?php echo $anuncio['categoria'] ?>
                        </td>
                        <td>R$ <?php echo number_format($anuncio['valor'], 2, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form method='GET'>
                <ul class='pagination justify-content-center'>
                    <li class='page-item <?php echo ($p == 1)?('disabled'):('') ?>'>
                        <a class='page-link' href='<?php BASE_URL; ?>?<?php 
                        //echo $p-1; 
                        $query = $_GET;
                        $query["p"] = $p-1;
                        echo http_build_query($query);
                        ?>'>Anterior</a>
                    </li>
                    <?php for($i=1; $i <= $totPages; $i++): ?>
                    <li class='page-item <?php echo ($p == $i)?('active'):('')?>'>
                        <a class='page-link' href='<?php BASE_URL; ?>?<?php 
                        $query = $_GET;
                        $query["p"] = $i;
                        echo http_build_query($query);
                        ?>'><?php echo $i; ?></a>
                    </li>
                    <?php endfor; ?>
                    <li class='page-item <?php echo ($p >= $totPages)?('disabled'):('') ?>'>
                        <a class='page-link' href='<?php BASE_URL; ?>?<?php 
                        $query = $_GET;
                        $query["p"] = $p+1;
                        echo http_build_query($query);
                        ?>'>Próximo</a>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>