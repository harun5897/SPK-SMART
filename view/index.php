<?php
  session_start();
  include_once('../handlingData/module.php');
  include_once('../handlingData/koneksi.php');

  if(isset($_GET['alertLogout'])) {
    ?>
      <script>var alertLogout = true;</script>
    <?php
  }
  if(isset($_GET['alertGagalLogin'])) {
    ?>
      <script>var alertGagalLogin = true;</script>
    <?php
  }
  if(isset($_GET['alertBelumLogin'])) {
    ?>
      <script>var alertBelumLogin = true;</script>
    <?php
  }
  if(isset($_GET['alertBerhasilGantiKataSandi'])) {
    ?>
      <script>var alertBerhasilGantiKataSandi = true;</script>
    <?php
  }
  if(isset($_GET['alertGagalGantiKataSandi'])) {
    ?>
      <script>var alertGagalGantiKataSandi = true;</script>
    <?php
  }

  if(isset($_POST['login'])) {
    login($koneksi, $_POST['email'], $_POST['kataSandi']);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/scss/style.css">
  <title>Document</title>
</head>
<body>
  <div class="login position-absolute d-flex align-items-center justify-content-center" style="width: 100%; height: 100vh;">
    <div class="card" style="width: 26rem;">
      <div class="card-header text-center p-3">
      Sistem Penerimaan Karyawan
      <p class="m-0">Kantor Notaris Kota Tanjung Pinang</p>
      </div>
      <form action="" method="POST">
        <div class="card-body px-4">
          <label for="">Email</label>
          <input type="text" class="form-control my-2" name="email">
          <label for="">Kata Sandi</label>
          <input type="password" class="form-control my-2" name="kataSandi">
          <div class="">
            <button type="submit" class="btn btn-primary my-2" name="login"> Masuk </button>
          </div>
        </div>
      </form>
  </div>

  <script type="" src="../@popperjs/core/dist/umd/popper.min.js"></script>
  <script type="" src="../bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    if(alertLogout) {
      swal({
        title: "Berhasil",
        text: "Berhasil Keluar",
        buttons: false,
        icon: "success",
        timer: 2000,
      });
    }
  </script>
  <script>
    if(alertGagalLogin) {
      console.log('tes')
      swal({
        title: "Maaf",
        text: "Password dan Email Salah!",
        buttons: 'OK',
      });
    }
  </script>
  <script>
    if(alertBelumLogin) {
      swal({
        title: "Maaf",
        text: "Silahkan Login Terlebih Dahulu!",
        buttons: 'OK',
      });
    }
  </script>
  <script>
    if(alertBerhasilGantiKataSandi) {
      swal({
        title: "Berhasil",
        text: "Kata Sandi Berhasil di Ubah!",
        buttons: 'OK',
        icon: 'success'
      });
    }
  </script>
  <script>
    if(alertGagalGantiKataSandi) {
      swal({
        title: "Gagal",
        text: "Cek Kembali kata sandi lama dan kata sandi baru!",
        buttons: 'OK',
        icon: 'error'
      });
    }
  </script>
</body>
</html>

