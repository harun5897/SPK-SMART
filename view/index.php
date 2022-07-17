<?php
  session_start();
  include_once('../handlingData/module.php');
  include_once('../handlingData/koneksi.php');

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
</body>
</html>