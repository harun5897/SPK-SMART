<?php
function getUtility ($koneksi, $idPeserta) {
  $arrUtility = [];
  $dataKriteria = mysqli_query($koneksi, "SELECT * FROM tabelkriteria");
  while($arrDataKriteria = mysqli_fetch_array($dataKriteria)):
    $idKriteria = $arrDataKriteria['idKriteria'];
    $dataPenilaian = mysqli_query($koneksi, "SELECT * FROM `tabelpenilaian` WHERE `idPeserta` = '$idPeserta' AND `idKriteria` = '$idKriteria' ");
    $arrDataPenilaian = mysqli_fetch_array($dataPenilaian);
    $tempNilaiKriteria = $arrDataPenilaian['nilaiKriteria'];
    // $tempUtility = (100 - (int)$tempNilaiKriteria) / (100 - 0) * 100;
    $tempUtility = ((int)$tempNilaiKriteria - 0) / (100 - 0) * 100;
    array_push($arrUtility, $tempUtility);
  endwhile;

	return $arrUtility;
}

function getNilaiAkhir ($koneksi, $idPeserta) {
  $arrNorm = [];
  $dataKriteria = mysqli_query($koneksi, "SELECT * FROM tabelkriteria");
  while($arrDataKriteria = mysqli_fetch_array($dataKriteria)):
    $temp = (int)$arrDataKriteria['bobotKriteria'] / 100;
    array_push($arrNorm, $temp);
  endwhile;

  $arrUtility = getUtility($koneksi, $idPeserta);
  $arrNilaiAkhir = [];
  $i=0;
  foreach($arrUtility as $value):
    $tempNilaiAkhir = $arrNorm[$i] * (int)$value;
    array_push($arrNilaiAkhir, $tempNilaiAkhir);
    $i++;
  endforeach;
  $_SESSION['nilaiAkhir'] = array_sum($arrNilaiAkhir);

  return $arrNilaiAkhir;
}

function pesertaTerbaik ($koneksi) {

  $nilaiAkhir = [];
  $listIdPeserta = []; 
	$dataPeserta = mysqli_query($koneksi, "SELECT * FROM tabelpeserta");
	while($arrDataPeserta = mysqli_fetch_array($dataPeserta)):
    $idPeserta = $arrDataPeserta['idPeserta'];
		getNilaiAkhir($koneksi, $idPeserta);
    array_push($listIdPeserta, $idPeserta);
    array_push($nilaiAkhir, $_SESSION['nilaiAkhir']);
	endwhile;
	
	for ($i = 0; $i < count($nilaiAkhir); $i++) {
    for ($j = $i + 1; $j < count($nilaiAkhir); $j++) {
        if ($nilaiAkhir[$i] > $nilaiAkhir[$j]) {
            $temp = $nilaiAkhir[$i];
						$tempId = $listIdPeserta[$i];
            $nilaiAkhir[$i] = $nilaiAkhir[$j];
						$listIdPeserta[$i] = $listIdPeserta[$j]; 
            $nilaiAkhir[$j] = $temp;
						$listIdPeserta[$j] = $tempId;
        }
    }
  }

  $_SESSION['RankingIdPeserta'] = array_reverse($listIdPeserta);
  $_SESSION['RankingNilaiAKhir'] = array_reverse($nilaiAkhir);

	header('location: hasilPerangkingan.php');
}
?>