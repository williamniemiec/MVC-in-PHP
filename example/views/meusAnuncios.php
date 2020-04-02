<div class='container'>
    <h1>Meus anúncios</h1>
    <?php $this->verificaAnuncioAddSucesso(); ?>
    <a href='addAnuncio.php' class='btn btn-outline-primary'>Adicionar anúncio</a>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Título</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($anuncios as $anuncio): ?>
            <tr class='anuncio-row'>
                <td>
                    <?php
                    if(empty($anuncio['url'])){
                        $anuncio['url'] = '<?php BASE_URL; ?>assets/images/noImage.png';
                    }
                    ?>
                    <img src="<?php echo $anuncio['url']; ?>" border='0' class='anuncio-img' />
                </td>
                <td><?php echo $anuncio['titulo']; ?></td>
                <td>R$ <?php echo number_format($anuncio['valor'], 2, ',', '.'); ?></td>
                <td>
                    <a href="<?php BASE_URL; ?><?php echo 'meusAnuncios/editarAnuncio/'.$anuncio['id']; ?>" class='btn btn-outline-warning'>Editar</a>
                    <a href="<?php BASE_URL; ?>meusAnuncios/excluir/<?php echo $anuncio['id']; ?>" class='btn btn-outline-danger'>Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>