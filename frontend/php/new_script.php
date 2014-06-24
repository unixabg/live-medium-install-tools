<?php
$new_script = $_POST['new_script'];
$file = $_POST['file'];
$dir = $_POST['dir'];
file_put_contents("$dir/$file", $new_script);
echo "$dir/$file";
header('Location: ./admin.php');
?>
