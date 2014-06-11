<?php
if(!empty($_GET['mac'])) {
	$mac = $_GET['mac'];
	$machine_dir = scandir("./machines/$mac");
	$count_machine = count($machine_dir);
	for ($i = 0; $i < $count_machine; $i++) {
		if ($machine_dir[$i] != "." && $machine_dir != "..") {
			if ($machine_dir[$i] != "info.txt") {
				echo "$machine_dir[$i] ";
			}
		}
	}
}
?>
