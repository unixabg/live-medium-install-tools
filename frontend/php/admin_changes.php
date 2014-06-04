<?php
$dir = "./library/";
$library = scandir($dir);
$count = count($library);
for ($x = 2; $x < $count; $x++) {
	$post = $_POST[$library[$x]];
	if ($post == "1") {
		symlink(getcwd()."/library/$library[$x]", getcwd()."/scripts/$library[$x]");
	} elseif($post != "1") {
	unlink("./scripts/$library[$x]");
	}
}
header('Location: admin.php');
?>
