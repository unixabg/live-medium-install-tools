<?php
$submit = $_POST["submit"];
$old_group = $_POST["old_group"];
if ($submit == "Move Machines") {
	echo $check;
	$new_group = $_POST["new_group"];
	$machine = scandir("./machines/$old_group/");
	$machine_count = count($machine);
	// this gets every machine selected to move
	for ($m = 0; $m < $machine_count; $m++) {
		if (isset($_POST["$machine[$m]move_select"])) {
			$mac = $_POST["$machine[$m]mac"];
			$id = $_POST["$machine[$m]id"];
			$description = $_POST["$machine[$m]description"];
			// make new dir in new group
			mkdir("./machines/$new_group/$mac/");
			// copy info.txt into new machine group
			copy("./machines/$old_group/$mac/info.txt", "./machines/$new_group/$mac/info.txt");
			$file = scandir("./machines/$old_group/$mac/");
			// remove all files before deleting machines group location
			foreach ($file as $delete) {
				unlink("./machines/$old_group/$mac/$delete");
			}
			// delete machine in old group
			rmdir("./machines/$old_group/$mac/");
		}
	}
} elseif ($submit == "New Group") {
	$group_name = $_POST['group_name'];
	mkdir("./machines/$group_name/");
	mkdir("./scripts/$group_name/");
	mkdir("./library/$group_name/");
	echo "New Group: $group_name";
} else {

}
header('Location: admin.php?action=group');
?>
