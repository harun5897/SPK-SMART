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
    <div class="card-body add-data mt-2">
      <div class="row">
        <div class="col-lg-8">
          <form action="">
            <div class="d-flex justify-content-start row">
              <div class="col-3">
                <label for="">Nama Depan</label>
              </div>
              <div class="col-7 px-0">
                <input type="text" class="form-control" placeholder="Nama Depan">
              </div>
            </div>
            <div class="d-flex justify-content-start row mt-3">
              <div class="col-3">
                <label for="">Nama Belakang</label>
              </div>
              <div class="col-7 px-0">
                <input type="text" class="form-control" placeholder="Nama Belakang">
              </div>
            </div>
            <div class="d-flex justify-content-start row mt-3">
              <div class="col-3">
                <label for="">NIK</label>
              </div>
              <div class="col-7 px-0">
                <input type="text" class="form-control" placeholder="NIK">
              </div>
            </div>
            <div class="d-flex justify-content-start row mt-3">
              <div class="col-3">
                <label for="">Tempat Tanggal Lahir</label>
              </div>
              <div class="col-7 px-0">
                <input type="date" class="form-control" placeholder="">
              </div>
            </div>
            <div class="d-flex justify-content-start row mt-3">
              <div class="col-3">
                <label for="">Agama</label>
              </div>
              <div class="col-7 px-0">
                <input type="text" class="form-control" placeholder="Agama">
              </div>
            </div>
            <div class="d-flex justify-content-start row mt-3">
              <div class="col-3">
                <label for="">Alamat</label>
              </div>
              <div class="col-7 px-0">
                <textarea type="text" class="form-control" placeholder="Agama"> </textarea>
              </div>
            </div>
            <div class="d-flex justify-content-start row mt-3">
              <div class="col-3">
                <label for="">Email</label>
              </div>
              <div class="col-7 px-0">
                <input type="text" class="form-control" placeholder="Email">
              </div>
            </div>
            <div class="d-flex justify-content-start row mt-3">
              <div class="col-3">
                <label for="">Kontak</label>
              </div>
              <div class="col-7 px-0">
                <input type="text" class="form-control" placeholder="Kontak">
                <div class="d-flex justify-content-end mb-2"> 
                  <a href=""class="btn btn-warning mt-3"> Simpan</a>
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
</body>
</html>