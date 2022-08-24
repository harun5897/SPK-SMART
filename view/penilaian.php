<?php
session_start();
include_once('../handlingData/module.php');
include_once('../handlingData/koneksi.php');

if($_SESSION['loginStatus'] != 1) {
  header('location: index.php?alertBelumLogin=true');
}

if(isset($_GET['alertDataKosong'])) {
  ?>
    <script>var alertDataKosong = true;</script>
  <?php
}
if(isset($_GET['alertBerhasilSimpan'])) {
  ?>
    <script>var alertBerhasilSimpan = true;</script>
  <?php
}
if(isset($_GET['alertBerhasilUpdate'])) {
  ?>
    <script>var alertBerhasilUpdate = true;</script>
  <?php
}
if(isset($_GET['alertBerhasilHapus'])) {
  ?>
    <script>var alertBerhasilHapus = true;</script>
  <?php
}
if(isset($_GET['alertDataSudahAda'])) {
  ?>
    <script>var alertDataSudahAda = true;</script>
  <?php
}
if(isset($_GET['alertDataKriteraKosong'])) {
  ?>
    <script>var alertDataKriteraKosong = true;</script>
  <?php
}
if(isset($_GET['alertTotalKriteriaMax'])) {
  ?>
    <script>var alertTotalKriteriaMax = true;</script>
  <?php
}

if(isset($_POST['simpanPenilaian'])) {
  simpanPenilaian($koneksi, $_POST['idPeserta'], $_POST['idKriteria'], $_POST['nilaiKriteria']);
}

if(isset($_GET['dataPenilaian'])) {
  if($_GET['dataPenilaian'] == 'hapus') {
    $idPeserta = $_GET['idPeserta'];
    hapusPenilaian($koneksi, $idPeserta);
  }
}
if(isset($_POST['updatePenilaian'])) {
  $idPeserta = $_GET['idPeserta'];
  updatePenilaian($koneksi, $idPeserta, $_POST['idKriteria'], $_POST['nilaiKriteria']);
}

if(isset($_GET['dataPenilaian'])){
  if($_GET['dataPenilaian'] == 'update') {
    $idPeserta = $_GET['idPeserta'];
    $dataPenilaianEdit = mysqli_query($koneksi, "SELECT * FROM `tabelpeserta` WHERE `idPeserta` = '$idPeserta'");
    $arrDataPenilaianEdit = mysqli_fetch_array($dataPenilaianEdit);
    ?>
      <script>var updateDataPenilaian = true;</script>
    <?php
  }
}

