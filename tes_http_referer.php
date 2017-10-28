<?php
	$kata="halo semua";
	$kata_isi="halo. semua";
	$exploded_kata=explode(".", $kata);
	$exploded_kata_isi=explode(".", $kata_isi);
	echo $exploded_kata[0];
	echo $exploded_kata_isi[0];
?>