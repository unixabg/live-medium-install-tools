<?php
$mac = $_POST['mac_edit'];
$mgroup = $_POST['mgroup'];
$id = $_POST['id_edit'];
$description = $_POST['description_edit'];
$file = $_POST['file'];
$scripts = scandir("./scripts/$mgroup/");
$count_scripts = count($scripts);

$data = "$mac|$id|$description";
for ($x = 0; $x < $count_scripts; $x++) {
	if ($scripts[$x] != "." && $scripts[$x] != "..") {
		if ($scripts[$x] != 'custom') {
			$post = $_POST[$scripts[$x]];
			echo $post;
		}
		if ($post == "1") {
			// Step back up three dirs for the symlink.
			symlink("../../../scripts/$mgroup/$scripts[$x]", "./machines/$mgroup/$mac/$scripts[$x]");
		} elseif ($scripts[$x] != 'custom') {
			unlink("./machines/$mgroup/$mac/$scripts[$x]");
		}
	}
}

$fh = fopen($file, 'w');
fwrite($fh,$data);
fclose($fh);
header("Location: manage.php?mgroup=$mgroup");
?>
