<?php
include "header.php";
$scripts = scandir('./scripts/');
$count_scripts = count($scripts);
?>
<body>
<div id="main_text">
<h1>Manage Machines</h1>
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
		<div id="text_input">
			<input class="input_mac" type="text" name="mac" maxlength="17" placeholder="Mac Address">
			<input class="input_id" type="text" name="id" placeholder="Machine ID">
			<input type="text" name="description" placeholder="Machine Description">
		</div>
		<?php
		echo "<div id=\"checkbox_script\">";
		for ($x = 2; $x < $count_scripts; $x++) {
			if (is_file("./scripts/$scripts[$x]") && $scripts[$x] != 'custom') {
				echo "$scripts[$x]<input type=\"checkbox\" name=\"$scripts[$x]\" value=\"1\"> ";
			}
		}
		echo "</div>";
		?>
		<input class = "submit" type="submit" name="add" value="Add Machine">
	</form>

<?php
$mac = htmlspecialchars($_POST['mac']);
$id = htmlspecialchars($_POST['id']);
$description = htmlspecialchars($_POST['description']);
$print = htmlspecialchars($_POST['print']);
$data = "$mac|$id|$description|$print";

if (!empty($mac)) {
	if (is_dir("./machines/$mac") && !is_dir("./machines/ ")) {
		echo "<h3> <font color=\"red\">Machine exist.</font></h3>";
	} else {
		if (!preg_match('/^(?:[0-9a-fA-F]{2}[:;.]?){6}$/', $mac)) {
			echo "<h3><font color='red'>Invalid Mac Address</font></h3>";
		} else {
			mkdir("./machines/$mac/", 0777);
			$fh = fopen("./machines/$mac/info.txt", 'w');
			fwrite($fh,$data);
			fclose($fh);
			for ($x = 2; $x < $count_scripts; $x++) {
				$post = $_POST[$scripts[$x]];
				if ($post == "1") {
					// Step back up two dirs for the symlink.
					symlink("../../scripts/$scripts[$x]", "./machines/$mac/$scripts[$x]");
				}
			}
		}
	}
}
?>

<table>
	<tr>
		<th>Mac Adress</th>
		<th>Machine ID</th>
		<th>Description</th>
		<?php
		for($x = 2; $x < $count_scripts; $x++) {
			echo "<th class=\"e\">".$scripts[$x]."</th>";
		}
		?>
		<th>Edit</th>
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
	$count_array = count($dir_array);
	echo "<tr>";
	echo "<td class=\"a\">".$dir_array[0]."</td>
		<td class=\"b\">".$dir_array[1]."</td>
		<td class=\"d\">".$dir_array[2]."</td>";
		for ($x = 2; $x < $count_scripts; $x++) {
			if (is_link("./machines/".$files[$i]."/".$scripts[$x]) || is_file("./machines/".$files[$i]."/".$scripts[$x])) {
				echo "<td class=\"e\">&#10003;</td>";
			} else {
				echo "<td class=\"e\"></td>";
			}
		}
		echo "<td>
			<form class='edit_form' action='edit.php' method='POST'>
				<input type='hidden' name='mac' value='".$dir_array[0]."'>
				<input type='hidden' name='id' value='".$dir_array[1]."'>
				<input type='hidden' name='description' value='".$dir_array[2]."'>
				<input type='hidden' name='print' value='".$dir_array[3]."'>
				<input type='hidden' name='file' value='".$file."'>
				<input type='submit' name='submit' onclick='return deleteConfirm(this)' value='&#9998;'>
				<input type='submit' name='submit' onclick='return deleteConfirm(this)' value='X'>
			</form>
		</td>
	</tr>";
}
?>
<script>
function deleteConfirm(e) {
// I need to know which submit button was pressed.
	if (e.value=='X'){
		var answer = confirm("Are you sure you want to delete this machine?")
		if (answer){
			return true;
		} else{
			return false;
		}
	}
}
</script>
<?php
include "footer.php";
?>
