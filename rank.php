<?php
	require "koneksi_ke_mysql.php";
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
		echo $rank.". ".$sepuluh_besar['nama_gerai'].": ".$sepuluh_besar['rataan_nilai']." - ".$sepuluh_besar['kategori']."<br>";
		$rank+=1;
	}
?>