<?php
session_start();
include_once('../handlingData/smart.php');
include_once('../handlingData/koneksi.php');

if($_SESSION['loginStatus'] != 1) {
  header('location: index.php?alertBelumLogin=true');
}
if(isset($_POST['pesertaTerbaik'])) {
  pesertaTerbaik($koneksi);
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
  <nav class="navbar p-2 fixed-top">
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
  <div class="content container-md card" style="margin-top: 6.3rem;">
    <div class="card-header">
      Langkah Perangkingan
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
            <form action="" method="POST">
              <div class="button">
                <button
                  type="submit"
                  class="btn btn-md btn-success" 
                  name="pesertaTerbaik"
                > Peserta Terbaik </button>
              </div>
            </form>
            <div class="form">
              <input id="search" type="text" class="form-control" placeholder="Cari">
            </div>
          </div>
          <hr>
          <h4 class="mt-2 bg-warning py-1 ps-1">Tabel Nilai</h4>
          <table id="myTable" class="table table-hover">
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama</th>
              <th class="text-center">C1</th>
              <th class="text-center">C2</th>
							<th class="text-center">C3</th>
              <th class="text-center">C4</th>
            </tr>
            <?php
              $no = 0;
              $dataPenilaian = mysqli_query($koneksi, "SELECT * FROM tabelpenilaian");
              while($arrDataPenilaian = mysqli_fetch_array($dataPenilaian)) :
                $no++;
                $idPeserta = $arrDataPenilaian['idPeserta'];
                $dataPeserta = mysqli_query($koneksi, "SELECT * FROM tabelpeserta WHERE idPeserta = '$idPeserta'");
                $arrDataPeserta = mysqli_fetch_array($dataPeserta);
            ?>
            <tr>
              <td class="text-center"><?php echo $no; ?></td>
              <td class="text-center"><?=$arrDataPeserta['namaDepan']?></td>
              <td class="text-center"><?=$arrDataPenilaian['kriteriaKomputer']?></td>
              <td class="text-center"><?=$arrDataPenilaian['kriteriaPendidikan']?></td>
              <td class="text-center"><?=$arrDataPenilaian['kriteriaPengalaman']?></td>
              <td class="text-center"><?=$arrDataPenilaian['kriteraKendaraan']?></td>
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

          <h4 class="mt-4 bg-warning py-1 ps-1">Tabel Utility</h4>
          <table id="myTable" class="table table-hover">
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama</th>
              <th class="text-center">C1</th>
              <th class="text-center">C2</th>
							<th class="text-center">C3</th>
              <th class="text-center">C4</th>
            </tr>
            <?php
              $no = 0;
              $dataPenilaian = mysqli_query($koneksi, "SELECT * FROM tabelpenilaian");
              while($arrDataPenilaian = mysqli_fetch_array($dataPenilaian)) :
                $no++;
                $idPeserta = $arrDataPenilaian['idPeserta'];
                $arrDataUtility = getUtility($koneksi, $idPeserta, $arrDataPenilaian['kriteriaKomputer'], $arrDataPenilaian['kriteriaPendidikan'], $arrDataPenilaian['kriteriaPengalaman'], $arrDataPenilaian['kriteraKendaraan']);
            ?>
            <tr>
              <td class="text-center"><?php echo $no; ?></td>
              <td class="text-center"><?=$arrDataUtility[1]['namaDepan']?></td>
              <td class="text-center"><?=$arrDataUtility[0]['utilityKomputer']?></td>
              <td class="text-center"><?=$arrDataUtility[0]['utilityPendidikan']?></td>
              <td class="text-center"><?=$arrDataUtility[0]['utilityPengalaman']?></td>
              <td class="text-center"><?=$arrDataUtility[0]['utilityKendaraan']?></td>
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

          <h4 class="mt-4 bg-warning py-1 ps-1">Tabel Nilai Akhir</h4>
          <table id="myTable" class="table table-hover">
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama</th>
              <th class="text-center">C1</th>
              <th class="text-center">C2</th>
							<th class="text-center">C3</th>
              <th class="text-center">C4</th>
              <th class="text-center">Nilai Akhir</th>
            </tr>
            <?php
              $no = 0;
              $dataPenilaian = mysqli_query($koneksi, "SELECT * FROM tabelpenilaian");
              while($arrDataPenilaian = mysqli_fetch_array($dataPenilaian)) :
                $no++;
                $idPeserta = $arrDataPenilaian['idPeserta'];
                $arrDataUtility = getNilaiAkhir($koneksi, $idPeserta, $arrDataPenilaian['kriteriaKomputer'], $arrDataPenilaian['kriteriaPendidikan'], $arrDataPenilaian['kriteriaPengalaman'], $arrDataPenilaian['kriteraKendaraan']);
            ?>
            <tr>
              <td class="text-center"><?php echo $no; ?></td>
              <td class="text-center"><?=$arrDataUtility[1]['namaDepan']?></td>
              <td class="text-center"><?=$arrDataUtility[0]['nilaiAkhirKomputer']?></td>
              <td class="text-center"><?=$arrDataUtility[0]['nilaiAkhirPendidikan']?></td>
              <td class="text-center"><?=$arrDataUtility[0]['nilaiAkhirPengalaman']?></td>
              <td class="text-center"><?=$arrDataUtility[0]['nilaiAkhirKendaraan']?></td>
              <td class="text-center"><?=$arrDataUtility[2]?></td>
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
	
</body>
</html>