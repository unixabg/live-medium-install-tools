<?php
include "header.php";
?>
<script src="./jquery/checkall.js"></script>
<body>
	<div id="main_text">
	<!--<h1>Administrative</h1>-->
		<div id="script_pannel">
			<h3 class="pannel_head">Admin</h3>
			<ul>
				<li><a href="#library">Library</a></li>
				<!--<li><a href="#script">Scripts</a></li>-->
			</ul>
		</div>
		<div id="admin_area">
			<div id="library">
				<h1>Library</h1>
				<?php
				$dir = "./library/";
				$library = scandir($dir);
				$count = count($library);

				echo "<form action=\"admin_changes.php\" method=\"POST\">";
				echo "<input type=\"hidden\" name=\"count\" value=\"3\">";
				echo "<table>";
				echo "<tr>
						<th><input type=\"checkbox\" id=\"select_all\"></th>
						<th>Script</th>
						<th>Code</th>
						<th>Action</th>
					</tr>";
				for ($x = 2; $x < $count; $x++) {
					$content = substr(file_get_contents("./library/$library[$x]"), 0, 50);
					if(is_link("./scripts/$library[$x]")) {
						echo "<tr>
							<td class=\"td_center\"><input class=\"checkbox1\" type=\"checkbox\" name=\"$library[$x]\" value=\"1\" checked /></td>
							<td>$library[$x]</td>
							<td>$content....</td>
							<td></td>
						</tr>";
					} else {
						echo "<tr>
							<td class=\"td_center\"><input class=\"checkbox1\" type=\"checkbox\" name=\"$library[$x]\" value=\"1\" /></td>
							<td>$library[$x]</td>
							<td>$content....</td>
							<td></td>
						</tr>";
					}
				}
				echo "</table>";
				echo "<input type=\"submit\" value=\"Submit\">";
				?>
			</div>
		</div>
	</div>
<?php
include "footer.php";
?>
