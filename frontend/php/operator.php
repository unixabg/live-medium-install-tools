<?php
if(!empty($_GET['mac'])) {
	$mac = $_GET['mac'];
	$group = scandir("./machines/");
	$count_group = count($group);
	for ($x = 0; $x < $count_group; $x++) {
		if ($group[$x] != "." && $group[$x] != "..") {
			$machine = scandir("./machines/$group[$x]/$mac");
			$count_machine = count($machine);
		}
		for ($i = 0; $i < $count_machine; $i++) {
			if ($machine[$i] != "." && $machine[$i] != "..") {
				if ($machine[$i] != "info.txt") {
					echo "$machine[$i] ";
				}
			}
		}
	}
}
?>
