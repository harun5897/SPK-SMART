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
if(isset($_GET['alertDataSama'])) {
  ?>
    <script>var alertDataSama = true;</script>
  <?php
}
if(isset($_GET['alertDataNikSama'])) {
  ?>
    <script>var alertDataNikSama = true;</script>
  <?php
}
if(isset($_POST['simpanPeserta'])) {
  simpanPeserta($koneksi, $_POST['namaDepan'],$_POST['namaBelakang'],$_POST['nik'],$_POST['tanggalLahir'],$_POST['jenisKelamin'],$_POST['agama'],$_POST['alamat'],$_POST['email'],$_POST['kontak']);
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
  <title>Tambah Data</title>
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
      Data Peserta
    </div>
    <div class="card-body add-data mt-2">
      <div class="row">
        <div class="col-lg-8">
          <form action="" method="POST">
            <div class="d-flex justify-content-start row">
              <div class="col-3">
                <label for="">Nama Depan</label>
              </div>
              <div class="col-7 px-0">
                <input type="text" class="form-control" placeholder="Nama Depan" name="namaDepan">
              </div>
            </div>
            <div class="d-flex justify-content-start row mt-3">
              <div class="col-3">
                <label for="">Nama Belakang</label>
              </div>
              <div class="col-7 px-0">
                <input type="text" class="form-control" placeholder="Nama Belakang" name="namaBelakang">
              </div>
            </div>
            <div class="d-flex justify-content-start row mt-3">
              <div class="col-3">
                <label for="">NIK</label>
              </div>
              <div class="col-7 px-0">
                <input type="text" class="form-control" placeholder="NIK" name="nik">
              </div>
            </div>
            <div class="d-flex justify-content-start row mt-3">
              <div class="col-3">
                <label for="">Tanggal Lahir</label>
              </div>
              <div class="col-7 px-0">
                <input type="date" class="form-control" placeholder="" name="tanggalLahir">
              </div>
            </div>
            <div class="d-flex justify-content-start row mt-3">
              <div class="col-3">
                <label for="">Jenis Kelamin</label>
              </div>
              <div class="col-7 px-0">
                <select 
                  class="form-select form-control" 
                  aria-label="Default select example"
                  name="jenisKelamin"
                >
                  <option selected>Plih Jenis Kelamin</option>
                  <option value="laki-laki">laki-laki</option>
                  <option value="perempuan">perempuan</option>
                </select>
              </div>
            </div>
            <div class="d-flex justify-content-start row mt-3">
              <div class="col-3">
                <label for="">Agama</label>
              </div>
              <div class="col-7 px-0">
                <input type="text" class="form-control" placeholder="Agama" name="agama">
              </div>
            </div>
            <div class="d-flex justify-content-start row mt-3">
              <div class="col-3">
                <label for="">Alamat</label>
              </div>
              <div class="col-7 px-0">
                <textarea type="text" class="form-control" placeholder="Agama" name="alamat"> </textarea>
              </div>
            </div>
            <div class="d-flex justify-content-start row mt-3">
              <div class="col-3">
                <label for="">Email</label>
              </div>
              <div class="col-7 px-0">
                <input type="text" class="form-control" placeholder="Email" name="email">
              </div>
            </div>
            <div class="d-flex justify-content-start row mt-3">
              <div class="col-3">
                <label for="">Kontak</label>
              </div>
              <div class="col-7 px-0">
                <input type="text" class="form-control" placeholder="Kontak" name="kontak">
                <div class="d-flex justify-content-end mb-2"> 
                  <button type="submit" class="btn btn-warning mt-3" name="simpanPeserta"> Simpan</button>
                </div>
              </div>
            </div>
          </form>
        </div>
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
    if(alertDataSama) {
      swal({
        title: "Sorry",
        text: "Data kontak telah tersedia, silahkan ganti",
        buttons: 'OK',
      });
    }
  </script>
  <script>
    if(alertDataNikSama) {
      swal({
        title: "Sorry",
        text: "Data nik telah tersedia, silahkan ganti",
        buttons: 'OK',
      });
    }
  </script>
</body>
</html>