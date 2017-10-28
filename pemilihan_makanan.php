<?php
	require "koneksi_ke_mysql.php";
	$penilaian=array("rasa", "harga","waktu","ongkir","kenyamanan");
	$gerai_a=
		mysqli_query(
			$link, 
				"SELECT * FROM ".$db_tabel_nilai." 
				ORDER BY muncul ASC
				LIMIT 1");																#PILIH GERAI A
	$gerai_a=mysqli_fetch_array($gerai_a, MYSQLI_ASSOC);
	$gerai_a_nama=$gerai_a["nama_gerai"];
	$gerai_a_muncul=$gerai_a["muncul"];
	$gerai_muncul_minimum=$gerai_a_muncul;
	$gerai_b=
		mysqli_query(
			$link, 
				"SELECT * FROM ".$db_tabel_nilai." 
				WHERE nama_gerai != '".$gerai_a['nama_gerai']."' 
				AND kategori='".$gerai_a['kategori']."' 
				AND muncul=".$gerai_muncul_minimum."
				ORDER BY RAND() LIMIT 1");												#PILIH GERAI B
	$jumlah_hasil_query_gerai_b=mysqli_affected_rows($link);
	$gerai_b=mysqli_fetch_array($gerai_b, MYSQLI_ASSOC);
	while ($jumlah_hasil_query_gerai_b == 0)
	{
		$gerai_b=
			mysqli_query(
			$link,
				"SELECT * FROM ".$db_tabel_nilai." 
				WHERE muncul !='".$gerai_muncul_minimum."'
				AND nama_gerai !='".$gerai_a_nama."'
				AND kategori ='".$gerai_a['kategori']."'
				ORDER BY muncul ASC
				LIMIT 1");																#NYARI GERAI YANG muncul-NYA MINIMUM KEDUA
		$jumlah_hasil_query_gerai_b=mysqli_affected_rows($link);
		$gerai_b=mysqli_fetch_array($gerai_b);
		$gerai_muncul_minimum=$gerai_b["muncul"];
		
	}
	$gerai_b_nama=$gerai_b["nama_gerai"];
	$gerai_b_muncul=$gerai_b["muncul"];
	$gerai_a_penilaian_muncul=
		mysqli_query(
			$link, 
				"SELECT * FROM ".$db_tabel_penilaian." 
				WHERE nama_gerai ='".$gerai_a_nama."' 
				AND penilaian LIKE '%_muncul'");
	$gerai_a_penilaian_muncul=mysqli_fetch_array($gerai_a_penilaian_muncul);
	$gerai_b_penilaian_muncul=
		mysqli_query(
			$link, 
				"SELECT * FROM ".$db_tabel_penilaian." 
				WHERE nama_gerai ='".$gerai_a_nama."' 
				AND penilaian LIKE '%_muncul'");
	$gerai_b_penilaian_muncul=mysqli_fetch_array($gerai_b_penilaian_muncul);
	$gerai_a_penilaian_muncul_minimum=min($gerai_a_penilaian_muncul);
	$gerai_b_penilaian_muncul_minimum=min($gerai_b_penilaian_muncul);
	
	#ALGORITMA PEMILIHAN PENILAIAN
	if ($gerai_a_penilaian_muncul_minimum < $gerai_b_penilaian_muncul_minimum)			#KALAU SEMUA PENILAIAN DI GERAI A LEBIH JARANG MUNCUL DARIPADA DI GERAI B, MAKA
	{
		$penilaian_terpilih=
			mysqli_query(
				$link, 
					"SELECT * FROM ".$db_tabel_penilaian." 
					WHERE nama_gerai ='".$gerai_a_nama."' 
					ORDER BY penilaian_muncul ASC 
					LIMIT 1");															#PENILAIAN TERPILIH ADALAH PENILAIAN YANG PALING JARANG MUNCUL DI GERAI A
		$exploded_penilaian_terpilih=explode("_", $penilaian_terpilih);
		$penilaian_terpilih=$exploded_penilaian_terpilih[0];
	}
	elseif ($gerai_a_penilaian_muncul_minimum > $gerai_b_penilaian_muncul_minimum)		#KALAU SEMUA PENILAIAN DI GERAI A LEBIH SERING MUNCUL DARIPADA DI GERAI B, MAKA
	{
		$penilaian_terpilih=
			mysqli_query(
				$link, 
					"SELECT * FROM ".$db_tabel_penilaian." 
					WHERE nama_gerai ='".$gerai_b_nama."' 
					ORDER BY penilaian_muncul ASC 
					LIMIT 1");
		$exploded_penilaian_terpilih=explode("_", $penilaian_terpilih);
		$penilaian_terpilih=$exploded_penilaian_terpilih[0];							#PENILAIAN TERPILIH ADALAH YANG PALING JARANG MUNCUL DI GERAI B
	}
	else																				#KALAU SEMUA PENILAIAN DI GERAI A DAN DI GERAI B SAMA-SAMA SERING MUNCUL, MAKA
	{
		if ($gerai_a["muncul"] < $gerai_b["muncul"])									#KALAU SECARA UMUM, GERAI A LEBIH JARANG MUNCUL, MAKA
		{
			$penilaian_terpilih
				=mysqli_query(
					$link, 
						"SELECT * FROM ".$db_tabel_penilaian." 
						WHERE nama_gerai ='".$gerai_a_nama."' 
						ORDER BY penilaian_muncul ASC 
						LIMIT 1");
			$penilaian_terpilih=mysqli_fetch_array($penilaian_terpilih, MYSQLI_ASSOC);
			$penilaian_terpilih=$penilaian_terpilih["penilaian"];
			$exploded_penilaian_terpilih=explode("_", $penilaian_terpilih);
			$penilaian_terpilih=$exploded_penilaian_terpilih[0];						#PENILAIAN TERPILIH ADALAH PENILAIAN YANG PALING JARANG MUNCUL DI GERAI A			
		}
		elseif ($gerai_a["muncul"] > $gerai_b["muncul"])								#KALAU SECARA UMUM, GERAI A LEBIH SERING MUNCUL, MAKA
		{
			$penilaian_terpilih=
				mysqli_query(
					$link, 
						"SELECT * FROM ".$db_tabel_penilaian." 
						WHERE nama_gerai ='".$gerai_b_nama."' 
						ORDER BY penilaian_muncul ASC 
						LIMIT 1");
			$penilaian_terpilih=mysqli_fetch_array($penilaian_terpilih, MYSQLI_ASSOC);
			$penilaian_terpilih=$penilaian_terpilih["penilaian"];
			$exploded_penilaian_terpilih=explode("_", $penilaian_terpilih);
			$penilaian_terpilih=$exploded_penilaian_terpilih[0];						#PENILAIAN TERPILIH ADALAH PENILAIAN YANG PALING JARANG MUNCUL DI GERAI B
		}
		else																			#KALAU SECARA UMUM, SAMA-SAMA SERING MUNCUL, MAKA
		{
			$penilaian_terpilih=array_rand($penilaian, 1);
			$penilaian_terpilih=$penilaian[$penilaian_terpilih];						#PENILAIAN YANG TERPILIH MERUPAKAN PENGAMBILAN ACAK
		}
	}
	#ALGORITMA PEMILIHAN PILIHAN SELESAI
	
	
	#MENCARI DATA DARI MASING-MASING PENILAIAN
	$gerai_a_penilaian_terpilih_mysql=
		mysqli_query(
			$link, 
				"SELECT * 
				FROM ".$db_tabel_penilaian." 
				WHERE nama_gerai ='".$gerai_a_nama."' 
				AND penilaian='".$penilaian_terpilih."_muncul'");
	$gerai_b_penilaian_terpilih_mysql=
		mysqli_query(
			$link, 
				"SELECT * 
				FROM ".$db_tabel_penilaian." 
				WHERE nama_gerai ='".$gerai_b_nama."'
				AND penilaian='".$penilaian_terpilih."_muncul'");
	
	$gerai_a_penilaian=mysqli_fetch_array($gerai_a_penilaian_terpilih_mysql);
	$gerai_b_penilaian=mysqli_fetch_array($gerai_b_penilaian_terpilih_mysql);
	
	$gerai_a_penilaian_muncul=$gerai_a_penilaian["penilaian_muncul"];
	$gerai_b_penilaian_muncul=$gerai_b_penilaian["penilaian_muncul"];
	
	
	#SET JUMLAH MUNCUL BARU
	$gerai_a_muncul+=1;
	$gerai_b_muncul+=1;
	
	
	#SET JUMLAH MUNCUL PENILAIAN BARU
	$gerai_a_penilaian_muncul+=1;
	$gerai_b_penilaian_muncul+=1;
	
	
	#TAMPILAN HTML
	echo
		"
			<title>Telkom Food Rank</title>
			<form action='hitung_skor.php?penilaian=".$penilaian_terpilih."' method='POST'>
				Mana yang lebih baik dalam hal ".$penilaian_terpilih."?<br>
				<input type='hidden' name='gerai' value ='".$gerai_a_nama."/".$gerai_b_nama."'>
				<input type='submit' name='terpilih' value='".$gerai_a_nama."'/>
				atau
				<input type='submit' name='terpilih' value='".$gerai_b_nama."'/>
			</form>
		"
?>
