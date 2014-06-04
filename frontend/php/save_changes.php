<?php
$mac = $_POST['mac_edit'];
$id = $_POST['id_edit'];
$description = $_POST['description_edit'];
$file = $_POST['file'];
$scripts = scandir('./scripts');
$count_scripts = count($scripts);

$data = "$mac|$id|$description";

for ($x = 2; $x < $count_scripts; $x++) {
	if ($scripts[$x] != 'custom') {
		$post = $_POST[$scripts[$x]];
	}
	if ($post == "1") {
		symlink(getcwd()."/scripts/$scripts[$x]", getcwd()."/machines/$mac/$scripts[$x]");
	} elseif ($scripts[$x] != 'custom') {
		unlink("./machines/$mac/$scripts[$x]");
	}
}

$fh = fopen($file, 'w');
fwrite($fh,$data);
fclose($fh);
header('Location: manage.php');
?>
