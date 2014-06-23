<?php
include "header.php";
?>
<script src="./jquery/checkall.js"></script>
<script src="./jquery/code_pop.js"></script>
<script src="./jquery/new_script.js"></script>
<script src="./jquery/tabs.js"></script>
<body>
	<div id="main_text">
		<div id="script_pannel">
			<h3 class="pannel_head">Admin</h3>
			<ul>
				<li class="admin_li"><a class="admin_a" href="#Gobal">Global Scripts</a></li>
				<?php
				$scripts = scandir("./library/");
				$count = count($scripts);
				for ($x = 0; $x < $count; $x++) {
					if ($scripts[$x] != "." && $scripts[$x] != "..") {
						if (is_dir("./scripts/".$scripts[$x])) {
							echo "<li class=\"admin_li\"><a class=\"admin_a\" href=\"#$scripts[$x]\" tabIndex=\"$x\">$scripts[$x]</a></li>";
						}
					}
				}
				?>
			</ul>
		</div>
		<div id="Gobal" class="tabs">
			<div id="library">
				<h1>Library</h1>
				<?php
				$dir = "./library/global";
				$library = scandir($dir);
				$count = count($library);
				echo "<form action=\"admin_changes.php\" method=\"POST\">";
				echo "<table>";
				echo "<tr>
						<th>Script</th>
						<th>Code</th>
						<th>Action</th>
					</tr>";
				// x is each script in library folder
				for ($x = 0; $x < $count; $x++) {
					if ($library[$x] != "." && $library[$x] != "..") {
						$file = $library[$x];
						$content = file_get_contents("./library/global/$file");
						echo "<tr>";
						echo "<td>$file</td>
								<td><a class=\"a_code\" rowid=\"$x\" href=\"#$file\">".substr($content,0 ,50)."....</a></td>
								<td><button rowid=\"$x\" class=\"glob_edit_button\">&#9998;</button></td>
							</tr>";
						$content_br = str_replace("\n","<br />", $content);
						echo "<div rowid=\"$x\" class=\"backlight\">
							<div class=\"code_box\">
								<div id=\"header_pop\">
									<h2>Script</h2>
									<p class=\"exit\">X</p>
								</div>
								<div id=\"content_pop\">
									$content_br
								</div>
							</div>
						</div>";
						echo "</form>
						</div>";
						echo "<div id=\"glob_edit_wrap\">
								<div class=\"edit\" rowid=\"$x\">
									<h1 class=\"custom_h1\">Edit Script</h1>
									<form action=\"edit_script.php\" method=\"POST\">
										<textarea name=\"script\">$content</textarea>
										<input type=\"hidden\" name=\"file\" value=\"./library/global/$library[$x]\">
										<input class=\"submit\" type=\"submit\" name=\"submit\" value=\"Submit\">
										<input class=\"delete\" type=\"submit\" name=\"submit\" value=\"Delete Script\">
										<button class='cancel'>Cancel</button>
									</form>
								</div>
							</div>";
					}
				}
				echo "</table>";
				echo "<button class=\"glob_new_script_button\">+</button>";
				echo "<input type=\"submit\" value=\"Submit\">";
				echo "</form>
			</div>
		</div>";
		// scan scripts folder for each group and groups will be directories
		$script = scandir("./scripts/");
		$script_count = count($script);
		// x is the each group in scripts
		for ($x = 0; $x < $script_count; $x++) {
			if ($script[$x] != "." && $script[$x] != "..") {
				if (is_dir("./scripts/".$script[$x])) {
					echo "<div id=\"$script[$x]\" class=\"tabs\">
						<div id=\"library\">";
							echo "<h1>$script[$x]</h1>";
							echo "<form action=\"admin_changes.php\" method=\"POST\">";
							echo "<table>";
							echo "<tr>
								<th><input type=\"checkbox\" id=\"select_all\"></th>
								<th>Script</th>
								<th>Code</th>
								<th>Action</th>
							</tr>";
							// scan group folder in library to populate all possible scripts
							//FIXME Slurp in global scripts first
							$group_script = scandir("./library/$script[$x]/");
							$count = count($group_script);
							// s is each script in /library/group_script
							for ($s = 0; $s < $count; $s++) {
								if ($group_script[$s] != "." && $group_script[$s] != "..") {
									$file_group = "./library/$script[$x]/$group_script[$s]";
									// content_group gets scripts contents
									$content_group = file_get_contents($file_group);
									echo "<tr>";
									if(is_link("./scripts/$script[$x]/$group_script[$s]")) {
										echo "<td class=\"td_center\"><input class=\"checkbox1\" type=\"checkbox\" name=\"$group_script[$s]\" value=\"1\" checked /></td>";
									} else {
										echo "<td class=\"td_center\"><input class=\"checkbox1\" type=\"checkbox\" name=\"$group_script[$s]\" value=\"1\" /></td>";
									}
									echo "<td>$group_script[$s]</td>
										<td><a class=\"a_code\" rowid=\"$s\" href=\"#$group_script[$s]\">".substr($content_group,0 ,50)."....</a></td>
										<td><button rowid=\"$x\" class=\"edit_button\">&#9998;</button></td>
									</tr>";
									// replaces each newline call with a html break tag
									$content_br_group = str_replace("\n","<br />", $content_group);
									echo "<div rowid=\"$s\" class=\"backlight\">
										<div class=\"code_box\">
											<div id=\"header_pop\">
												<h2>Script</h2>
												<p class=\"exit\">X</p>
											</div>
											<div id=\"content_pop\">$content_br_group
											</div>
										</div>
									</div>";
									echo "<div id=\"edit_wrap\">
										<div class=\"edit\" rowid=\"$x\">
											<h1 class=\"custom_h1\">Edit Script</h1>
											<form action=\"edit_script.php\" method=\"POST\">
												<textarea name=\"script\">$content></textarea>
												<input type=\"hidden\" name=\"file\" value=\"./library/$script[$x]/$group_script[$s]\">
												<input class=\"submit\" type=\"submit\" name=\"submit\" value=\"Submit\">
												<input class=\"delete\" type=\"submit\" name=\"submit\" value=\"Delete Script\">
												<button class='cancel'>Cancel</button>
											</form>
										</div>
									</div>";
									echo "$script[$x]";
								}
							}
							echo "<div id=\"add_script\">
								<div id=\"new_script\">
									<h1 class=\"custom_h1\">New Script</h1>
									<form action=\"new_script.php\" method=\"POST\">
										<input class=\"script_name\" type=\"text\" name=\"file\" placeholder=\"Script Name\">
										<textarea name=\"new_script\" class=\"textarea_new_script\"></textarea>
										<input type=\"hidden\" name=\"dir\" value=\"./library/$script[$x]/\">
										<input class=\"add_script_submit\" type=\"submit\" value=\"Add Script\">
										<button class=\"cancel\">Cancel</button>
									</form>
								</div>
							</div>
							</table>
							<button class=\"new_script_button\">+</button>
							<input type=\"submit\" value=\"Submit\">
						</div>
						</form>
					</div>";
				}
			}
		}
		?>
		<div id="glob_add_script">
			<div id="new_script">
				<h1 class="custom_h1">New Script</h1>
				<form action="new_script.php" method="POST">
					<input class="script_name" type="text" name="file" placeholder="Script Name">
					<textarea name="new_script" class="textarea_new_script"></textarea>
					<input type="hidden" value="./library/global" name="dir">
					<input class="add_script_submit" type="submit" value="Add Script">
					<button class="cancel">Cancel</button>
				</form>
			</div>
		</div>
</div>
<?php
include "footer.php";
?>
