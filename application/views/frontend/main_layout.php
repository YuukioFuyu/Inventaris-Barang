<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ciool | Wizzard</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
    
    @media (max-width: 768px) {
      .step {
        margin-bottom: 100px;
      }

      .btn {
        margin-top: 60px;
      }
    }
  .step .line {
    border-bottom: 3px solid #959595;
    width: 210px;
    margin-top: 30px;
    margin-bottom: 20px;
    position: relative;
  }

  .step .round-step {
    border-radius: 3px;
    width: 20px;
    height: 20px;
    background: #959595;
    margin-top: -10px;
    position: absolute;
    padding: 2px;
    color: #fff;
    font-size: 10px;
    font-family: arial;
    border:1px solid #959595;
  }

  .step .success {
    background: #00a65a 
  }

  .wrapper {
    background: #ecf0f5 !important;
  }

  </style>
<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container col-md-8 col-md-offset-2">
      <?= $template['partials']['content']; ?>
    </div>
    <!-- /.container -->
  </div>
 
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<!-- Bootstrap 3.3.6 -->
<script src="<?= BASE_ASSET; ?>/admin-lte/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= BASE_ASSET; ?>/admin-lte/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= BASE_ASSET; ?>/admin-lte/dist/js/demo.js"></script>
</body>
</html>
