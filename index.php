<?php

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>

<body>
	<pre>
	<?php

		$elko = json_decode(file_get_contents('data/elko.json'), true);

		print_r($elko);

	?>
	</pre>
</body>

</html> 