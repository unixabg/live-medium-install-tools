<?php
include "header.php";
?>
<body>
	<div id="main_text">
		<h1>Edit Machine</h1>
		<?php
		$scripts = scandir('./scripts/');
		$count_scripts = count($scripts);

		$mac = $_POST['mac'];
		$id = $_POST['id'];
		$description = $_POST['description'];
		$print = $_POST['print'];
		$custom = $_POST['custom'];
		$submit = $_POST['submit'];
		$file = $_POST['file'];
		echo $custom;
		if ($submit == "&#9998;") {
			if (!preg_match('/^(?:[0-9a-fA-F]{2}[:;.]?){6}$/', $mac)) {
				echo "<h2 color=\"red\">Invalid Mac address</h2>";
			} else {
				echo "<form action=\"save_changes.php\" method=\"POST\">
						<div id=\"text_input\">
						Mac:<input class=\"input_mac\" type=\"text\" name=\"mac_edit\" maxlength=\"17\" value=\"$mac\">
						ID:<input class=\"input_id\" type=\"text\" name=\"id_edit\" value=\"$id\">
						Description:<input type=\"text\" name=\"description_edit\" value=\"$description\"></div>";
				echo "<div id=\"checkbox_script\">";
				for ($x = 2; $x < $count_scripts; $x++) {
					if(is_link("./machines/$mac/".$scripts[$x])) {
						echo $scripts[$x].":<input type='checkbox' name='".$scripts[$x]."' value='1' checked>";
					} elseif ($scripts[$x] == 'custom') {
						echo "<button class='custom'>Custom</button>";
					} else {
						echo $scripts[$x].":<input type='checkbox' name='".$scripts[$x]."' value='1'>";
					}
				}
				echo "</div>";
				echo "<input type=\"hidden\" name=\"file\" value=\"$file/info.txt\">
						<input class='save' type=\"submit\" name='submit' value=\"Save\">
			</form>";
			}
		} elseif ($submit =="X") {
			$dir = scandir($file);
			$count = count($dir);
			echo $count;
			echo "<br />";
			echo "$file/$dir[2]";
			echo "<br />";
			for ($i = 2; $i < $count; $i++) {
				if(!unlink("$file/".$dir[$i])) {
					echo "Couldn't delete file.";
				} else {
					unlink($file/$dir[$i]);
				}
			}
			if(!rmdir($file)) {
				echo "Couldn't delete dir";
			} else {
				rmdir($file);
				header('Location: ./manage.php');
			}
		}
		?>
		<?php
		$custom = file_get_contents("machines/$mac/custom");
		?>
	</div>
	<div id="edit_wrap">
		<div class="edit">
			<h1 class="custom_h1">Custom Script</h1>
			<form action="custom.php" method="POST">
					<input type="hidden" name="mac" value="<?php echo $mac;?>">
					<textarea name="custom" rows="24" cols="83"><?php echo $custom;?></textarea>
					<input class="submit" type="submit" name="submit" value="Submit">
					<input class="delete" type="submit" name="submit" value="Delete Script">
					<button class='cancel'>Cancel</button>
			</form>
		</div>
	</div>
<?php
include "footer.php";
?>
