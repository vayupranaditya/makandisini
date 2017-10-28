<?php
	echo 
	"<html>
		<head>
			<title>Telkom Food Rank</title>
		</head>
		<body>
	";
	require "pemilihan_makanan.php";
	echo
	"
		Telkom Food Rank Hall of Fame:<br>
	";
	require "rank.php";
	echo 
	"
		</body>
	"
?>