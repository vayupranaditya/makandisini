<?php
	$array_warna=
		array(
			"375E97.FB6542.FFBB00.3F681C",
			"7CAA2D.34888C.F5E356.CB6318",
			"31A9B8.258039.CF3721.F5BE41",
			"F8A055.4897D8.FA6E59.FFDB5C",
			"F47D4A.E1315B.008DCB.EFEC5C",
			"FFB745.344D90.E7552C.5CC5EF");
	$array_warna_terpilih=array_rand($array_warna,1);
	$warna_terpilih=$array_warna[$array_warna_terpilih];
	$warna=explode(".", $warna_terpilih);
	for ($i=0; $i < 4; $i++)
	{
		$warna_[$i]=$warna[$i]."<br>";
	}
?>