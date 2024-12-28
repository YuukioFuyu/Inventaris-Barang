<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Lupa Password <?= get_option('site_name'); ?></title>
  <link rel="icon" type="image/x-icon" href="<?= (file_exists($_SERVER['DOCUMENT_ROOT'] . '/uploads/logo/' . get_option('site_logo')) && get_option('site_logo')) ? BASE_URL . 'uploads/logo/' . get_option('site_logo') : BASE_ASSET . 'img/logo.png'; ?>">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/square/blue.css">
  <style>
    :root {
      --primary-color: #1e88e5; /* Biru */
      --secondary-color: #f5f5f5; /* Abu-abu terang */
      --text-color: #333; /* Abu-abu gelap */
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: var(--secondary-color);
      color: var(--text-color);
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      min-height: 100vh;
    }

    .login-container {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 30px;
      width: 100%;
      max-width: 400px;
    }

    .login-container h1 {
      margin: 0 0 5px;
      font-size: 3rem;
      text-align: center;
    }

    .login-container h2 {
      margin: 0 0 20px;
      font-size: 2rem;
      text-align: center;
      color: var(--primary-color);
    }

    .login-container label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .login-container button {
      width: 100%;
      padding: 10px;
      background-color: var(--primary-color);
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1.5rem;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .login-container button:hover {
      background-color: darkblue;
    }

    .form-group .glyphicon {
      margin-top: 5px;
      pointer-events: none;
    }

    .copyright {
      text-align: center;
      line-height: 40px;
      font-size: 1.2rem;
      color: var(--text-color);
      padding-top: 30px; /* padding-top untuk memberi jarak antara form dan copyright */
      margin-top: 20px;
    }

    .copyright a {
      color: var(--primary-color);
      text-decoration: none;
    }

    .copyright a:hover {
      text-decoration: underline;
    }

    .text-center-anchor {
      display: block;
      text-align: center;
      margin-top: 15px; /* Jarak antar tombol login dan anchor */
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-container">
  <h1>Lupa Password</h1>
  <h2><b><?= get_option('site_name'); ?></b></h2>
  
  <div class="callout callout-info">
    <p>Harap Hubungi Administrator untuk bantuan lebih lanjut mengenai pemulihan password Anda.</p>
  </div>

  <a href="<?= site_url('login'); ?>" class="text-center text-center-anchor">Kembali ke Halaman Login</a>
</div>

<div class="copyright text-center">
  <span>Copyright &copy; 2022 - <?= date('Y'); ?> <a href="https://yuuki0.net" target="_blank">Yuukio Fuyu</a>. All Rights Reserved</span>
</div>

<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?= BASE_ASSET; ?>/admin-lte/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
