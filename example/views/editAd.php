<div class='container'>
    <h1>Ad - Edit</h1>
     <?php $this->saveEdition($id_ad); ?>
    <form id='anuncio_form' method='POST' enctype='multipart/form-data'>
        <div class='form-group'>
            <label for='title'>Title</label>
            <input id='title' type='text' name='title' class='form-control' value="<?php echo $adInfo['title'] ?>" />
        </div>

        <div class='form-group'>
            <label for='description'>Description</label>
            <textarea id='description' name='description' class='form-control'><?php echo $adInfo['description'] ?></textarea>
        </div>

        <div class='form-group'>
            <label for='category'>Category</label>
            <select name='category' id='category' class='custom-select'>
                <?php
                foreach($categories as $category){
                    $categoryId = $category['id'];
                    $categoryName  = $category['name'];
                    echo $category;
                    $categoryAd = $ad->getCategory($id_ad);
                ?>
                <?php
                    if($categoryId == $categoryAd){
                ?>
                        <option value="<?php echo $categoryId; ?>" selected='selected'> <?php echo $categoryName; ?> </option>
                <?php 
                    }else{
                ?>
                        <option value="<?php echo $categoryId; ?>"> <?php echo $categoryName; ?> </option>
                <?php
                    }
                }
                ?>
            </select>
        </div>

        <div class='form-group'>
            <label for='price'>Price</label>
            <div class='input-group'>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>$</span>
                </div>
                <input id='price' type='text' name='price' class='form-control' value="<?php echo $adInfo['price'] ?>" />
            </div>
        </div>

        <div class='form-group'>
            <label for='state'>State</label>
            <select name='state' id='state' class='custom-select'>
                <?php
                $state = $adInfo['state'];
                if($state == '1'):
                ?>
                    <option value='1' selected='selected'>New</option>
                    <option value='0'>Used</option>
                <?php
                else:
                ?>
                    <option value='1'>New</option>
                    <option value='0' selected='selected'>Used</option>
                <?php
                endif
                ?>
            </select>
        </div>

        <div class='images'>
            Images<br /><br />

            <a href='' class='btn btn-primary' data-toggle='modal' data-target='#addImg'>Add photos</a>
            <hr />
            <div class='card '>
                <div class='card-header bg-dark text-light'>
                    
                    <a href='' class='btn btn-link text-light' data-toggle='collapse' data-target='#gallery_body'>Gallery</a>
                </div>
                <div id='gallery_body' class='collapse show'>
                    <div class='card-body d-flex flex-wrap justify-content-around'>
                        <?php
                        $imgs = $ad->getImages($id_ad);
                        foreach($imgs as $img){
                            $url = BASE_URL.$img['url'];
                        ?>
                            <div class='gallery img-thumbnail d-flex flex-column justify-content-between align-items-center'>
                                <img src=<?php echo $url; ?> />
                                <a href="img_delete.php?id=<?php echo $img['id']; ?>" class='btn btn-danger btn-block'>Delete</a>
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
                            <h3 class='modal-title'>Add photos</h3>
                            <button class='close' data-dismiss='modal' aria-label='Close'>&times;</button>
                        </div>
                        <div class='modal-body'>
                            <input name='img[]' type='file' accept='.jpg, .png' data-max-size='2000000' class='file upload-file' multiple data-show-upload='true' data-show-caption='true' />
                            <br />
                            <p class='text-center'>Size: <span class='upload-file-size'>0 MB</span> / 2 MB</p>
                        </div>
                        <div class='modal-footer'>
                            <button class='btn btn-danger' data-dismiss='modal' aria-label='Send'>Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br/>
        
        <div class='form-group'>
            <input type='submit' value='Save' class='btn btn-outline-primary' />
        </div>
    </form>
</div>