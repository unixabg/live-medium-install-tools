<?php
/*
## Copyright (C) 2014 silverburd.com
## Copyright (C) 2014 Richard Nelson <unixabg@gmail.com>
##
## This program comes with ABSOLUTELY NO WARRANTY; for details see COPYING.
## This is free software, and you are welcome to redistribute it
## under certain conditions; see COPYING for details.
*/
?>
<html>
<head>
	<title>LMIT</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="./jquery/jquery.js"></script>
	<script src="./jquery/edit_pop.js"></script>
</head>
<nav>
	<ul>
		<li><a href="index.php">View</a></li>
		<li><a href="manage.php">Manage</a></li>
		<li><a href="admin.php">Administrative</a></li>
	</ul>
	<ul class="search">
		<li>
			<form action="search.php" method="post">
				<input type="text" name="search" tabindex="1" autocomplete="off" placeholder="Search..">
			</form>
	</ul>
</nav>
