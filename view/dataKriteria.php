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
      Data Kriteria
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-3 pe-4">
          <a href="#" style="text-decoration: none;">
            <div class="card">
              <div class="card-body">
                Data Peserta
              </div>
            </div>
          </a>
          <a href="#" style="text-decoration: none;">
            <div class="card mt-2">
              <div class="card-body">
                Data Kriteria
              </div>
            </div>
          </a>
          <a href="#" style="text-decoration: none;">
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
              <a 
                href="" 
                class="btn btn-md btn-success" 
                data-bs-toggle="modal" 
                data-bs-target="#exampleModal"
              > Tambah Data </a>
            </div>
            <div class="form">
              <input type="text" class="form-control" placeholder="Cari">
            </div>
          </div>
          <hr>
          <table class="table table-hover">
            <tr>
              <th>No</th>
              <th>Nama Kriteria</th>
              <th>Bobot</th>
              <th>Aksi</th>
            </tr>
            <tr>
              <td>1</td>
              <td>Komputer</td>
              <td>35%</td>
              <th><a href="" class="btn btn-sm btn-warning">Detail</a></th>
            </tr>
            <tr>
              <td>2</td>
              <td>Pendidikan</td>
              <td>30%</td>
              <th><a href="" class="btn btn-sm btn-warning">Detail</a></th>
            </tr>
            <tr>
              <td>3</td>
              <td>Pengalaman</td>
              <td>20%</td>
              <th><a href="" class="btn btn-sm btn-warning">Detail</a></th>
            </tr>
            <tr>
              <td>4</td>
              <td>Kendaraan</td>
              <td>15%</td>
              <th><a href="" class="btn btn-sm btn-warning">Detail</a></th>
            </tr>
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
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <select class="form-select mt-3" aria-label="Default select example">
            <option selected>Pilih Data Kriteria</option>
            <option value="1">Komputer</option>
            <option value="2">Pendidikan</option>
            <option value="3">Pengalaman</option>
            <option value="4">Kendaraan</option>
          </select>
          <input type="text" class="form-control mt-3" placeholder="Masukan Nilai">
        </div>
        <div class="modal-footer mt-3">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <script type="" src="../@popperjs/core/dist/umd/popper.min.js"></script>
  <script type="" src="../bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>