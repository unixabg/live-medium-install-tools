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
		for ($x = 2; $x < $machine_count; $x++) {
			$info_file = $machine_array[$x]."/info.txt";
			$file = file_get_contents("./machines/$info_file");
			if (stristr("$file", "$search")) {
					$results = "true";
					break;
			} else {
					$results = "false";
			}
		}
		if ($results == "true") {
			echo "<h1>Seach results for \"$search\"</h1>";
			echo "<table>
						<tr>
							<th>Mac Address</th>
							<th>Machine ID</th>
							<th>Description</th>";
							for($x = 2; $x < $count_scripts; $x++) {
								echo "<th class=\"e\">".$scripts[$x]."</th>";
							}
			echo "</tr>";
			for ($x = 2; $x < $machine_count; $x++) {
				$info_file = $machine_array[$x]."/info.txt";
				$file = file_get_contents("./machines/$info_file");
				if (stristr("$file", "$search")) {
					$array = explode("|",$file);
					echo "
						<tr>
							<td>$array[0]</td>
							<td>$array[1]</td>
							<td>$array[2]</td>";
							for ($i = 2; $i < $count_scripts; $i++) {
								if (is_link("./machines/".$files[$x]."/".$scripts[$x]) || is_file("./machines/".$files[$i]."/".$scripts[$x])) {
									echo "<td class=\"e\">&#10003;</td>";
								} else {
									echo "<td class=\"e\"></td>";
								}
							}
						echo "</tr>";
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
