<?php
$machine = scandir("./machines/");
$count_machines = count($machines);
$file = $_POST['file'];
unlink("./library/$file");
if (is_link("./scripts/$file")) {
	unlink("./scripts/$file");
}
for ($x = 2; $x < $count_machines; $x++) {
	if (is_link("./machines/$machine[$x]/$file");
	unlink("./machines/$machine[$x]/$file");
}
header('Location: ./admin.php');
?>
