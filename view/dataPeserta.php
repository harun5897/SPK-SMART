<?php
session_start();
include_once('../handlingData/module.php');
include_once('../handlingData/koneksi.php');

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

if(isset($_GET['dataPeserta'])){
  if($_GET['dataPeserta'] == 'hapus') {
    $idPeserta = $_GET['idPeserta'];
    hapusPeserta($koneksi, $idPeserta);
  }
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
            Harun
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="#">Keluar</a>
            <a class="dropdown-item" href="#">Ganti Kata Sandi</a>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- Content -->
  <div class="content container-md card">
    <div class="card-header">
      Data Peserta
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-3 pe-4">
          <a href="dataPeserta.php" style="text-decoration: none;">
            <div class="card">
              <div class="card-body">
                Data Peserta
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
          <a href="#" style="text-decoration: none;">
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
              <a href="/SPK-SMART/view/tambahDataPeserta.php" class="btn btn-md btn-success"> Tambah Data</a>
            </div>
            <div class="form">
              <input type="text" class="form-control" placeholder="Cari">
            </div>
          </div>
          <hr>
          <table class="table table-hover">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>Kontak</th>
              <th>Aksi</th>
            </tr>
            <?php
              $no = 0;
              $dataPeserta = mysqli_query($koneksi, "SELECT * FROM tabelpeserta");
              while($arrDataPeserta = mysqli_fetch_array($dataPeserta)) :
                $no++;
            ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?=$arrDataPeserta['namaDepan']?></td>
              <td><?=$arrDataPeserta['jenisKelamin']?></td>
              <td><?=$arrDataPeserta['kontak']?></td>
              <th>
                <a href="updateDataPeserta.php?dataPeserta=update&idPeserta=<?=$arrDataPeserta['idPeserta']?>" class="btn btn-sm btn-warning">Detail</a>
                <a href="dataPeserta.php?dataPeserta=hapus&idPeserta=<?=$arrDataPeserta['idPeserta']?>" class="btn btn-sm btn-danger">Hapus</a>
              </th>
            </tr>
            <?php
              endwhile;
            ?>
          </table>
          <div class="d-flex justify-content-between">
            <div>
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo; Previous</span>
              </a>
            </div>
            <div>
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">Next &raquo;</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="" src="../@popperjs/core/dist/umd/popper.min.js"></script>
  <script type="" src="../bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
</body>
</html>
