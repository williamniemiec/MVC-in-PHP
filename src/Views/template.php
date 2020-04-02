<!doctype html>
<html>
	<head>
		<title>My website</title>
		<link rel='stylesheet' href="<?php echo BASE_URL; ?>assets/css/style.css" />
	</head>
	
	<body>
		<?php $this->loadView($viewName, $viewData); ?>

		<script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
	</body>
</html>
