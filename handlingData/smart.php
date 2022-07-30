<?php
function getUtility ($koneksi, $idPeserta, $komputer, $pendidikan, $pengalaman, $kendaraan) {
	$dataPeserta = mysqli_query($koneksi, "SELECT * FROM tabelpeserta WHERE idPeserta = '$idPeserta'");
	$utilityKomputer = (100 - (int)$komputer) / (100 - 80) * 100;
	$utilityPendidikan = (100 - (int)$pendidikan) / (100 - 60) * 100;
	$utilityPengalaman = (100 - (int)$pengalaman) / (100 - 60) * 100;
	$utilityKendaraan = (100 - (int)$kendaraan) / (100 - 60) * 100;

	$arrUtility = array(
		'utilityKomputer' => $utilityKomputer,
		'utilityPendidikan' => $utilityPendidikan,
		'utilityPengalaman' => $utilityPengalaman,
		'utilityKendaraan' => $utilityKendaraan,
	);

	return [$arrUtility, mysqli_fetch_array($dataPeserta)];
}
?>