<?php
$submit = $_POST["submit"];
$old_group = $_POST["old_group"];
if ($submit == "Move Machines") {
	$new_group = $_POST["new_group"];
	$machine = scandir("./machines/$old_group/");
	$machine_count = count($machine);
	for ($m = 0; $m < $machine_count; $m++) {
		if ($machine[$m] != "." && $machine[$m] != "..") {
			$mac = $_POST["$machine[$m]mac"];
			$id = $_POST["$machine[$m]id"];
			$description = $_POST["$machine[$m]description"];
			if (isset($_POST["$machine[$m]select"])) {
				mkdir("./machines/$new_group/$mac/");
				copy("./machines/$old_group/$mac/info.txt", "./machines/$new_group/$mac/info.txt");
				$file = scandir("./machines/$old_group/$mac");
				foreach ($file as $info) {
					unlink("./machines/$old_group/$mac/$info");
				}
				rmdir("./machines/$old_group/$mac");
				$status = "Machines(s) successfully moved to $new_group.|green";
			}
		}
	}
} elseif ($submit == "New Group") {
	$new_group = $_POST['group_name'];
	$new_group = str_replace(" ", "_", $new_group);
	if (!preg_match("/[^-A-Za-z0-9._ ]/", $new_group)) {
		mkdir("./machines/$new_group/");
		mkdir("./library/$new_group/");
		mkdir("./scripts/$new_group/");
		$status = "$new_group successfully created.|green";
	} else {
		$status = "Invalid Character on Group Name.|red";
	}
} else {
	if (!rmdir("./machines/$old_group/") || !rmdir("./library/$old_group/") || !rmdir("./scripts/$old_group/")) {
		$status = "Group still contains file(s). Please go back and move or delete file(s).|red";
	} else {
		$status = "$old_group successfully deleted.|green";
		rmdir("./machines/$old_group/");
		rmdir("./library/$old_group/");
		rmdir("./scripts/$old_group/");
	}
}
echo "<form id=\"form\" action=\"group.php\" method=\"POST\">
		<input type=\"hidden\" name=\"status\" value=\"$status\">
	</form>
	<script>document.getElementById(\"form\").submit();</script>";
?>
