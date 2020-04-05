<div class='container'>
    <form id='ad_form' method='POST' enctype='multipart/form-data'>
            <div class='form-group'>
                <label for='title'>Title</label>
                <input id='title' type='text' name='title' class='form-control' required />
            </div>

            <div class='form-group'>
                <label for='description'>Description</label>
                <textarea id='description' name='description' class='form-control'  required > </textarea>
            </div>

            <div class='form-group'>
                <label for='category'>Category</label>
                <select name='category' id='category' class='custom-select'>
                    <?php
                    foreach($categories as $category) {
                        $catId = $category['id'];
                        $catName  = $category['name'];
                    ?>
                        <option value="<?php echo $catId; ?>"> <?php echo $catName; ?> </option>
                    <?php
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
                    <input id='price' type='text' name='price' class='form-control' required />
                </div>
            </div>

            <div class='form-group'>
                <label for='state'>State</label>
                <select name='state' id='state' class='custom-select'>
                    <option value='1' class='selected'>New</option>
                    <option value='0'>Used</option>
                </select>
            </div>

            <div class='form-group'>
                <label>Images</label><br />
                <input name='img[]' type='file' accept='.jpg, .png' data-max-size='2000000' class='file upload-file' multiple data-show-upload='true' data-show-caption='true' />
                <br />
                <p class='text-center'>Size: <span class='upload-file-size'>0 MB</span> / 2 MB</p>
            </div>

            <div class='form-group'>
                <input type='submit' value='Register' class='btn btn-outline-primary' />
            </div>
        </form>
    </div>
</div>

<script src='<?php echo BASE_URL; ?>assets/js/jquery.mask.js'></script>
<script src='<?php echo BASE_URL; ?>assets/js/script.js'></script>