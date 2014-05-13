<?php
$mac = $_POST['mac'];
$custom = $_POST['custom'];
$submit = $_POST['submit'];

if ($submit == "Submit") {
	$fp = fopen("./machines/$mac/custom", 'w');
	fwrite($fp, $custom);
	fclose($fp);
	header('Location: ./manage.php');
} else {
	unlink("./machines/$mac/custom");
	header('Location: ./manage.php');
}
?>
