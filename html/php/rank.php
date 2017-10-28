<?php
	require "koneksi_ke_mysql.php";
	function
		sepuluh_besar_tanpa_kategori()
			{
				require "koneksi_ke_mysql.php";
				global $db_tabel_nilai;
				$cari_sepuluh_besar_tanpa_kategori=
					mysqli_query(
						$link, 
							"SELECT * FROM ".$db_tabel_nilai."
							WHERE muncul > 0
							ORDER BY rataan_nilai DESC
							LIMIT 10");
				$rank=1;
				while ($sepuluh_besar=mysqli_fetch_array($cari_sepuluh_besar_tanpa_kategori))
				{
					echo $rank.". ".$sepuluh_besar['nama_gerai'].": ".$sepuluh_besar['kategori']."<br>";
					$rank+=1;
				}

			}
	function
		sepuluh_besar_kategori_umum()
			{
				require "koneksi_ke_mysql.php";
				global $db_tabel_nilai;
				$cari_sepuluh_besar_kategori_umum=
					mysqli_query(
						$link, 
							"SELECT * FROM ".$db_tabel_nilai."
							WHERE muncul > 0
							AND kategori='umum'
							ORDER BY rataan_nilai DESC
							LIMIT 10");
				$rank=1;
				while ($sepuluh_besar=mysqli_fetch_array($cari_sepuluh_besar_kategori_umum))
				{
					echo $rank.". ".$sepuluh_besar['nama_gerai']."<br>";
					$rank+=1;
				}

			}
	function
		sepuluh_besar_kategori_lalapan()
			{
				require "koneksi_ke_mysql.php";
				global $db_tabel_nilai;
				$cari_sepuluh_besar_kategori_lalapan=
					mysqli_query(
						$link, 
							"SELECT * FROM ".$db_tabel_nilai."
							WHERE muncul > 0
							AND kategori='lalapan'
							ORDER BY rataan_nilai DESC
							LIMIT 10");
				$rank=1;
				while ($sepuluh_besar=mysqli_fetch_array($cari_sepuluh_besar_kategori_lalapan))
				{
					echo $rank.". ".$sepuluh_besar['nama_gerai']."<br>";
					$rank+=1;
				}

			}
	function
		sepuluh_besar_kategori_mie()
			{
				require "koneksi_ke_mysql.php";
				global $db_tabel_nilai;
				$cari_sepuluh_besar_kategori_mie=
					mysqli_query(
						$link, 
							"SELECT * FROM ".$db_tabel_nilai."
							WHERE muncul > 0
							AND kategori='mie'
							ORDER BY rataan_nilai DESC
							LIMIT 10");
				$rank=1;
				while ($sepuluh_besar=mysqli_fetch_array($cari_sepuluh_besar_kategori_mie))
				{
					echo $rank.". ".$sepuluh_besar['nama_gerai']."<br>";
					$rank+=1;
				}

			}
?>