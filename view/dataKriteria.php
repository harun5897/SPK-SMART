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
if(isset($_GET['alertBerhasilHapus'])) {
  ?>
    <script>var alertBerhasilHapus = true;</script>
  <?php
}
if(isset($_GET['alertTotalKriteriaMax'])) {
  ?>
    <script>var alertTotalKriteriaMax = true;</script>
  <?php
}

if(isset($_GET['dataKriteria'])){
  if($_GET['dataKriteria'] == 'update') {
    $idKriteria = $_GET['idKriteria'];
    $dataKriteriaEdit = mysqli_query($koneksi, "SELECT * FROM `tabelkriteria` WHERE `idKriteria` = '$idKriteria'");
    $arrDataKriteriaEdit = mysqli_fetch_array($dataKriteriaEdit);
    ?>
      <script>var updateDataKriteria = true;</script>
    <?php
  }
}

if(isset($_GET['dataKriteria'])){
  if($_GET['dataKriteria'] == 'hapus') {
    $idKriteria = $_GET['idKriteria'];
    hapusKriteria($koneksi, $idKriteria);
  }
}

if(isset($_POST['simpanKriteria'])) {
  simpanKriteria($koneksi, $_POST['namaKriteria'],$_POST['bobotKriteria']);
}

if(isset($_POST['updateKriteria'])) {
  updateKriteria($koneksi, $_POST['namaKriteria'],$_POST['bobotKriteria'], $idKriteria);
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
      Data Kriteria
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
              > Tambah Kriteria </a>
            </div>
            <div class="form">
              <input id="search" type="text" class="form-control" placeholder="Cari">
            </div>
          </div>
          <hr>
          <table id="myTable" class="table table-hover">
            <tr>
              <th>No</th>
              <th>Nama Kriteria</th>
              <th>Bobot</th>
              <th>Action</th>
            </tr>
            <?php
              $no = 0;
              $dataKriteria = mysqli_query($koneksi, "SELECT * FROM tabelkriteria");
              while($arrDataKriteria = mysqli_fetch_array($dataKriteria)) :
                $no++;
            ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?=$arrDataKriteria['namaKriteria']?></td>
              <td><?=$arrDataKriteria['bobotKriteria']?></td>
              <td>
                <a 
                  href="dataKriteria.php?dataKriteria=update&idKriteria=<?=$arrDataKriteria['idKriteria']?>" 
                  class="btn btn-warning btn-sm"
                > 
                  Edit 
                </a>
                <a 
                  href="dataKriteria.php?dataKriteria=hapus&idKriteria=<?=$arrDataKriteria['idKriteria']?>" 
                  class="btn btn-danger btn-sm"
                > 
                  Hapus 
                </a>
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
          <h5 class="modal-title">Masukan Data Kriteria</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
            <input 
              type="text" 
              class="form-control mt-3" 
              placeholder="Masukan Nama Kriteria"
              name="namaKriteria"
            >
            <input 
              type="text" 
              class="form-control mt-3" 
              placeholder="Masukan Bobot Kriteria"
              name="bobotKriteria"
            >
          </div>
          <div class="modal-footer mt-3">
            <button 
              type="submit" 
              class="btn btn-primary"
              name="simpanKriteria"
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
          <h5 class="modal-title">Edit Data Kriteria</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
            <input 
              type="text" 
              class="form-control mt-3" 
              placeholder="Masukan Nama Kriteria"
              name="namaKriteria"
              value="<?=$arrDataKriteriaEdit['namaKriteria']?>"
            >
            <input 
              type="text" 
              class="form-control mt-3" 
              placeholder="Masukan Bobot Kriteria"
              name="bobotKriteria"
              value="<?=$arrDataKriteriaEdit['bobotKriteria']?>"
            >
          </div>
          <div class="modal-footer mt-3">
            <button 
              type="submit" 
              class="btn btn-warning"
              name="updateKriteria"
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
    if(alertTotalKriteriaMax) {
      swal({
        title: "Maaf",
        text: "Nilai Kriteria Melebihi Batas",
        buttons: 'OK',
      });
    }
  </script>

  <script>
  if (updateDataKriteria) {
    const myModal = new bootstrap.Modal(document.getElementById("exampleModal1"), {});
    document.onreadystatechange = function () {
      myModal.show()
    }
  }
  </script>
</body>
</html>