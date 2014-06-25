<?php
$mgroup = $_POST['mgroup'];
$dir = "./library/$mgroup";
$library = scandir($dir);
$count = count($library);
$submit = $_POST['submit'];
if ($submit == 'Submit') {
	for ($x = 0; $x < $count; $x++) {
		if ($library[$x] != "." && $library[$x] != "..") {
			$post = $_POST[$library[$x]];
			if (isset($post)) {
				// Step up one dir from anticipated symlink target.
				symlink("../library/$mgroup/$library[$x]", "./scripts/$mgroup/$library[$x]");
			} elseif ($post != "1") {
				unlink("./scripts/$mgroup/$library[$x]");
			}
		$status = "Modified scripts in $mgroup.|green";
		}
	}
} else {
	$edit_file = $_POST['edit_file'];
	$edit_script = $_POST['edit_script'];
	echo $edit_script."<br />";
	$edit_script = preg_replace("/\r\n/", "\n", $edit_script); // DOS style newlines
	$edit_script = preg_replace("/\r/", "\n", $edit_script); // Mac newlines for nostalgia
	$machine = scandir("./machines/$mgroup/");
	$count_machines = count($machine);
	if ($submit == "Submit Changes") {
		file_put_contents("./library/$edit_file", $edit_script);
	} else {
		unlink("./library/$edit_file");
		if (is_link("./scripts/$edit_file")) {
			unlink("./scripts/$edit_file");
			$status = "Script successfully deleted";
		}
		for ($x = 0; $x < $count_machines; $x++) {
			if ($machine[$x] != "." && $machine[$x] != "..") {
				if (is_link("./machines/$machine[$x]/$edit_file")) {
					unlink("./machines/$machine[$x]/$edit_file");
				}
			}
		}
	}
}
echo "<form id=\"form\" action=\"admin.php\" method=\"POST\">
		<input type=\"hidden\" name=\"status\" value=\"$status\">
	</form>
	<script>document.getElementById(\"form\").submit();</script>";
?>
