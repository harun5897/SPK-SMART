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

function getNilaiAkhir ($koneksi, $idPeserta, $komputer, $pendidikan, $pengalaman, $kendaraan) {
	$koneksi = $koneksi;
	$idPeserta =$idPeserta;
	$komputer = $komputer;
	$pendidikan = $pendidikan;
	$pengalaman = $pengalaman;
	$kendaraan = $kendaraan;

	$arrNorm = [];
	$dataKriteria = mysqli_query($koneksi, "SELECT * FROM tabelkriteria");
	while($arrDataKriteria = mysqli_fetch_array($dataKriteria)):
		$temp = (int)$arrDataKriteria['bobotKriteria'] / 100;
		array_push($arrNorm, $temp);
	endwhile;
	$arrUtility = getUtility($koneksi, $idPeserta, $komputer, $pendidikan, $pengalaman, $kendaraan);
	$nilaiAkhirKomputer = $arrNorm[0] * (int)$arrUtility[0]['utilityKomputer'];
	$nilaiAkhirPendidikan = $arrNorm[1] * (int)$arrUtility[0]['utilityPendidikan'];
	$nilaiAkhirPengalaman = $arrNorm[2] * (int)$arrUtility[0]['utilityPengalaman'];
	$nilaiAkhirKendaraan = $arrNorm[3] * (int)$arrUtility[0]['utilityKendaraan'];

	$arrNilaiAkhir = array(
		'nilaiAkhirKomputer' => $nilaiAkhirKomputer,
		'nilaiAkhirPendidikan' => $nilaiAkhirPendidikan,
		'nilaiAkhirPengalaman' => $nilaiAkhirPengalaman,
		'nilaiAkhirKendaraan' => $nilaiAkhirKendaraan
	);
	
	$_SESSION['x'.$idPeserta] = [$arrUtility[1], array_sum($arrNilaiAkhir)];
	return [$arrNilaiAkhir, $arrUtility[1], array_sum($arrNilaiAkhir)];
}

function pesertaTerbaik ($koneksi) {
	$dataPeserta = mysqli_query($koneksi, "SELECT * FROM tabelpeserta");

	$idPeserta = [];
	while($arrDataPeserta = mysqli_fetch_array($dataPeserta)):
		array_push($idPeserta, $arrDataPeserta['idPeserta']);
	endwhile;

	$nilaiAkhir = [];
	for($a = 0; $a < count($idPeserta); $a++) {
		array_push($nilaiAkhir, $_SESSION['x'.$idPeserta[$a]][1]);
	}
	
	for ($i = 0; $i < count($nilaiAkhir); $i++) {
    for ($j = $i + 1; $j < count($nilaiAkhir); $j++) {
        if ($nilaiAkhir[$i] > $nilaiAkhir[$j]) {
            $temp = $nilaiAkhir[$i];
						$tempId = $idPeserta[$i];
            $nilaiAkhir[$i] = $nilaiAkhir[$j];
						$idPeserta[$i] = $idPeserta[$j]; 
            $nilaiAkhir[$j] = $temp;
						$idPeserta[$j] = $tempId;
        }
    }
}
	$_SESSION['hasilRanking'] = [array_reverse($idPeserta), array_reverse($nilaiAkhir)];

	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";

	// print_r($_SESSION['hasilRanking'][0]);
	// echo "<br>";
	// print_r($_SESSION['hasilRanking'][1][0]);

	header('location: hasilPerangkingan.php');
}
?>