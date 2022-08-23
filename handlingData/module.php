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
  $dataKriteria = mysqli_query($koneksi, "SELECT * FROM tabelkriteria");
  $arrBobotKriteria = [];
  
  if(!$bobotKriteria || !$namaKriteria) {
    header('location: dataKriteria.php?alertDataKosong=true');
  }
  else {
    while($arrDataKriteria = mysqli_fetch_array($dataKriteria)):
      array_push($arrBobotKriteria, $arrDataKriteria['bobotKriteria']);  
    endwhile;

    echo $namaKriteria; echo '<br>';
    echo $bobotKriteria; echo '<br>';
    print_r($arrBobotKriteria);

    $totalBobot = array_sum($arrBobotKriteria);
    if($totalBobot + $bobotKriteria > 100){
      header('location: dataKriteria.php?alertTotalKriteriaMax=true');
    } else {
      mysqli_query($koneksi, "INSERT INTO `tabelkriteria` (`namaKriteria`, `bobotKriteria`) VALUES ('$namaKriteria', '$bobotKriteria')");
      header('location: dataKriteria.php?alertBerhasilSimpan=true');
    }
  }
}

function updateKriteria($koneksi, $namaKriteria, $bobotKriteria, $idKriteria) {
  $dataKriteria = mysqli_query($koneksi, "SELECT * FROM tabelkriteria");
  $arrBobotKriteria = [];
  if($bobotKriteria > 100) { 
    header('location: dataKriteria.php?alertTotalKriteriaMax=true');
  } else {
    if(!$bobotKriteria || !$namaKriteria) {
      header('location: dataKriteria.php?alertDataKosong=true');
    }
    else {
      while($arrDataKriteria = mysqli_fetch_array($dataKriteria)):
        if($idKriteria != $arrDataKriteria['idKriteria']) {
          array_push($arrBobotKriteria, $arrDataKriteria['bobotKriteria']);  
        } else {
          array_push($arrBobotKriteria, $bobotKriteria);
        }
      endwhile;
      $totalBobot = array_sum($arrBobotKriteria);
      if($totalBobot > 100) {
        header('location: dataKriteria.php?alertTotalKriteriaMax=true');
      } else {
        mysqli_query($koneksi, "UPDATE `tabelkriteria` SET `bobotKriteria` = $bobotKriteria WHERE `idKriteria` = $idKriteria ");
        header('location: dataKriteria.php?alertBerhasilSimpan=true');
      }
    }
  }
}

