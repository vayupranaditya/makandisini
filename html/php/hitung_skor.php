<?php
	require "koneksi_ke_mysql.php";
	
	#MEMASTIKAN HALAMAN INI NGGAK DIBUKA MANUAL
	$halaman_asal=$_SERVER["HTTP_REFERER"];															#HALAMAN ASAL YANG LENGKAP
	$exploded_halaman_asal=explode("?", $halaman_asal);												#MEMASTIKAN PENULISAN HALAMAN ASAL SESUAI CONTOH
	$halaman_asal=$exploded_halaman_asal[0];														#MENGAMBIL FULL DIRECTORY HALAMAN ASAL
	$exploded_file_halaman_asal=explode("/", $halaman_asal);										#MENGEXPLODE DIRECTORY HALAMAN ASAL
	$file_halaman_asal=end($exploded_file_halaman_asal);											#MENGAMBIL NAMA FILE HALAMAN ASAL SAJA
	$nama_file_halaman_asal_benar="tes_pake_php.php";
	if ($file_halaman_asal != $nama_file_halaman_asal_benar)
	{
		header("location:../tes_pake_php.php");
	}
	
	#NGAMBIL SEMUA VARIABEL
	$nama_gerai_terpilih=$_GET["terpilih"];
	$nama_gerai_terpilih=str_replace("'", "\'", $nama_gerai_terpilih);								#ANTI CROSS-SITE SCRIPTING
	$nama_gerai_terpilih=str_replace('"', '\"', $nama_gerai_terpilih);								#ANTI CROSS-SITE SCRIPTING
	$penilaian_dipakai=$_GET["penilaian"];
	$nama_gerai_tidak_terpilih=$_GET["gagal"];
	
	#MENGAMBIL DATA DI DATABASE
	$data_umum_gerai_terpilih=
		mysqli_query(
			$link,
				"SELECT * FROM ".$db_tabel_nilai."
				WHERE nama_gerai='".$nama_gerai_terpilih."'");										#SELECT DATA UMUM GERAI YANG TERPILIH
	$data_umum_gerai_tidak_terpilih=
		mysqli_query(
			$link,
				"SELECT * FROM ".$db_tabel_nilai."
				WHERE nama_gerai='".$nama_gerai_tidak_terpilih."'");								#SELECT DATA UMUM GERAI YANG TIDAK TERPILIH
	$data_detail_gerai_terpilih=
		mysqli_query(
			$link,
				"SELECT * FROM ".$db_tabel_penilaian."
				WHERE nama_gerai='".$nama_gerai_terpilih."'
				AND penilaian='".$penilaian_dipakai."_skor'");										#SELECT DATA DETAIL GERAI YANG TERPILIH
	$data_detail_gerai_tidak_terpilih=
		mysqli_query(
			$link,
				"SELECT * FROM ".$db_tabel_penilaian."
				WHERE nama_gerai='".$nama_gerai_tidak_terpilih."'
				AND penilaian='".$penilaian_dipakai."_skor'");										#SELECT DATA DETAIL GERAI YANG TIDAK TERPILIH
	
	$data_umum_gerai_terpilih=mysqli_fetch_array($data_umum_gerai_terpilih);						#FETCH ARRAY DATA UMUM GERAI TERPILIH
	$data_umum_gerai_tidak_terpilih=mysqli_fetch_array($data_umum_gerai_tidak_terpilih);			#FETCH ARRAY DATA UMUM GERAI TIDAK TERPILIH
	$data_detail_gerai_terpilih=mysqli_fetch_array($data_detail_gerai_terpilih);					#FETCH ARRAY DATA KHUSUS GERAI TERPILIH
	$data_detail_gerai_tidak_terpilih=mysqli_fetch_array($data_detail_gerai_tidak_terpilih);		#FETCH ARRAY DATA KHUSUS GERAI TIDAK TERPILIH
	
	$nilai_umum_gerai_terpilih=$data_umum_gerai_terpilih["nilai"];
	$nilai_umum_gerai_tidak_terpilih=$data_umum_gerai_tidak_terpilih["nilai"];
	$nilai_penilaian_gerai_terpilih=$data_detail_gerai_terpilih["penilaian_skor"];
	
	$kemunculan_umum_gerai_terpilih=$data_umum_gerai_terpilih["muncul"];
	$kemunculan_umum_gerai_tidak_terpilih=$data_umum_gerai_tidak_terpilih["muncul"];
	$kemunculan_penilaian_gerai_terpilih=$data_detail_gerai_terpilih["penilaian_muncul"];
	$kemunculan_penilaian_gerai_tidak_terpilih=$data_detail_gerai_tidak_terpilih["penilaian_muncul"];
	
	$nilai_rataan_umum_gerai_terpilih=$data_umum_gerai_terpilih["rataan_nilai"];
	$nilai_rataan_umum_gerai_tidak_terpilih=$data_umum_gerai_tidak_terpilih["rataan_nilai"];
	
	#MENAMBAHKAN KEMUNCULAN
	$kemunculan_umum_gerai_terpilih+=1;
	$kemunculan_umum_gerai_tidak_terpilih+=1;
	$kemunculan_penilaian_gerai_terpilih+=1;
	$kemunculan_penilaian_gerai_tidak_terpilih+=1;
	
	#MENAMBAHKAN SKOR DI UMUM
	$nilai_umum_gerai_terpilih+=1;
	$nilai_penilaian_gerai_terpilih+=1;
	$nilai_rataan_umum_gerai_terpilih=$nilai_umum_gerai_terpilih / $kemunculan_umum_gerai_terpilih;
	$nilai_rataan_umum_gerai_tidak_terpilih=$nilai_rataan_umum_gerai_tidak_terpilih / $kemunculan_umum_gerai_tidak_terpilih;
	
	#UPDATE KEMUNCULAN DI DATABASE
	$update_kemunculan_umum_gerai_terpilih=
		mysqli_query(
			$link,
				"UPDATE ".$db_tabel_nilai."
				SET muncul=".$kemunculan_umum_gerai_terpilih."
				WHERE nama_gerai='".$nama_gerai_terpilih."'");
	$update_kemunculan_umum_gerai_tidak_terpilih=
		mysqli_query(
			$link, 
				"UPDATE ".$db_tabel_nilai."
				SET muncul=".$kemunculan_umum_gerai_tidak_terpilih."
				WHERE nama_gerai='".$nama_gerai_tidak_terpilih."'");
	$update_kemunculan_penilaian_gerai_terpilih=
		mysqli_query(
			$link, 
				"UPDATE ".$db_tabel_penilaian."
				SET penilaian_muncul=".$kemunculan_penilaian_gerai_terpilih."
				WHERE nama_gerai='".$nama_gerai_terpilih."'
				AND penilaian='".$penilaian_dipakai."_muncul'");
	$update_kemunculan_penilaian_gerai_tidak_terpilih=
		mysqli_query(
			$link, 
				"UPDATE ".$db_tabel_penilaian."
				SET penilaian_muncul=".$kemunculan_penilaian_gerai_tidak_terpilih."
				WHERE nama_gerai='".$nama_gerai_tidak_terpilih."'
				AND penilaian='".$penilaian_dipakai."_muncul'");
	
	#UPDATE SKOR DI DATABASE
	$update_nilai_umum_gerai_terpilih=
		mysqli_query(
			$link,
				"UPDATE ".$db_tabel_nilai." 
				SET nilai=".$nilai_umum_gerai_terpilih."
				WHERE nama_gerai='".$nama_gerai_terpilih."'");
	$update_nilai_umum_gerai_tidak_terpilih=
		mysqli_query(
			$link, 
				"UPDATE ".$db_tabel_nilai." 
				SET nilai=".$nilai_umum_gerai_tidak_terpilih."
				WHERE nama_gerai='".$nama_gerai_tidak_terpilih."'");
	$update_nilai_penilaian_gerai_terpilih=
		mysqli_query(
			$link, 
				"UPDATE ".$db_tabel_penilaian."
				SET penilaian_skor=".$nilai_penilaian_gerai_terpilih."
				WHERE nama_gerai='".$nama_gerai_terpilih."'
				AND penilaian='".$penilaian_dipakai."_skor'");
	$update_rataan_umum_gerai_terpilih=
		mysqli_query(
			$link, 
				"UPDATE ".$db_tabel_nilai." 
				SET rataan_nilai=".$nilai_rataan_umum_gerai_terpilih."
				WHERE nama_gerai='".$nama_gerai_terpilih."'");
	$update_rataan_umum_gerai_tidak_terpilih=
		mysqli_query(
			$link, 
				"UPDATE ".$db_tabel_nilai." 
				SET rataan_nilai=".$nilai_rataan_umum_gerai_tidak_terpilih."
				WHERE nama_gerai='".$nama_gerai_tidak_terpilih."'");
	
	header("location:../tes_pake_php.php");
?>