<?php
include "header.php";
?>
<body>
	<div id="conholder">
		<div id="maincon">
			<h1 class="texth1">Live-Medium-Install Related Scripts</h1>
			<h4 class="texth4">
			<ul>

<?php
$files = scandir( "./scripts/" );
foreach( $files as $file ){
	if ($file != '.' && $file != '..' ) {
		echo "<li> <a href=\"./scripts/" . $file . "\">" . $file . "</a></li>";
	}
}
?>

			</ul>
			</h4>
		</div>
	</div>
<?php
include "footer.php";
?>
