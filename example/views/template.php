<!doctype html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
        <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/bootstrap.min.css' />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style.css' />
        <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/ps_style.css' />

    </head>
    <body>
        <nav class='navbar navbar-expand-lg bg-dark navbar-dark navbar-fixed-top'>
            <div class='container-fluid'>
                <a class='navbar-brand' href='<?php echo BASE_URL; ?>'>Classificados</a>
                <button class='navbar-toggler' data-toggle='collapse' data-target='#menu'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div id='menu' class='navbar-collapse collapse'>
                    <ul class='navbar-nav'>
                        <li class='nav-item'><a href='<?php echo BASE_URL; ?>home' class='nav-link'>Home</a></li>
                        <li class='nav-item'><a href='<?php echo BASE_URL; ?>sobre' class='nav-link'>Sobre</a></li>
                    </ul>
                </div>
                <div class='nav navbar-nav navbar-right'>
                    <?php if(isset($_SESSION['userID']) && !empty($_SESSION['userID'])): ?>
                        <li class='navbar-text text-info' style='margin-right:20px;'>
                            <?php echo $nome; ?>
                        </li>
                        <li class='nav-item'><a href='<?php echo BASE_URL; ?>meusAnuncios' class='nav-link'>Meus anúncios</a></li>
                        <li class='nav-item'><a href='<?php echo BASE_URL; ?>login/logout' class='nav-link'>Sair</a></li>
                    <?php else: ?>
                        <li class='nav-item'><a href='<?php echo BASE_URL; ?>cadastro' class='nav-link'>Cadastrar</a></li>
                        <li class='nav-item'><a href='<?php echo BASE_URL; ?>login' class='nav-link'>Login</a></li>
                    <?php endif ?>
                </div>
            </div>
        </nav>
        <script src='<?php echo BASE_URL; ?>assets/js/jquery-3.4.1.min.js'></script>
        <script src='<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js'></script>

        <?php $this->loadViewInTemplate($viewName, $viewData); ?>
    </body>
</html>