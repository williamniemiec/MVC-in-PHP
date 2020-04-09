<!doctype html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style.css' />
    </head>

    <body>
        <!-- Scripts -->
        <script src='<?php echo BASE_URL; ?>assets/js/script.js'></script>

        <?php $this->loadView($viewName, $viewData); ?>
    </body>
</html>