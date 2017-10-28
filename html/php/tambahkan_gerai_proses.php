<?php
	require "koneksi_ke_mysql.php";
	if (isset($_POST["nama_gerai_a"]))																	#MEMASTIKAN TIDAK DIBUKA MANUAL
	{
		if ((empty($_POST["nama_gerai_a"]) || empty($_POST["nama_gerai_b"]))
			||
			$_POST["nama_gerai_a"] === $_POST["nama_gerai_b"]) 											#KALAU ADA NAMA GERAI YANG KOSONG, ATAU KEDUA GERAI NAMANYA SAMA, MAKA
		{
			header("location:tambah_gerai_gagal.php?status=penambahan_gagal");
		}
		$kategori=$_POST["kategori"];
		
		
		#GERAI A
		$nama_gerai_a=$_POST["nama_gerai_a"];
		$nama_gerai_a=str_replace("'", "\'", $nama_gerai_a);
		$nama_gerai_a=str_replace('"', '\"', $nama_gerai_a);											#READ & ANTI CROSS SITE SCRIPTING GERAI A
		mysqli_query(
			$link, 
				"SELECT * FROM ".$db_tabel_nilai." 
				WHERE nama_gerai ='".$nama_gerai_a."'");
		$gerai_ditemukan=mysqli_affected_rows($link);													#MENGECEK KEBERADAAN NAMA GERAI A SEBELUMNYA
		if ($gerai_ditemukan == 0)																		#KALAU GERAI BARU, MAKA
		{
			$tambahkan_gerai_a=
				mysqli_query(
					$link, 
						"INSERT INTO ".$db_tabel_nilai." 
						(nama_gerai, kategori) 
						VALUES 
						('".$nama_gerai_a."','".$kategori."')");										#BUAT GERAI A DI DATABASE
			$gerai_baru_dibuat=
				mysqli_query(
					$link, 
						"SELECT * FROM ".$db_tabel_nilai." 
						WHERE nama_gerai ='".$nama_gerai_a."'");										#SELECT GERAI A
			$gerai=mysqli_fetch_array($gerai_baru_dibuat, MYSQLI_ASSOC);
			$penilaian=array("rasa","harga","waktu","ongkir","kenyamanan");								#PENILAIAN YANG ADA
			$poin=array("muncul","skor");																#POIN YANG DICEK
			for($penilaian_ke=0; $penilaian_ke<count($penilaian); $penilaian_ke++)
			{
				for ($poin_ke=0; $poin_ke<count($poin); $poin_ke++)
				{
					mysqli_query(
						$link, "INSERT INTO ".$db_tabel_penilaian." 
						(id_gerai, nama_gerai, penilaian) 
						VALUES 
						(".$gerai['id_gerai'].",'".$gerai['nama_gerai']."','".$penilaian[$penilaian_ke]."_".$poin[$poin_ke]."');");
				}
			}																							#MASUKIN GERAI A DI TABEL PENILAIAN
		}
			
			
				$nama_gerai_b=$_POST["nama_gerai_b"];
		$nama_gerai_b=str_replace("'", "\'", $nama_gerai_b);
		$nama_gerai_b=str_replace('"', '\"', $nama_gerai_b);											#READ & ANTI CROSS SITE SCRIPTING GERAI B
		mysqli_query(
			$link, 
				"SELECT * FROM ".$db_tabel_nilai." 
				WHERE nama_gerai ='".$nama_gerai_b."'");
		$gerai_ditemukan=mysqli_affected_rows($link);													#MENGECEK KEBERADAAN NAMA GERAI B SEBELUMNYA
		if ($gerai_ditemukan == 0)																		#KALAU GERAI BARU, MAKA
		{
			$tambahkan_gerai_b=
				mysqli_query(
					$link, 
						"INSERT INTO ".$db_tabel_nilai." 
						(nama_gerai, kategori) 
						VALUES 
						('".$nama_gerai_b."','".$kategori."')");										#BUAT GERAI B DI DATABASE
			$gerai_baru_dibuat=
				mysqli_query(
					$link, 
						"SELECT * FROM ".$db_tabel_nilai." 
						WHERE nama_gerai ='".$nama_gerai_b."'");										#SELECT GERAI B
			$gerai=mysqli_fetch_array($gerai_baru_dibuat, MYSQLI_ASSOC);
			$penilaian=array("rasa","harga","waktu","ongkir","kenyamanan");								#PENILAIAN YANG ADA
			$poin=array("muncul","skor");																#POIN YANG DICEK
			for($penilaian_ke=0; $penilaian_ke<count($penilaian); $penilaian_ke++)
			{
				for ($poin_ke=0; $poin_ke<count($poin); $poin_ke++)
				{
					mysqli_query(
						$link, "INSERT INTO ".$db_tabel_penilaian." 
						(id_gerai, nama_gerai, penilaian) 
						VALUES 
						(".$gerai['id_gerai'].",'".$gerai['nama_gerai']."','".$penilaian[$penilaian_ke]."_".$poin[$poin_ke]."');");
				}
			}																							#MASUKIN GERAI B DI TABEL PENILAIAN
		}
			
		if ($tambahkan_gerai_a && $tambahkan_gerai_b)
		{
			header("location:tambahkan_gerai.php?status=tambah_gerai_berhasil");
		}
		else
		{
			header("location:tambahkan_gerai.php?status=tambah_gerai_gagal");
		}
	}
	header("location:tambahkan_gerai.php");
?>