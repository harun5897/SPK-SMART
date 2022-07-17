<?php
function login($koneksi, $email, $kataSandi) {
  $dataUser = mysqli_query($koneksi, " SELECT * FROM `tabeluser` WHERE `email` = '$email' AND `kataSandi` = '$kataSandi'");
  $arrDataUser = mysqli_fetch_array($dataUser);
  if ($arrDataUser['email'] == $email && $arrDataUser['kataSandi'] == $kataSandi) {
    echo 'berhasil';
  }
  else {
    echo 'gagal';
  }

}
function simpanKriteria($koneksi, $namaKriteria, $bobotKriteria) {
  if(!$bobotKriteria || $namaKriteria == 0) {
    header('location: dataKriteria.php?alertDataKosong=true');
  }
  else {
    mysqli_query($koneksi, "UPDATE `tabelkriteria` SET 
      `bobotKriteria` = $bobotKriteria
      WHERE `idKriteria` = $namaKriteria
    ");
    header('location: dataKriteria.php?alertBerhasilSimpan=true');
  }
}

function simpanPeserta($koneksi, $namaDepan, $namaBelakang, $nik, $tanggalLahir, $jenisKelamin, $agama,    $alamat, $email, $kontak) {
  if(!$namaDepan || !$namaBelakang || !$nik || !$tanggalLahir || !$jenisKelamin || !$agama || !$alamat || !$email || !$kontak) {
    header('location: tambahDataPeserta.php?alertDataKosong=true');
  }
  else {
    mysqli_query($koneksi, "INSERT INTO `tabelpeserta` (`namaDepan`, `namaBelakang`, `nik`, `tanggalLahir`, `jenisKelamin`, `agama`, `alamat`, `email`, `kontak`) VALUES ('$namaDepan', '$namaBelakang', '$nik', '$tanggalLahir', '$jenisKelamin', '$agama', '$alamat', '$email', '$kontak')");
    header('location: DataPeserta.php?alertBerhasilSimpan=true');
  }
}

function updatePeserta($koneksi, $namaDepan, $namaBelakang, $nik, $tanggalLahir, $jenisKelamin, $agama, $alamat, $email, $kontak, $idPeserta) {
  if(!$namaDepan || !$namaBelakang || !$nik || !$tanggalLahir || !$jenisKelamin || !$agama || !$alamat || !$email || !$kontak) {
    header('location: updateDataPeserta.php?alertDataKosong=true&idPeserta='.$idPeserta);
  }
  else {
    mysqli_query($koneksi, "UPDATE `tabelpeserta` SET `namaDepan` = '$namaDepan', `namaBelakang` = '$namaBelakang', `nik` = '$nik', `tanggalLahir` = '$tanggalLahir', `jenisKelamin` = '$jenisKelamin', `agama` = '$agama', `alamat` = '$alamat', `email` = '$email', `kontak` = '$kontak'

      WHERE `idPeserta` = '$idPeserta'
    ");
    header('location: DataPeserta.php?alertBerhasilSimpan=true');
  }
}

function hapusPeserta($koneksi, $idPeserta) {
  mysqli_query($koneksi, "DELETE FROM `tabelpeserta` WHERE `idPeserta` = '$idPeserta'");
  mysqli_query($koneksi, "DELETE FROM `tabelpenilaian` WHERE `idPeserta` = '$idPeserta'");
  header('location: dataPeserta.php?alertBerhasilHapus=true');
}

function simpanPenilaian($koneksi, $idPeserta, $kriteriaKomputer, $kriteriaPendidikan, $kriteriaPengalaman, $kriteriaKendaraan) {
  $dataPenilaian = mysqli_query($koneksi, "SELECT * FROM tabelpenilaian WHERE idPeserta = '$idPeserta'");
  $arrDataPenilaian = mysqli_fetch_array($dataPenilaian);

  if($idPeserta == '' || !$kriteriaKomputer || !$kriteriaPendidikan || !$kriteriaPengalaman || !$kriteriaKendaraan) {
    header('location: penilaian.php?alertDataKosong=true');
  }
  else {
    if($arrDataPenilaian['idPeserta'] == $idPeserta) {
      mysqli_query($koneksi, "UPDATE `tabelpenilaian` SET `idPeserta` = '$idPeserta', `kriteriaKomputer` = '$kriteriaKomputer', `kriteriaPendidikan` = '$kriteriaPendidikan', `kriteriaPengalaman` = '$kriteriaPengalaman', `kriteraKendaraan` = '$kriteriaKendaraan'
      WHERE `idPeserta` = '$idPeserta'");
      header('location: penilaian.php?alertBerhasilUpdate=true');
    }
    else {
      mysqli_query($koneksi, "INSERT INTO `tabelpenilaian` (`idPeserta`, `kriteriaKomputer`, `kriteriaPendidikan`, `kriteriaPengalaman`, `kriteraKendaraan`) VALUES ('$idPeserta', '$kriteriaKomputer', '$kriteriaPendidikan', '$kriteriaPengalaman', '$kriteriaKendaraan')");
      header('location: penilaian.php?alertBerhasilSimpan=true');
    }
  }
}

function hapusPenilaian($koneksi, $idPenilaian) {
  mysqli_query($koneksi, "DELETE FROM `tabelpenilaian` WHERE `idPenilaian` = '$idPenilaian'");
  header('location: penilaian.php?alertBerhasilHapus=true');
}
?>