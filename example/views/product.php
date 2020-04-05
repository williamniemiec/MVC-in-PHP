<div class='container-fluid'>
    <div class=row>
        <div class='col-5'>
            <div id='slideshow' class='slide carousel' data-ride='carousel'>
                <div class='carousel-inner' role='listbox'>
                    <?php foreach($images as $key => $url): ?>
                    <?php $url = $url['url']; ?>
                    <div class='carousel-item <?php echo ($key == '0')?('active'):('') ?>'>
                        <img src="<?php echo BASE_URL.$url; ?>" class='d-block' />
                        <?php $firstTime = false; ?>
                    </div>
                    <?php endforeach; ?>
                </div>

                <a class='carousel-control-prev' href='#slideshow' data-slide='prev'>
                    <span class='carousel-control-prev-icon'></span>
                </a>
                <a class='carousel-control-next' href='#slideshow' data-slide='next'>
                    <span class='carousel-control-next-icon'></span>
                </a>
                
            </div>
        </div>
        
        <div class='col'>
            <h1><?php echo $ad['title']; ?></h1>
            <h4><?php echo $ad['category']; ?></h4>
            <p><?php echo $ad['description']; ?></p>
            <p><?php echo $ad['state']; ?></p>
            <hr />
            <h3>$ <?php echo $ad['price']; ?></h3>
            <h4><?php echo $phone; ?></h4>
        </div>
    </div>
</div>
