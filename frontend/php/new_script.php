<?php
$file = $_POST['file'];
$new_script = $_POST['new_script'];
$file = $_POST['file'];
file_put_contents("./library/$file", $new_script);
header('Location: ./admin.php');
?>
