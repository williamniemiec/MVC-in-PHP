<div class='container-fluid'>
    <div class='jumbotron'>
        <h3>Today we have <?php echo $totProd; ?> <?php echo ($totProd == 1)?('product'):('products') ?></h3>
        <p>And <?php echo $totUsers; ?> <?php echo ($totUsers == 1)?('registered user'):('registered users') ?>.</p>
    </div>

    <div class=row>
        <div class='col-3'>
            <h5>Advanced Search</h5>

            <form method='GET'>
                <div class='form-group'>
                    <label for='cat'>Category</label>
                    <select id='cat' name='filter[category]' class='form-control'>
                        <option></option>
                        <?php foreach($categories as $category): ?>
                        <option value='<?php echo $category["id"] ?>'  <?php echo ($filters['category'] == $category['id'])?'selected=selected':''; ?> >   <?php echo $category['name'] ?>    </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class='form-group'>
                    <label for='price'>Price</label>
                    <select id='price' name='filter[price]' class='form-control'>
                        <option></option>
                        <option value='0-50'    <?php echo ($filters['price'] == '0-50')?'selected=selected':'' ?> >                                $ 0 - 50       </option>
                        <option value='51-100'  <?php echo ($filters['price'] == '51-100')?'selected=selected':'' ?> >   $ 51 - 100     </option>
                        <option value='101-200' <?php echo ($filters['price'] == '101-200')?'selected=selected':'' ?> >   $ 101 - 200    </option>
                        <option value='201-500' <?php echo ($filters['price'] == '201-500')?'selected=selected':'' ?> >   $ 201 - 500    </option>
                        <option value='500+'    <?php echo ($filters['price'] == '500+')?'selected=selected':'' ?> >                                &gt; $ 500     </option>
                    </select>
                </div>
                <div class='form-group'>
                    <label for='state'>State</label>
                    <select id='state' name='filter[state]' class='form-control'>
                        <option></option>
                        <option value=1 <?php echo ($filters['state'] == '1')?'selected=selected':'' ?> >    New    </option>
                        <option value=0 <?php echo ($filters['state'] == '0')?'selected=selected':'' ?> >    Used   </option>
                    </select>
                </div>
                <div class='form-group'>
                    <input type='submit' value='Search' class='btn btn-outline-primary' />
                </div>
            </form>
        </div>
        
        <div class='col'>
            <h5>Last ads</h5>
            <table class='table table-striped'>
                <tbody>
                    <?php foreach($ads as $ad): ?>
                    <tr class=''>
                        <td class=''>
                            <?php
                            if(empty($ad['url'])){
                                $ad['url'] = '<?php BASE_URL; ?>assets/images/noImage.png';
                            }
                            ?>
                            <img src="<?php BASE_URL; ?><?php echo $ad['url']; ?>" border='0' class='last-ad-img' />
                        </td>
                        <td class=''>
                            <a href="<?php BASE_URL; ?>product/open/<?php echo $ad['id']; ?>"><?php echo $ad['title']; ?></a><br />
                            <?php echo $ad['category'] ?>
                        </td>
                        <td>$ <?php echo number_format($ad['price'], 2, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form method='GET'>
                <ul class='pagination justify-content-center'>
                    <li class='page-item <?php echo ($page == 1)?('disabled'):('') ?>'>
                        <a class='page-link' href='<?php BASE_URL; ?>?<?php 
                        $query = $_GET;
                        $query["p"] = $page-1;
                        echo http_build_query($query);
                        ?>'>Previous</a>
                    </li>
                    <?php for($i=1; $i <= $totPages; $i++): ?>
                    <li class='page-item <?php echo ($page == $i)?('active'):('')?>'>
                        <a class='page-link' href='<?php BASE_URL; ?>?<?php 
                        $query = $_GET;
                        $query["p"] = $i;
                        echo http_build_query($query);
                        ?>'><?php echo $i; ?></a>
                    </li>
                    <?php endfor; ?>
                    <li class='page-item <?php echo ($page >= $totPages)?('disabled'):('') ?>'>
                        <a class='page-link' href='<?php BASE_URL; ?>?<?php 
                        $query = $_GET;
                        $query["p"] = $page+1;
                        echo http_build_query($query);
                        ?>'>Next</a>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>