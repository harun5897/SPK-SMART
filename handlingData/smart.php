<?php
function getUtility ($koneksi, $idPeserta) {
	$dataPeserta = mysqli_query($koneksi, "SELECT * FROM tabelpeserta WHERE idPeserta = '$idPeserta'");
	return mysqli_fetch_array($dataPeserta);
}
?>