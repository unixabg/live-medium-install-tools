<?php
include "header.php";
$scripts = scandir('./scripts/');
$count_scripts = count($scripts);
?>
<body>
	<div id="main_text">
		<h1>View Machines</h1>
		<table>
			<tr>
				<th>Mac Adress</th>
				<th>Machine ID</th>
				<th>Description</th>
				<?php
				scan_th("./scripts/");
				?>
			</tr>

		<?php
		$dir = "./machines/";
		# read dir and put dirs in array
		$files = scandir($dir);
		# count number of dirs
		$count = count($files);

		for ($i = 0; $i < $count; $i++) {
			if ($files[$i] != "." && $files[$i] != "..") {
				$file = "./machines/".$files[$i];
				$file_array = file("$file/info.txt");
				$dir_array = explode("|", $file_array[0]);

				echo "<tr>";
				echo "<td class=\"a\">".$dir_array[0]."</td>
					<td class=\"b\">".$dir_array[1]."</td>
					<td class=\"d\">".$dir_array[2]."</td>";
				check_box($files[$i], "./scripts/");
			}
		}
			echo "</table>";
		?>
	</div>
<?php
include "footer.php";
?>