function hapusKriteria ($koneksi, $idKriteria) {
  mysqli_query($koneksi, "DELETE FROM `tabelkriteria` WHERE `idKriteria` = '$idKriteria'");
  mysqli_query($koneksi, "DELETE FROM `tabelpenilaian` WHERE `idKriteria` = '$idKriteria'");
  header('location: dataKriteria.php?alertBerhasilHapus=true');
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

function simpanPenilaian($koneksi, $idPeserta, $idKriteria, $nilaiKriteria) {
  if($nilaiKriteria > 100) {
    header('location: penilaian.php?alertTotalKriteriaMax=true');
  } else {
    if($idPeserta == '' || $idKriteria == '' || !$nilaiKriteria) {
      header('location: penilaian.php?alertDataKosong=true');
    }
    else {
      $dataPenilaian = mysqli_query($koneksi, "SELECT * FROM tabelpenilaian WHERE idPeserta = '$idPeserta'");
      $arrDataPenilaian = mysqli_fetch_array($dataPenilaian);
      if(!$arrDataPenilaian) {
        mysqli_query($koneksi, "INSERT INTO `tabelpenilaian` (`idPeserta`, `idKriteria`, `nilaiKriteria`) VALUES ('$idPeserta', '$idKriteria', '$nilaiKriteria')");
        header('location: penilaian.php?alertBerhasilSimpan=true');
      }
      else {
        $cek = true;
        $dataPenilaian = mysqli_query($koneksi, "SELECT * FROM tabelpenilaian WHERE idPeserta = '$idPeserta'");
        while($arrDataPenilaian = mysqli_fetch_array($dataPenilaian)):
          if($arrDataPenilaian['idKriteria'] == $idKriteria) {
            header('location: penilaian.php?alertDataSudahAda=true');
            $cek = false;
            break;
          }
        endwhile;
  
        if($cek == true) {
          mysqli_query($koneksi, "INSERT INTO `tabelpenilaian` (`idPeserta`, `idKriteria`, `nilaiKriteria`) VALUES ('$idPeserta', '$idKriteria', '$nilaiKriteria')");
          header('location: penilaian.php?alertBerhasilSimpan=true');
        }
      }
    }
  }
}

function updatePenilaian($koneksi, $idPeserta, $idKriteria, $nilaiKriteria) {
  if($nilaiKriteria > 100) {
    header('location: penilaian.php?alertTotalKriteriaMax=true');
  } else {
    if($idKriteria == '' || !$nilaiKriteria) {
      header('location: penilaian.php?alertDataKosong=true');
    } else {
      $cek = true;
      $dataPenilaian = mysqli_query($koneksi, "SELECT * FROM tabelpenilaian WHERE idPeserta = '$idPeserta'");
      while($arrDataPenilaian = mysqli_fetch_array($dataPenilaian)):
        if($arrDataPenilaian['idKriteria'] == $idKriteria) {
          $dataPenilaianFilter = mysqli_query($koneksi, "SELECT * FROM `tabelpenilaian` WHERE `idPeserta` = '$idPeserta' AND `idKriteria` = '$idKriteria' ");
          $arrDataPenilaianFilter =  mysqli_fetch_array($dataPenilaianFilter);
          $idPenilaian = $arrDataPenilaianFilter['idPenilaian'];
          mysqli_query($koneksi, "UPDATE `tabelpenilaian` SET `nilaiKriteria` = '$nilaiKriteria'
          WHERE `idPenilaian` = '$idPenilaian'
          ");
          header('location: penilaian.php?alertBerhasilUpdate=true');
          $cek = false;
          break;
        }
      endwhile;
  
      if($cek == true) {
        header('location: penilaian.php?alertDataKriteraKosong=true');
      }
    }
  }
}

function hapusPenilaian($koneksi, $idPeserta) {
  mysqli_query($koneksi, "DELETE FROM `tabelpenilaian` WHERE `idPeserta` = '$idPeserta'");
  header('location: penilaian.php?alertBerhasilHapus=true');
}

function validasiHitung($koneksi) {
  $dataPeserta = mysqli_query($koneksi, "SELECT * FROM tabelpeserta");
  $lengthPeserta = 0;
  $cekLengthPeserta = 0;
  while($arrDataPeserta = mysqli_fetch_array($dataPeserta)):
    $dataKriteria = mysqli_query($koneksi, "SELECT * FROM tabelkriteria");
    while($arrDataKriteria = mysqli_fetch_array($dataKriteria)):
      $idPeserta = $arrDataPeserta['idPeserta'];
      $idKriteria = $arrDataKriteria['idKriteria'];
      $dataPenilaian = mysqli_query($koneksi, "SELECT * FROM `tabelpenilaian` WHERE `idPeserta` = '$idPeserta' AND `idKriteria` = '$idKriteria'");
      $arrDataPenilaian = mysqli_fetch_array($dataPenilaian);
      if(!$arrDataPenilaian['nilaiKriteria']) {
        $lengthPeserta = 0;
        break;
      }
    endwhile;
    $lengthPeserta++;
    $cekLengthPeserta++;
  endwhile;

  if($lengthPeserta != $cekLengthPeserta) {
    header('location: perangkingan.php?alertDataKosong=true');
  }
  else {
    header('location: LangkahPerangkingan.php');
  }
}
?>