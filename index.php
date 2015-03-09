<?php

require('models/model.php');
require('views/view.php');
require('controllers/controller.php');

try{
	$model = new Model;
	$controller = new Controller($model);
	$view = new View($controller, $model);
} catch(Exception $e){
	die('Caught exception: '.  $e->getMessage(). "\n");
}

if (isset($_GET)){
	if(isset($_GET['action'])){
		
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Ókeypis</title>
	<link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="css/main.css">
	<script src="js/vendor/modernizr.js"></script>
</head>

<body>
	<div class="row">
		<div id="header" class="large-12 columns">
			<?php $view->title(); ?>
		</div>
	</div>

	<div id="wrapper" class="row">
		<div class="large-12 columns">
			<?php
				$view->laptopCatalogue();
			?>
		</div>
	</div>

	<script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>

</body>

</html> 