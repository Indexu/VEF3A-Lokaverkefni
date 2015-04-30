<?php

require('../models/model.php');
require('../views/view.php');
require('../controllers/controller.php');

require '../libs/Dwoo/Autoloader.php';

try{
	$model = new Model;
	$controller = new Controller($model);
	$view = new View($controller, $model);

} catch(Exception $e){
	die('Caught exception: '.  $e->getMessage(). "\n");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Ókeypis</title>
	<link href='http://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../css/foundation.css" />
	<link rel="stylesheet" href="../css/main.css" />
</head>

<body>
	<div id="wrapper">
		<?php $view->navbar(); ?>

		<div class="row">
			<div class="large-12 columns">
				<?php
					$view->contactPage();
				?>
			</div>

			
		</div>

		<div class="push"></div>
	</div>

	<?php $view->footer(); ?>

	<script src="../js/vendor/jquery.js"></script>
    <script src="../js/foundation.min.js"></script>
    <script src="../js/isotope.pkgd.min.js"></script>
    <script src="../js/main.js"></script>

</body>

</html> 