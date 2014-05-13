<?php
include "header.php";
?>
<body>
	<div id="main_text">
		<h1>View Machines</h1>
		<table>
			<tr>
				<th>Mac Adress</th>
				<th>Machine ID</th>
				<th>Description</th>
				<th class="e">Print</th>
				<th class="e">Update</th>
				<th class="e">Default</th>
			</tr>

		<?php
		$dir = "./machines/";
		# read dir and put dirs in array
		$files = scandir($dir);
		# count number of dirs
		$count = count($files);
		
		for ($i = 2; $i < $count; $i++) {
			$file = "./machines/".$files[$i];
			$file_array = file("$file/info.txt");
			$dir_array = explode("|", $file_array[0]);

			echo "<tr>";
			echo "<td class=\"a\">".$dir_array[0]."</td>
				<td class=\"b\">".$dir_array[1]."</td>
				<td class=\"d\">".$dir_array[2]."</td>";
			if(is_link("./machines/".$files[$i]."/print")) {
				echo "<td class=\"e\">&#10003;</td>";
			} else {
				echo "<td class=\"e\"></td>";
			}
				echo "<td class=\"e\"></td>";
				echo "<td class=\"e\"></td>";
		}
		echo "</table>";
		?>
	</div>
</body>
<?php
include "footer.php";
?>