if(isset($_POST['gantiKataSandi'])){
  gantiKataSandi($koneksi, $_POST['kataSandiLama'], $_POST['kataSandiBaru'], $_SESSION['idUser']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="../assets/scss/style.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar p-2">
    <div class="container-md d-flex justify-content-between p-0">
      <div class="navbar-brand">
        Sistem Penerimaan Karyawan
        <p class="title-navbar m-0">Kantor Notaris Kota Tanjung Pinang</p>
      </div>
      <div class="d-flex justify-content-between">
        <img 
          src="../assets/icon/avatar.svg" 
          class="rounded-circle p-1"
        >
        <div class="dropdown p-1">
          <a class="dropdown-toggle" 
            data-bs-toggle="dropdown" 
            data-bs-display="static" 
            aria-expanded="false"
          >
            <?php echo $_SESSION['namaUser']; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="logout.php">Keluar</a>
            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalGantiKataSandi">Ganti Kata Sandi</a>
            <?php if($_SESSION['role'] == 'superAdmin') { ?>
            <a class="dropdown-item" href="daftarUser.php">Daftar User</a>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- NAVBAR MODAL GANTI KATA SANDI -->
  <div 
    class="modal fade" 
    id="modalGantiKataSandi" 
    tabindex="-1" 
    aria-labelledby="exampleModalLabel" 
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ganti Kata Sandi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
            <label for="">Kata Sandi Lama</label>
            <input type="password" class="form-control" name="kataSandiLama">
            <label for="" class="mt-2">Kata Sandi Baru</label>
            <input type="password" class="form-control" name="kataSandiBaru">
            <div class="my-3 d-flex justify-content-end">
              <button type="submit" class="btn btn-primary" name="gantiKataSandi">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="content container-md card">
    <div class="card-header">
      Data Penilaian
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-3 pe-4">
          <a href="dataPeserta.php" style="text-decoration: none;">
            <div class="card">
              <div class="card-body">
                Data Alternatif
              </div>
            </div>
          </a>
          <a href="dataKriteria.php" style="text-decoration: none;">
            <div class="card mt-2">
              <div class="card-body">
                Data Kriteria
              </div>
            </div>
          </a>
          <a href="penilaian.php" style="text-decoration: none;">
            <div class="card mt-2">
              <div class="card-body">
                Penilaian
              </div>
            </div>
          </a>
          <a href="perangkingan.php" style="text-decoration: none;">
            <div class="card mt-2">
              <div class="card-body">
                Perangkingan
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-9 px-3">
          <div class="d-flex justify-content-between">
            <div class="button">
              <a 
                href="" 
                class="btn btn-md btn-success" 
                data-bs-toggle="modal" 
                data-bs-target="#exampleModal"
              > Penilaian </a>
            </div>
            <div class="form">
              <input id="search" type="text" class="form-control" placeholder="Cari">
            </div>
          </div>
          <hr>
          <table id="myTable" class="table table-hover">
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama</th>
              <?php
                $dataTabelKriteria = mysqli_query($koneksi, "SELECT * FROM tabelkriteria");
                while($arrDataTabelKriteria = mysqli_fetch_array($dataTabelKriteria)) :
              ?>
              <th class="text-center"><?=$arrDataTabelKriteria['namaKriteria']?></th>
              <?php
                endwhile;
              ?>
              <th class="text-center">Action</th>
            </tr>

            <?php
              $no = 0;
              $dataPeserta = mysqli_query($koneksi, "SELECT * FROM tabelpeserta");
              while($arrDataPeserta = mysqli_fetch_array($dataPeserta)) :
                $idPeserta = $arrDataPeserta['idPeserta'];
                $no++;
            ?>
            <tr>
              <td class="text-center"><?php echo $no; ?></td>
              <td class="text-center"><?=$arrDataPeserta['namaDepan']?></td>
              <?php
                $dataKriteria = mysqli_query($koneksi, "SELECT * FROM `tabelkriteria`");
                while($arrDataKriteria = mysqli_fetch_array($dataKriteria)) :
                  $idKriteria = $arrDataKriteria['idKriteria'];
                  $dataPenilaian = mysqli_query($koneksi, "SELECT * FROM `tabelpenilaian` WHERE `idPeserta` = '$idPeserta' AND `idKriteria` = '$idKriteria'");
                  $arrDataPenilaian = mysqli_fetch_array($dataPenilaian)
              ?>
                <td class="text-center">
                  <?php
                    if(isset($arrDataPenilaian['nilaiKriteria'])){
                      echo $arrDataPenilaian['nilaiKriteria'];
                    }
                  ?>
                </td>
              <?php
                endwhile;
              ?>
              <td class="text-center">
                <a href="penilaian.php?dataPenilaian=update&idPeserta=<?=$arrDataPeserta['idPeserta']?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="penilaian.php?dataPenilaian=hapus&idPeserta=<?=$arrDataPeserta['idPeserta']?>" class="btn btn-sm btn-danger">hapus</a>
              </td>
            </tr>
            <?php
              endwhile;
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Data Kriteria-->
  <div class="modal fade" 
    tabindex="-1"
    id="exampleModal"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Penilaian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
          <select 
              class="form-select mt-3 form-control" 
              aria-label="Default select example"
              name="idPeserta"
            >
              <option value="" selected> Pilih Nama Peserta</option>
              <?php 
                $dataPeserta = mysqli_query($koneksi, "SELECT * FROM tabelpeserta");
                while($arrDataPeserta = mysqli_fetch_array($dataPeserta)) :
              ?>
              <option value="<?=$arrDataPeserta['idPeserta']?>"><?=$arrDataPeserta['namaDepan']?></option>
              <?php
                endwhile;
              ?>
            </select>
            <select 
              class="form-select mt-3 form-control" 
              aria-label="Default select example"
              name="idKriteria"
            >
              <option value="" selected> Pilih Kriteria</option>
              <?php 
                $dataKriteria = mysqli_query($koneksi, "SELECT * FROM tabelkriteria");
                while($arrDataKriteria = mysqli_fetch_array($dataKriteria)) :
              ?>
              <option value="<?=$arrDataKriteria['idKriteria']?>"><?=$arrDataKriteria['namaKriteria']?></option>
              <?php
                endwhile;
              ?>
            </select>
            <input 
              type="text" 
              class="form-control mt-3" 
              placeholder="Masukan Nilai Kriteria"
              name="nilaiKriteria"
            >
          </div>
          <div class="modal-footer mt-3">
            <button 
              type="submit" 
              class="btn btn-primary"
              name="simpanPenilaian"
            >
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit Data Kriteria-->
  <div class="modal fade" 
    tabindex="-1"
    id="exampleModal1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Penilaian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
            <label for="">
              <?=$arrDataPenilaianEdit['namaDepan']?> <?=$arrDataPenilaianEdit['namaBelakang']?>
            </label>
            <select 
              class="form-select mt-3 form-control" 
              aria-label="Default select example"
              name="idKriteria"
            >
              <option value="" selected> Pilih Kriteria</option>
              <?php 
                $dataKriteria = mysqli_query($koneksi, "SELECT * FROM tabelkriteria");
                while($arrDataKriteria = mysqli_fetch_array($dataKriteria)) :
              ?>
              <option value="<?=$arrDataKriteria['idKriteria']?>"><?=$arrDataKriteria['namaKriteria']?></option>
              <?php
                endwhile;
              ?>
            </select>
            <input 
              type="text" 
              class="form-control mt-3" 
              placeholder="Masukan Nilai Kriteria"
              name="nilaiKriteria"
            >
          </div>
          <div class="modal-footer mt-3">
            <button 
              type="submit" 
              class="btn btn-warning"
              name="updatePenilaian"
            >
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="" src="../@popperjs/core/dist/umd/popper.min.js"></script>
  <script type="" src="../bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script>
    if(alertDataKosong) {
      swal({
        title: "Sorry",
        text: "Data Tidak Boleh Kosong",
        buttons: 'OK',
      });
    }
  </script>
  <script>
    if(alertBerhasilSimpan) {
      swal({
        title: "Success",
        text: "Data Berhasil di Simpan",
        buttons: false,
        icon: "success",
        timer: 2000,
      });
    }
  </script>
  <script>
    if(alertBerhasilUpdate) {
      swal({
        title: "Success",
        text: "Data Berhasil di Update",
        buttons: false,
        icon: "success",
        timer: 2000,
      });
    }
  </script>
  <script>
    if(alertBerhasilHapus) {
      swal({
        title: "Success",
        text: "Data Berhasil di Hapus",
        buttons: false,
        icon: "success",
        timer: 2000,
      });
    }
  </script>
  <script>
    if(alertDataSudahAda) {
      swal({
        title: "Sorry",
        text: "Data Sudah Ada",
        buttons: 'OK',
      });
    }
  </script>
  <script>
    if(alertDataKriteraKosong) {
      swal({
        title: "Sorry",
        text: "Data Kriteria Anda Masih Kosong",
        buttons: 'OK',
      });
    }
  </script>
  <script>
    if(alertTotalKriteriaMax) {
      swal({
        title: "Maaf",
        text: "Nilai Kriteria Melebihi Batas",
        buttons: 'OK',
      });
    }
  </script>
  <script>
  if (updateDataPenilaian) {
    const myModal = new bootstrap.Modal(document.getElementById("exampleModal1"), {});
    document.onreadystatechange = function () {
      myModal.show()
    }
  }
  </script>
</body>
</html>