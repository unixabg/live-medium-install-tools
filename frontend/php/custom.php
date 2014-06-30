<?php
$mac = $_POST['mac'];
$custom = $_POST['custom'];
$submit = $_POST['submit'];
$mgroup = $_POST['mgroup'];

if ($submit == "Submit") {
	$fp = fopen("./machines/$mgroup/$mac/custom", 'w');
	fwrite($fp, $custom);
	fclose($fp);
	header('Location: ./manage.php');
} else {
	unlink("./machines/$mgroup/$mac/custom");
	header('Location: ./manage.php');
}
?>
