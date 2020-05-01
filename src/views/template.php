<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="A website made using MVC-in-PHP framework" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0" />
        <meta name="keywords" content="<?php echo implode(',', $keywords); ?>" />
        <meta name="robots" content="<?php echo $robots; ?>" />
        <title><?php echo $title; ?></title>
        <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style.css' />
    </head>

    <body>
    	<!-- View -->
        <?php $this->loadView($viewName, $viewData); ?>

        <!-- Scripts -->
        <script src='<?php echo BASE_URL; ?>assets/js/script.js'></script>
    </body>
</html>