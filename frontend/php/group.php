<?php
include "header.php";
?>
<script src="./jquery/checkall.js"></script>
<script src="./jquery/tabs.js"></script>
<body>
	<div id="main_text">
		<div id="script_pannel">
			<h3 class="pannel_head">Admin</h3>
			<ul>
				<li class="admin_li"><a class="admin_a" href="#add_group">Add Group</a></li>
				<?php
				$machines = scandir("./machines/");
				$count = count($machines);
				for ($x = 0; $x < $count; $x++) {
					if ($machines[$x] != "." && $machines[$x] != "..") {
						echo "<li class=\"admin_li\"><a class=\"admin_a\" href=\"#$machines[$x]\" tabIndex=\"$x\">$machines[$x]</a></li>";
					}
				}
				?>
			</ul>
		</div>
		<div id="add_group" class="tabs">
			<div id="library">
				<h1>Add Group</h1>
					<form action="group_changes.php" method="POST">
						<input type="text" name="group_name" placeholder="New Group Name">
						<input type="submit" name="submit" value="New Group">
					</form>
			</div>
		</div>
		<?php
		// scan machine folder for groups
		$group = scandir("./machines/");
		$group_count = count($group);
		// $g represents the array number for each group in machines
		for ($g = 0; $g < $group_count; $g++) {
			if ($group[$g] != "." && $group[$g] != "..") {
				echo "<div id=\"$group[$g]\" class=\"tabs\">
						<div id=\"library\">
							<h1>$group[$g]</h1>
							<form action=\"group_changes.php\" method=\"POST\">
								<table>
									<tr>
										<th><input type=\"checkbox\" id=\"select_all\"></th>
										<th>Mac Address</th>
										<th>Machine ID</th>
										<th>Description</th>
									</tr>";
				// scan group folder in library to populate all possible scripts
				$machine = scandir("./machines/$group[$g]/");
				$machine_count = count($machine);
				for ($m = 0; $m < $machine_count; $m++) {
					if ($machine[$m] != "." && $machine[$m] != "..") {
						echo "<tr>
								<td class=\"td_center\"><input class=\"checkbox1\" type=\"checkbox\" name=\"$machine[$m]move_select\" value=\"1\"></td>";
						$info_txt = file("./machines/$group[$g]/$machine[$m]/info.txt");
						$info_array = explode("|", $info_txt[0]);
						echo "<td>$info_array[0]</td>
								<td>$info_array[1]</td>
								<td>$info_array[2]</td>
							</tr>
							<input type=\"hidden\" name=\"$machine[$m]mac\" value=\"$info_array[0]\">
							<input type=\"hidden\" name=\"$machine[$m]id\" value=\"$info_array[1]\">
							<input type=\"hidden\" name=\"$machine[$m]description\" value=\"$info_array[2]\">
							<input type=\"hidden\" name=\"old_group\" value=\"$group[$g]\">";
					}
				}
				echo "</table>
						<select name=\"new_group\" class=\"move\">
							<option>New Group</option>";
						for ($o = 0; $o < $group_count; $o++) {
							if ($group[$o] != "." && $group[$o] != "..") {
								echo "<option value=\"$group[$o]\">$group[$o]</option>";
							}
						}
						echo "</select>
						<input class=\"delete_group\" type=\"submit\" value=\"Delete Group\">
						<input class=\"move\" name=\"submit\" type=\"submit\" value=\"Move Machines\">
					</form>
				</div>
			</div>";
			// end of if statment that excludes . and ..
			}
		// end of library group scan
		}
		?>
	</div>
<?php
include "footer.php";
?>
