<?php
include "header.php";
if (!empty($_GET['mgroup'])) {
	$mgroup = $_GET['mgroup'];
} else {
	$mgroup = "";
}
$scripts = scandir("./scripts/$mgroup");
$count_scripts = count($scripts);
?>
<body>
	<div id="main_text">
		<h1>View Machines</h1>
		<?php
		if (!empty($mgroup)) {
			view_table($mgroup);
		} else {
			$group = scandir("./machines/");
			$group_count = count($group);
			for ($g = 0; $g < $group_count; $g++) {
				if ($group[$g] != "." && $group[$g] != "..") {
					echo "<h1><a class=\"a_h1\" href=\"index.php?mgroup=$group[$g]\">$group[$g]</a></h1>";
					view_table($group[$g]);
				}
			}
		}
		?>

	</div>
<?php
include "footer.php";
?>
