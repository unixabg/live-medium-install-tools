<?php
include "header.php";
$scripts = scandir('./scripts/');
$count_scripts = count($scripts);
?>
<body>
	<div id="main_text">
		<?php
		$search = $_POST['search'];

		$dir = "./machines/";
		$machine_array = scandir($dir);
		$machine_count = count($machine_array);
		for ($x = 0; $x < $machine_count; $x++) {
			if ($machine_array[$x] != "." && $machine_array[$x] != "..") {
				$info_file = $machine_array[$x]."/info.txt";
				$file = file_get_contents("./machines/$info_file");
				if (stristr("$file", "$search")) {
						$results = "true";
						break;
				} else {
						$results = "false";
				}
			}
		}
		if ($results == "true") {
			echo "<h1>Seach results for \"$search\"</h1>";
			echo "<table>
						<tr>
							<th>Mac Address</th>
							<th>Machine ID</th>
							<th>Description</th>";
							scan_th("./scripts/");
			echo "</tr>";
			for ($x = 0; $x < $machine_count; $x++) {
				if ($machine_array[$x] != "." && $machine_array[$x] != "..") {
					$info_file = $machine_array[$x]."/info.txt";
					$file = file_get_contents("./machines/$info_file");
					if (stristr("$file", "$search")) {
						$array = explode("|",$file);
						echo "
							<tr>
								<td>$array[0]</td>
								<td>$array[1]</td>
								<td>$array[2]</td>";
								check_box($machine_array[$x],"./scripts");
						echo "</tr>";
					}
				}
			}
			echo "</table>";
		} else {
			echo "<p class=\"search_no\">No results found for<br />\"$search\"</p>";
		}
		?>
	</div>
<?php
include "footer.php";
?>
