<?php
/* scans_th
Scans the $dir and prints each item formated into table header,
and excludes . and .. file.
*/
function scan_th($dir) {
	$dir = scandir($dir);
	$count = count($dir);
	for ($x = 0; $x < $count; $x++) {
		if ($dir[$x] != "." && $dir[$x] != "..") {
			echo "<th class=\"e\">".$dir[$x]."</th>";
		}
	}
}

/* check_box
Scans $file for files it contains and scans $dir to print out each item with
a check or no check, excludes . and .. file.
*/
function check_box($file, $dir) {
	$dir = scandir($dir);
	$count = count($dir);
	for ($loop_count = 0; $loop_count < $count; $loop_count++) {
		if ($dir[$loop_count] != "." && $dir[$loop_count] != "..") {
			if (is_link("./machines/"."/".$file."/".$dir[$loop_count]) || is_file("./machines/".$file."/".$dir[$loop_count])) {
				echo "<td class=\"e\">&#10003;</td>";
			} else {
				echo "<td class=\"e\"></td>";
			}
		}
	}
}

?>
