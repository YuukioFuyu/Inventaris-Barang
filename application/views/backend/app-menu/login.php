<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login <?= get_option('site_name'); ?></title>
  <link rel="icon" type="image/x-icon" href="<?= (file_exists($_SERVER['DOCUMENT_ROOT'] . '/uploads/logo/' . get_option('site_logo')) && get_option('site_logo')) ? BASE_URL . 'uploads/logo/' . get_option('site_logo') : BASE_ASSET . 'img/logo.png'; ?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
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

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1.5rem;
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

        .text-center-anchor {
          display: block;
          text-align: center;
          margin-top: 15px; /* Jarak antar tombol login dan anchor */
        }

        .copyright {
            position: absolute;
            text-align: center;
            width: 100%;
            line-height: 40px;
            font-size: 1.2rem;
            color: var(--text-color);
            bottom:10vh;
        }

        .copyright a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .copyright a:hover {
            text-decoration: underline;
        }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-container">
<h1>Login</h1>
<h2><b><?= get_option('site_name'); ?></b></h2>
  <!-- /.login-logo -->
    <?php if(isset($error) AND !empty($error)): ?>
         <div class="callout callout-error"  style="color:#C82626">
              <h4>Error!</h4>
              <p><?= $error; ?></p>
            </div>
    <?php endif; ?>
    <?php
    $message = $this->session->flashdata('f_message'); 
    $type = $this->session->flashdata('f_type'); 
    if ($message):
    ?>
   <div class="callout callout-<?= $type; ?>"  style="color:#C82626">
        <p><?= $message; ?></p>
      </div>
    <?php endif; ?>
     <?= form_open('', [
        'name'    => 'form_login', 
        'id'      => 'form_login', 
        'method'  => 'POST'
      ]); ?>
      <div class="form-group has-feedback <?= form_error('username') ? 'has-error' :''; ?>">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Masukkan username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback <?= form_error('password') ? 'has-error' :''; ?>">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" value="1"> Ingat perangkat ini
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    <?= form_close(); ?>

    <a href="<?= site_url('register'); ?>" class="text-center text-center-anchor">Belum memiliki akun? Daftar</a>
</div>
<!-- /.login-box-body -->

<div class="copyright text-center my-auto">
	<span>Copyright &copy; 2022 - <?= date('Y'); ?> <a href="https://yuuki0.net" target="_blank">Yuukio Fuyu</a>. All Rights Reserved</span>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= BASE_ASSET; ?>/admin-lte/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
