<?php
function login($koneksi, $email, $kataSandi) {
  if(!$email || !$kataSandi) {
    header('location: index.php?alertGagalLogin=true');
  }
  else {
    $dataUser = mysqli_query($koneksi, " SELECT * FROM `tabeluser` WHERE `email` = '$email' AND `kataSandi` = '$kataSandi'");
    $arrDataUser = mysqli_fetch_array($dataUser);
    if ($arrDataUser['email'] == $email && $arrDataUser['kataSandi'] == $kataSandi) {
      $_SESSION['idUser'] = $arrDataUser['idUser'];
      $_SESSION['namaUser'] = $arrDataUser['namaUser'];
      $_SESSION['role'] = $arrDataUser['role'];
      $_SESSION['loginStatus'] = true;
      header('location: dataPeserta.php?alertBerhasilLogin=true');
    }
    else {
      header('location: index.php?alertGagalLogin=true');
    }
  }
}

function gantiKataSandi ($koneksi, $kataSandiLama, $kataSandiBaru, $idUser) {
  if(!$kataSandiLama || !$kataSandiBaru) {
    header('location: index.php?alertGagalGantiKataSandi=true');
  }
  else {
    if($kataSandiLama == $kataSandiBaru) {
      session_start();
      session_destroy();
      header('location: index.php?alertGagalGantiKataSandi=true');
    }
    else {
      mysqli_query($koneksi, "UPDATE `tabeluser` SET `kataSandi` = '$kataSandiBaru' WHERE `idUser` = '$idUser'");
      session_start();
      session_destroy();
      header('location: index.php?alertBerhasilGantiKataSandi=true');
    }
  }
}

function simpanUser($koneksi, $namaUser, $email, $role) {
  $kataSandiDefault = '12345';
  if(!$namaUser || !$email || $role == '0') {
    header('location: daftarUser.php?alertDataKosong=true');
  }
  else {
    mysqli_query($koneksi, "INSERT INTO tabeluser (`namaUser`, `email`, `kataSandi`, `role`) VALUES ('$namaUser', '$email', '$kataSandiDefault', '$role')");
    header('location: daftarUser.php?alertBerhasilHapus=true');
  }
}

function hapusUser($koneksi, $idUser){
  mysqli_query($koneksi, "DELETE FROM `tabeluser` WHERE `idUser` = '$idUser'");
  header('location: daftarUser.php?alertBerhasilSimpan=true');
}

function updateUser($koneksi, $idUser, $namaUser, $email, $role) {
  if(!$namaUser || !$email || $role == '0') {
    header('location: daftarUser.php?alertDataKosong=true');
  }
  else {
    mysqli_query($koneksi, "UPDATE `tabeluser` SET `namaUser` = '$namaUser', `email` = '$email', `role` = '$role'
      WHERE `idUser` = '$idUser'
    ");
    header('location: daftarUser.php?alertDataBerhasilUpdate=true');
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

  $totalNilaiKriteria = (int)$kriteriaKomputer + (int)$kriteriaPendidikan + (int)$kriteriaPengalaman + (int)$kriteriaKendaraan;
  if($totalNilaiKriteria > 100){
    header('location: penilaian.php?alertTotalKriteriaMax=true');
  }
  else {
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
  
}

function hapusPenilaian($koneksi, $idPenilaian) {
  mysqli_query($koneksi, "DELETE FROM `tabelpenilaian` WHERE `idPenilaian` = '$idPenilaian'");
  header('location: penilaian.php?alertBerhasilHapus=true');
}
?>