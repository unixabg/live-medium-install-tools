<?php
if(!empty($_GET['mac'])) {
	$mac = $_GET['mac'];
	$groups = scandir("./machines/");
	$count_groups = count($groups);
	for ($x = 0; $x < $count_groups; $x++) {
		if ($groups[$x] != "." && $groups[$x] != "..") {
			if (is_dir("./machines/$groups[$x]/$mac")) {
				$group_match = $groups[$x];
				echo $group_match;
				$mac_scripts = scandir("./machines/$group_match/$mac");
				$count_scripts = count($mac_scripts);
				echo $count_scripts;
				for ($i = 0; $i < $count_scripts; $i++) {
					if ($mac_scripts[$i] != "." && $mac_scripts[$i] != "..") {
						if ($mac_scripts[$i] != "info.txt") {
							echo "$group_match/$mac/$mac_scripts[$i] ";
						}
					}
				}
			}
		}
	}
}
?>
