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
		<title>Makan Di Sini Ga??</title>
		<link rel='icon' href='images/favicon_1.png' type='image'/>
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
					</div>
					<div class='pertanyaan' style='background-color:#".$warna[0]."'>
						Di antara kedua gerai di bawah, mana yang lebih baik dalam hal ".$penilaian_terpilih."?
					</div>
					<a href='php/hitung_skor.php?penilaian=".$penilaian_terpilih."&terpilih=".$gerai_a_nama."&gagal=".$gerai_b_nama."'>
						<div class='col-md-5 pull-left pilihan' style='background-color:#".$warna[1]."; height:200px'>
							";
							penulisan_gerai_a();
							echo
							"
						</div>
					</a>
					<a href='php/hitung_skor.php?penilaian=".$penilaian_terpilih."&terpilih=".$gerai_b_nama."&gagal=".$gerai_a_nama."'>
						<div class='col-md-5 pull-right pilihan' style='background-color:#".$warna[2]."; height:200px'>
							";
							penulisan_gerai_b();
							echo
							"
						</div>
					</a>
					<div class='atau' style='background-color#000; height:150px;'>
						atau
					</div>
					<div style='clear:both'>
					</div>
					<a href='tes_pake_php.php'>
						<div class='dunno' style='background-color:#".$warna[3].";'>
							<span style='position:relative; top:-50px;'>Tidak yakin</span>
						</div>
					</a>
					<div class='judul_rank col-md-12'>
						Inilah gerai-gerai paling banyak dipilih dalam tiap kategori...
					</div>
					<div class='tampilkan_rank'>
						<div class='col-md-3 rank rank_ganjil'>
							<span style='text-align:center;'>Semua Kategori</span><br>
							<br>
							";
							sepuluh_besar_tanpa_kategori();
							echo
							"
						</div>
						<div class='col-md-3 rank rank_genap'>
							<span style='text-align:center;'>Umum</span><br>
							<br>
							";
							sepuluh_besar_kategori_umum();
							echo
							"
						</div>
						<div class='col-md-3 rank rank_ganjil'>
							<span style='text-align:center;'>Lalapan</span><br>
							<br>
							";
							sepuluh_besar_kategori_lalapan();
							echo
							"
						</div>
						<div class='col-md-3 rank rank_genap'>
							<span style='text-align:center;'>Mie</span><br>
							<br>
							";
							sepuluh_besar_kategori_mie();
							echo
							"
						</div>
					</div>
					<div style='clear:both;'>
					</div>
				</div>
				<div class='footer col-md-12'>
					Makan Di Sini Ga?<br>
					Copyright 2017 by I Gusti Bagus Vayupranaditya Putraadinatha.
				</div>
			</body>
		</html>
	"
?>