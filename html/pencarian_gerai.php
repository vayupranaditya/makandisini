<?php
	require "php/koneksi_ke_mysql.php";
	
	$gerai_dicari="a";
	//$gerai_dicari=$_GET["cari"];																	#INPUT CARI
	$gerai_dicari=str_replace("'", "\'", $gerai_dicari);											#ANTI CROSS SITE SCRIPTING
	
	
	#CARI DI DATABASE
	$mencari_kedai=
		mysqli_query(
			$link, 
				"SELECT * FROM ".$db_tabel_nilai." 
				WHERE nama_gerai LIKE '%".$gerai_dicari."%'
				ORDER BY rataan_nilai DESC");
	$jumlah_ditemukan=mysqli_affected_rows($link);
	if ($jumlah_ditemukan==0)
	{
		echo "Tidak ditemukan hasil dengan kata kunci \"".$gerai_dicari."\"";
	}
	else
	{
		echo "Ditemukan ".$jumlah_ditemukan." hasil dengan kata kunci \"".$gerai_dicari."\"";
	}
	echo "<p>";
	while ($fetched_hasil_pencarian=mysqli_fetch_array($mencari_kedai, MYSQLI_ASSOC))
	{
		echo 
			$fetched_hasil_pencarian["nama_gerai"]
			." "
			.number_format($fetched_hasil_pencarian["rataan_nilai"]*100, 0)
			."% terpilih<p>";
	}
?>