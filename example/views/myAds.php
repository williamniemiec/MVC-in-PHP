<div class='container'>
    <h1>My ads</h1>
    <?php $this->wasAdSuccessfulAdded(); ?>
    <a href='<?php echo BASE_URL;?>myAds/add' class='btn btn-outline-primary'>Add ad</a>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Photo</th>
                <th>Title</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        
        <tbody>
        <?php foreach($ads as $ad): ?>
            <tr class='ad-row'>
                <td>
                    <?php
                    if(empty($ad['url'])){
                        $ad['url'] = '<?php BASE_URL; ?>assets/images/noImage.png';
                    }
                    ?>
                    <img src="<?php echo $ad['url']; ?>" border='0' class='ad-img' />
                </td>
                <td><?php echo $ad['title']; ?></td>
                <td>$ <?php echo number_format($ad['price'], 2, ',', '.'); ?></td>
                <td>
                    <a href="<?php BASE_URL; ?><?php echo 'myAds/edit/'.$ad['id']; ?>" class='btn btn-outline-warning'>Edit</a>
                    <a href="<?php BASE_URL; ?>myAds/delete/<?php echo $ad['id']; ?>" class='btn btn-outline-danger'>Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>