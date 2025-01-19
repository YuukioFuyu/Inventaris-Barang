<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="<?= get_option('site_description'); ?>">
  <meta name="keywords" content="<?= get_option('keywords'); ?>">
  <meta name="author" content="<?= get_option('author'); ?>">

  <title><?= get_option('site_name'); ?> 「<?= $template['title']; ?>」 ┋ </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" type="image/x-icon" href="<?= (file_exists($_SERVER['DOCUMENT_ROOT'] . '/uploads/logo/' . get_option('site_logo')) && get_option('site_logo')) ? BASE_URL . 'uploads/logo/' . get_option('site_logo') : BASE_ASSET . 'img/logo.png'; ?>">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/morris/morris.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/sweet-alert/sweetalert.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/toastr/build/toastr.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/fancy-box/source/jquery.fancybox.css?v=2.1.5" media="screen" />
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/chosen/chosen.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/css/custom.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>datetimepicker/jquery.datetimepicker.css"/>
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>js-scroll/style/jquery.jscrollpane.css" rel="stylesheet" media="all" />
  
  <?= $this->cc_html->getCssFileTop(); ?>

  <?php
  $date=date('d-m-Y', strtotime(get_user_data('last_activity')));
  function format_hari_tanggal($waktu)
  {
    $hari_array = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    );
    $hr = date('w', strtotime($waktu));
    $hari = $hari_array[$hr];
    $tanggal = date('j', strtotime($waktu));
    $bulan_array = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    );
    $bl = date('n', strtotime($waktu));
    $bulan = $bulan_array[$bl];
    $tahun = date('Y', strtotime($waktu));
    $jam = date( 'H:i:s', strtotime($waktu));
    
    //untuk menampilkan hari, tanggal bulan tahun jam
    //return "$hari, $tanggal $bulan $tahun $jam";

    //untuk menampilkan hari, tanggal bulan tahun
    return "$hari, $tanggal $bulan $tahun";
  }
  ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/icheck.min.js"></script>
  <script src="<?= BASE_ASSET; ?>/sweet-alert/sweetalert-dev.js"></script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script src="<?= BASE_ASSET; ?>/toastr/toastr.js"></script>
  <script src="<?= BASE_ASSET; ?>/fancy-box/source/jquery.fancybox.js?v=2.1.5"></script>
  <script src="<?= BASE_ASSET; ?>/datetimepicker/build/jquery.datetimepicker.full.js"></script>
  <script src="<?= BASE_ASSET; ?>/editor/dist/js/medium-editor.js"></script>
  <script src="<?= BASE_ASSET; ?>js/cc-extension.js"></script>
  <script src="<?= BASE_ASSET; ?>/js/cc-page-element.js"></script>
  <script>
    setInterval(function () {
        $("head title").html($("head title").html().substring(1) + $("head title").html().substring(0,1));
    }, 200);
  </script>
  <script>
    var BASE_URL = "<?= base_url(); ?>";
    var HTTP_REFERER = "<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/' ; ?>";
    var csrf = '<?= $this->security->get_csrf_token_name(); ?>';
    var token = '<?= $this->security->get_csrf_hash(); ?>';

    $(document).ready(function(){

      toastr.options = {
        "positionClass": "toast-top-center",
      }

      var f_message = '<?= $this->session->flashdata('f_message'); ?>';
      var f_type = '<?= $this->session->flashdata('f_type'); ?>';

      if (f_message.length > 0) {
        toastr[f_type](f_message);
      }

      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
      });
    });
  </script>
  <?= $this->cc_html->getScriptFileTop(); ?>
</head>
<body class="sidebar-mini skin-blue fixed web-body">
<div class="wrapper">

  <header class="main-header">
    <a href="<?= site_url('dashboard'); ?>" class="logo">
        <span class="logo-lg "><b><?= get_option('site_name'); ?></b></span>
        <span class="logo-mini"><img src="<?=BASE_ASSET;?>img/logo.png" width="50px"></span>
    </a>
    <nav class="navbar navbar-static-top">

      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Beralih navigasi</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= BASE_URL.'uploads/user/'.(!empty(get_user_data('avatar')) ? get_user_data('avatar') :'yuuki0.webp'); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= _ent(ucwords(clean_snake_case(get_user_data('full_name')))); ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?= BASE_URL.'uploads/user/'.(!empty(get_user_data('avatar')) ? get_user_data('avatar') :'yuuki0.webp'); ?>" class="img-circle" alt="User Image">

                <p>
                  <?= _ent(ucwords(clean_snake_case($this->aauth->get_user()->full_name))); ?> 
                  <small>Aktivitas terakhir: <?= format_hari_tanggal($date); ?></small>
                </p>
              </li>
              
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= site_url('user/profile'); ?>" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="<?= site_url('auth/logout'); ?>" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
          <!--
          <li>
            <a href="<?= base_url('setting'); ?>" data-toggle="control-setting"><i class="fa fa-gears"></i></a>
          </li>
          -->
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">

    <section class="sidebar" style="padding-top:0% !important">
      <ul class="sidebar-menu  sidebar-admin">
        <?= display_menu_admin(0, 1); ?>
      </ul>
    </section>

  </aside>

  <div class="content-wrapper">
    <?php $this->cc_app->eventListen('backend_content_top'); ?>
    <?= $template['partials']['content']; ?>
    <?php $this->cc_app->eventListen('backend_content_bottom'); ?>
  </div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 3.1
    </div>
    <div class="copyright text-center my-auto">
	    <span>Copyright &copy; 2022 - <?= date('Y'); ?> <a href="https://yuuki0.net" target="_blank">Yuukio Fuyu</a>. All Rights Reserved</span>
    </div>
    <!--<strong>Copyright &copy; 2022-<?=date('Y'); ?> <a href="#"><?= get_option('site_name'); ?></a>.</strong> All rights
    reserved.-->
  </footer>
  
  <div class="control-sidebar-bg"></div>
</div>

<?= $this->cc_html->getCssFileBottom(); ?>
<?= $this->cc_html->getScriptFileBottom(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js" type="text/javascript"></script>
<script src="<?= BASE_ASSET; ?>jquery-ui/jquery-ui.js"></script>
<script src="<?= BASE_ASSET; ?>jquery-switch-button/jquery.switchButton.js"></script>
<script src="<?= BASE_ASSET; ?>/js/jquery.ui.touch-punch.js"></script>
<script src="<?= BASE_ASSET; ?>/admin-lte/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/fastclick/fastclick.js"></script>
<script src="<?= BASE_ASSET; ?>/admin-lte/dist/js/app.min.js"></script>
<script src="<?= BASE_ASSET; ?>/admin-lte/dist/js/demo.js"></script>
<script src="<?= BASE_ASSET; ?>js-scroll/script/jquery.jscrollpane.min.js"></script>
<script src="<?= BASE_ASSET; ?>jquery-switch-button/jquery.switchButton.js"></script>
<script src="<?= BASE_ASSET; ?>/js/custom.js"></script>
</body>
</html>
