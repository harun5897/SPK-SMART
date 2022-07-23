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
if(isset($_GET['alertDataBerhasilUpdate'])) {
  ?>
    <script>var alertDataBerhasilUpdate = true;</script>
  <?php
}

if(isset($_POST['simpanUser'])) {
	simpanUser($koneksi, $_POST['namaUser'], $_POST['email'], $_POST['role']);
}
if(isset($_POST['updateUser'])) {
  $idUser = $_SESSION['idUser'];
  updateUser($koneksi, $idUser, $_POST['namaUser'], $_POST['email'], $_POST['role']);

}

if(isset($_GET['daftarUser'])) {
  if($_GET['daftarUser'] == 'hapus') {
    hapusUser($koneksi, $_GET['idUser']);
  }
  if($_GET['daftarUser'] == 'update') {
    $idUser = $_GET['idUser'];
    $_SESSION['idUser'] = $idUser;
    $updateDataUser = mysqli_query($koneksi, "SELECT * FROM tabeluser WHERE `idUser` = '$idUser'");
    $arrUpdateDataUser = mysqli_fetch_array($updateDataUser);
    ?> 
      <script>var updateDataUser = true;</script>
    <?php
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
      Daftar User
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
              > Tambah User </a>
            </div>
            <div class="form">
              <input id="search" type="text" class="form-control" placeholder="Cari">
            </div>
          </div>
          <hr>
          <table id="myTable" class="table table-hover">
            <tr>
              <th>No</th>
              <th>Nama User</th>
              <th>Email</th>
							<th>Role</th>
              <th>Aksi</th>
            </tr>
            <?php
              $no = 0;
              $dataUser = mysqli_query($koneksi, "SELECT * FROM tabeluser");
              while($arrDataUser = mysqli_fetch_array($dataUser)) :
                $no++;
            ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?=$arrDataUser['namaUser']?></td>
              <td><?=$arrDataUser['email']?></td>
							<td><?=$arrDataUser['role']?></td>
              <td>
                <a href="daftarUser.php?daftarUser=update&idUser=<?=$arrDataUser['idUser']?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="daftarUser.php?daftarUser=hapus&idUser=<?=$arrDataUser['idUser']?>" class="btn btn-sm btn-danger">Hapus</a>
              </td>
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

  <!-- Modal Tambah Data User-->
  <div class="modal fade" 
    tabindex="-1"
    id="exampleModal"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
						<label for="" class="text-black">Nama User</label>
            <input 
              type="text" 
              class="form-control mt-1" 
              placeholder="Nama User"
              name="namaUser"
            >
						<label for="" class="text-black mt-3">Email</label>
            <input 
              type="text" 
              class="form-control mt-1" 
              placeholder="Email"
              name="email"
            >
						<label for="" class="text-black mt-3">Role User</label>
						<select 
              class="form-select mt-1 form-control" 
              aria-label="Default select example"
              name="role"
            >
              <option value="0"selected>Pilih Role User</option>
              <option value="admin">Admin</option>
              <option value="superAdmin">Super Admin</option>
            </select>
          </div>
          <div class="modal-footer mt-3">
            <button 
              type="submit" 
              class="btn btn-primary"
              name="simpanUser"
            >
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Update Data User-->
  <div class="modal fade" 
    tabindex="-1"
    id="exampleModalUpdate"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Data User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
						<label for="" class="text-black">Nama User</label>
            <input 
              type="text" 
              class="form-control mt-1" 
              placeholder="Nama User"
              name="namaUser"
              value='<?php echo $arrUpdateDataUser['namaUser']?>'
            >
						<label for="" class="text-black mt-3">Email</label>
            <input 
              type="text" 
              class="form-control mt-1" 
              placeholder="Email"
              name="email"
              value='<?php echo $arrUpdateDataUser['email']?>'
            >
						<label for="" class="text-black mt-3">Role User</label>
						<select 
              class="form-select mt-1 form-control" 
              aria-label="Default select example"
              name="role"
            >
              <option value="0"selected>Pilih Role User</option>
              <option 
                value="admin"
                <?=$arrUpdateDataUser['role'] == 'admin' ? ' selected="selected"' : ''?>
              >
                Admin
              </option>
              <option 
                value="superAdmin"
                <?=$arrUpdateDataUser['role'] == 'superAdmin' ? ' selected="selected"' : ''?>
              >
                Super Admin
              </option>
            </select>
          </div>
          <div class="modal-footer mt-3">
            <button 
              type="submit" 
              class="btn btn-primary"
              name="updateUser"
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
    if(alertDataBerhasilUpdate) {
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
    if (updateDataUser) {
      var myModal = new bootstrap.Modal(document.getElementById("exampleModalUpdate"), {});
      document.onreadystatechange = function () {
        myModal.show();
      };
    }
  </script>
</body>
</html>