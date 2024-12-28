<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Daftar <?= get_option('site_name'); ?></title>
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

    .login-container input {
      width: 100%;
      padding: 20px;
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

    .captcha-box {
      padding: 5px 0;
    }

    .captcha-box input {
      width: 30%;
      border: 1px solid #E5E2E2;
      padding: 5px;
    }

    .captcha-box img {
      width: 55%;
      float: right;
    }

    .required {
      color: #D02727;
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
  <h1>Daftar</h1>
  <h2><b><?= get_option('site_name'); ?></b></h2>
  
  <?php if (isset($error) && !empty($error)): ?>
    <div class="callout callout-error" style="color:#C82626">
      <h4>Error!</h4>
      <p><?= $error; ?></p>
    </div>
  <?php endif; ?>

  <?php
    $message = $this->session->flashdata('f_message'); 
    $type = $this->session->flashdata('f_type'); 
    if ($message):
  ?>
    <div class="callout callout-<?= $type; ?>" style="color:#C82626">
      <p><?= $message; ?></p>
    </div>
  <?php endif; ?>

  <?= form_open('', [
      'name'    => 'form_register', 
      'id'      => 'form_register', 
      'method'  => 'POST'
    ]); ?>
    <div class="form-group has-feedback <?= form_error('full_name') ? 'has-error' :''; ?>">
      <label>Nama Lengkap</label>
      <input class="form-control" placeholder="Nama Lengkap" name="full_name" value="<?= set_value('full_name'); ?>" required>
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback <?= form_error('username') ? 'has-error' :''; ?>">
      <label>Username <span class="required">*</span></label>
      <input class="form-control" placeholder="Username" name="username" value="<?= set_value('username'); ?>" required>
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback <?= form_error('email') ? 'has-error' :''; ?>">
      <label>Email <span class="required">*</span></label>
      <input type="email" class="form-control" placeholder="Email" name="email" value="<?= set_value('email'); ?>" required>
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback <?= form_error('password') ? 'has-error' :''; ?>">
      <label>Password <span class="required">*</span></label>
      <input type="password" class="form-control" placeholder="Password" name="password" required>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    <?php $cap = get_captcha(); ?>
    <div class="form-group <?= form_error('captcha') ? 'has-error' :''; ?>">
      <label>CAPTCHA <span class="required">*</span></label>
      <div class="captcha-box" data-captcha-time="<?= (int)$cap['time']; ?>">
        <input type="text" name="captcha" placeholder="" required>
        <a class="btn btn-flat refresh-captcha"><i class="fa fa-refresh text-danger"></i></a>
        <span class="box-image"><?= $cap['image']; ?></span>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="checkbox icheck">
          <label>
            <input type="checkbox" name="agree" value="1" required> Saya menyetujui persyaratan dan ketentuan
          </label>
        </div>
      </div>

      <div class="col-xs-12">
        <button type="submit" class="btn btn-primary">Daftar</button>
      </div>
    </div>
  <?= form_close(); ?>

  <a href="<?= site_url('login'); ?>" class="text-center text-center-anchor">Sudah memiliki akun? Masuk</a>
</div>

<div class="copyright text-center">
  <span>Copyright &copy; 2022 - <?= date('Y'); ?> <a href="https://yuuki0.net" target="_blank">Yuukio Fuyu</a>. All Rights Reserved</span>
</div>

<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?= BASE_ASSET; ?>/admin-lte/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function() {
    var BASE_URL = "<?= base_url(); ?>";

    $.fn.printMessage = function(opsi) {
      var opsi = $.extend({
        type: 'success',
        message: 'Success',
        timeout: 500000
      }, opsi);

      $(this).hide();
      $(this).html(' <div class="col-md-12 message-alert"><div class="callout callout-' + opsi.type + '"><h4>' + opsi.type + '!</h4>' + opsi.message + '</div></div>');
      $(this).slideDown('slow');
      setTimeout(function() {
        $('.message-alert').slideUp('slow');
      }, opsi.timeout);
    };

    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' 
    });

    $('.refresh-captcha').on('click', function() {
      var capparent = $(this);

      $.ajax({
        url: BASE_URL + '/captcha/reload/' + capparent.parent('.captcha-box').attr('data-captcha-time'),
        dataType: 'JSON',
      })
      .done(function(res) {
        capparent.parent('.captcha-box').find('.box-image').html(res.image);
        var capTime = parseInt(res.captcha.time);
        capparent.parent('.captcha-box').attr('data-captcha-time', capTime);
      })
      .fail(function() {
        $('.message').printMessage({
          message: 'Error getting captcha',
          type: 'warning'
        });
      });
    });
  });
</script>
</body>
</html>
