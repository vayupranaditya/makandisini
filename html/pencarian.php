<?php
	require "php/koneksi_ke_mysql.php";
	require "php/pemilihan_makanan.php";
	require "php/rank.php";
	echo 
	"
		<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
		<html xmlns='http://www.w3.org/1999/xhtml'>
		<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<title>tes_grid</title>
		<link href='css/bootstrap.min.css' rel='stylesheet' type='text/css' />
		<link href='css/tes_grid_bootstrap.css' rel='stylesheet' type='text/css' />
		</head>
			<body>
				<div class='header'>
					<div class='col-md-7 tentang pull-left'>
						<img src='images/logo_2.png' style='height:40px; position: relative; top:5px;'/>
					</div>
					<div class='col-md-5 pencarian pull-right'>
						<form action='under_maintenance.html' method='GET' style='position:relative; top:5px; right:10px;'>
							<span style='font-size:19px; line-height:37px; position:relative; left:5%;'>Pencarian Gerai </span>
							<input type='text' name='cari' class='pull-right' style='width:65%; height:40px; position:relative; resize:none;'/>
						</form>
					</div>
				</div>
				<div class='content'>
					<div class='penjaga_atas' style='height:50px;'>
					</div>";
					require "pencarian_gerai.php";
					echo
				"</div>
				<div class='footer col-md-12'>
					Makan Di Sini Ga?<br>
					Copyright 2017 by I Gusti Bagus Vayupranaditya Putraadinatha.
				</div>
			</body>
		</html>
	"
?>