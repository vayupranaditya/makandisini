<?php
	require "koneksi_ke_mysql.php";
	$select_muncul_minimum=
		mysqli_query(
			$link, 
				"SELECT * FROM ".$db_tabel_nilai."
				ORDER BY muncul ASC
				LIMIT 1");
	$fetch_muncul_minimum=mysqli_fetch_array($select_muncul_minimum);
	$muncul_minimum=$fetch_muncul_minimum["muncul"];
	echo $muncul_minimum;
?>