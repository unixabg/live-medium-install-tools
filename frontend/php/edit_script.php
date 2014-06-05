<?php
$file = $_POST['file'];
$new_script = $_POST['script'];
$submit = $_POST['submit'];
if ($submit == "Submit") {
	file_put_contents($file, $new_script);
} else {
	unlink($file);
}
header('Location: ./admin.php');
?>
