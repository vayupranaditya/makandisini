<?php 
	require "koneksi_ke_mysql.php";
	/*$select=mysqli_query($link, "SELECT * FROM $db_tabel_nilai");
	$penilaian=array("rasa","harga","waktu","ongkir","kenyamanan");
	$poin=array("muncul","skor");
	while($gerai=mysqli_fetch_array($select, MYSQLI_ASSOC))
	{
		for($penilaian_ke=0; $penilaian_ke<count($penilaian); $penilaian_ke++)
		{
			for ($poin_ke=0; $poin_ke<count($poin); $poin_ke++)
			{
				echo "INSERT INTO ".$db_tabel_penilaian." (id_gerai, nama_gerai, penilaian) VALUES (".$gerai['id_gerai'].",'".$gerai['nama_gerai']."','".$penilaian[$penilaian_ke]."_".$poin[$poin_ke]."');";
			}
		}
	}*/
	echo "<title>AI Parent</title>";
	echo "<h1>SCRIPT UNTUK BUAT SCRIPT</h1>";
	$gerai_a=mysqli_query($link, "SELECT * FROM ".$db_tabel_nilai." ORDER BY muncul ASC LIMIT 1");
	$gerai_a=mysqli_fetch_array($gerai_a, MYSQLI_ASSOC);
	echo "SELECT * FROM ".$db_tabel_nilai." WHERE nama_gerai NOT '".$gerai_a['nama_gerai']."' ORDER BY muncul ASC LIMIT 1";
?>