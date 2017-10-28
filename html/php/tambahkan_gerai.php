<?php
	require "koneksi_ke_mysql.php";
	if (isset($_GET["status"]))
	{
		$status=$_GET["status"];
		if ($status === "tambah_gerai_berhasil")
		{
			echo "<script>Alert('Gerai berhasil ditambahkan!')</script>";
		}
	}
	echo
	"
		<title>Tambah gerai</title>
		TAMBAHKAN GERAI BARU<br>
		<form action='tambahkan_gerai_proses.php' method='POST'>
			Nama gerai 1: <input type='text' name='nama_gerai_a'><br>
			Nama gerai 2: <input type='text' name='nama_gerai_b'><br>
			Kategori gerai: <select name='kategori'>
				<option value='Umum'>Umum</option>
				<option value='Chinesee food'>Chinese food</option>
				<option value='Seafood'>Seafood</option>
				<option value='Sate'>Sate</option>
				<option value='Ayam goreng'>Ayam goreng</option>
				<option value='Lalapan'>Lalapan</option>
				<option value='Mie'>Mie</option>
				<option value='Es krim'>Es krim</option>
			</select><br>
			<input type='submit' value='Tambahkan gerai'>
		</form>
	"
?>