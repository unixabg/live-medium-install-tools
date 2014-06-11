<?php
$dir = "./library/";
$library = scandir($dir);
$count = count($library);
for ($x = 0; $x < $count; $x++) {
	if ($library[$x] != "." && $library[$x] != "..") {
		$post = $_POST[$library[$x]];
		if ($post == "1") {
			// Step up one dir from anticipated symlink target.
			symlink("../library/$library[$x]", "./scripts/$library[$x]");
		} elseif($post != "1") {
			unlink("./scripts/$library[$x]");
		}
	}
}
header('Location: admin.php');
?>
