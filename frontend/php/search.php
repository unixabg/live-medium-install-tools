<?php
include "header.php";
?>
<body>
	<div id="main_text">
		<?php
		$search = $_POST['search'];
		
		$file = file_get_contents("./machines/$search/info.txt");
		$file_array = explode("|", $file);
		if (is_dir("./machines/$search")) {
			echo "<h1>Search results for $search";
			echo "<table>
				<tr>
					<th>Mac Address</th>
					<th>Machine ID</th>
					<th>Description</th>
					<th>Printing</th>
				</tr>
				<tr>
					<td>$file_array[0]</td>
					<td>$file_array[1]</td>
					<td>$file_array[2]</td>
					<td>$file_array[3]</td>
				</tr>
				</table>";	
		} else {
			echo "<p class=\"search_no\">No results found for <br />\"$search\"</p>";
		}
		?>
			
	</div>
</body>
<?php
include "footer.php";
?>
