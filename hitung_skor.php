<?php
	require "koneksi_ke_mysql.php";
	
	#NGAMBIL SEMUA VARIABEL
	$nama_gerai_terpilih=$_POST["terpilih"];
	$nama_gerai_terpilih=str_replace("'", "\'", $nama_gerai_terpilih);								#ANTI CROSS-SITE SCRIPTING
	$nama_gerai_terpilih=str_replace('"', '\"', $nama_gerai_terpilih);								#ANTI CROSS-SITE SCRIPTING
	$nama_kedua_gerai=$_POST["gerai"];																#NGAMBIL NAMA KEDUA GERAI YANG DIBANDINGKAN
	$nama_kedua_gerai=str_replace("'", "\'", $nama_kedua_gerai);									#ANTI CROSS-SITE SCRIPTING
	$nama_kedua_gerai=str_replace('"', '\"', $nama_kedua_gerai);									#ANTI CROSS-SITE SCRIPTING
	$exploded_nama_kedua_gerai=explode("/", $nama_kedua_gerai);										#MEMISAHKAN NAMA gerai_a DAN gerai_b
	$nama_gerai_a=$exploded_nama_kedua_gerai[0];
	$nama_gerai_b=$exploded_nama_kedua_gerai[1];
	$penilaian_dipakai=$_GET["penilaian"];
	
	#MENCARI GERAI YANG TIDAK TERPILIH
	if ($nama_gerai_a != $nama_gerai_terpilih)
	{
		$nama_gerai_tidak_terpilih=$nama_gerai_a;
	}
	else
	{
		$nama_gerai_tidak_terpilih=$nama_gerai_b;
	}
	
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
	$data_detail_gerai_terpilih=
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
	
	header("location:halaman_lengkap.php");
?>