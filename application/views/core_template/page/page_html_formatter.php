<?php if ($page->template == 'blank'): ?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $title; ?></title>
	<?php 
	foreach ($css_top as $css) {
		echo $css;
	}
	?>
  	<link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/all.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/all.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/dist/css/callout.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/sweet-alert/sweetalert.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/toastr/build/toastr.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_ASSET; ?>/fancy-box/source/jquery.fancybox.css?v=2.1.5" media="screen" />
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/chosen/chosen.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/css/custom.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_ASSET; ?>datetimepicker/jquery.datetimepicker.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

  	<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
  	<script src="<?= BASE_ASSET; ?>/fancy-box/source/jquery.fancybox.js?v=2.1.5"></script>
	<script src="<?= BASE_ASSET; ?>jquery-ui/jquery-ui.js"></script>
  	<script src="<?= BASE_ASSET; ?>/toastr/toastr.js"></script>
  	<script src="<?= BASE_ASSET; ?>/datetimepicker/build/jquery.datetimepicker.full.js"></script>
    <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js" type="text/javascript"></script>
  	<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/icheck.min.js"></script>
  	<script>
	    var BASE_URL = "<?= base_url(); ?>";
	    var HTTP_REFERER = "<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/' ; ?>";
	    var csrf = '<?= $this->security->get_csrf_token_name(); ?>';
	    var token = '<?= $this->security->get_csrf_hash(); ?>';

	    $(document).ready(function(){

	      toastr.options = {
	        "positionClass": "toast-top-center",
	      }

	      //flash message
	      var f_message = "<?= $this->session->flashdata('f_message'); ?>";
	      var f_type = "<?= $this->session->flashdata('f_type'); ?>";
	      if (f_message.length > 0) {
	        toastr[f_type](f_message);
	      }

	      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	        checkboxClass: 'icheckbox_flat-green',
	        radioClass: 'iradio_flat-green'
	      });
	    });
	  </script>
	<?php 
	foreach ($script_top as $script) {
		echo $script;
	}
	?>
</head>
<body>
<?php 
foreach ($html_body as $html) {
	echo $html;
}
foreach ($script_bottom as $script) {
	echo $script;
}
?>

<script src="http://localhost:80/ci-lte-generator/asset/js/custom.js"></script>
</body>
</html>

<?php elseif ($page->template == 'default'): ?>
<?php $this->template->title($page->title); ?>
<?php 
foreach ($css_top as $css) {
	echo $css;
}
?>
  	<link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/all.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/all.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/dist/css/callout.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/sweet-alert/sweetalert.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/toastr/build/toastr.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_ASSET; ?>/fancy-box/source/jquery.fancybox.css?v=2.1.5" media="screen" />
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/chosen/chosen.css">
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>/css/custom.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_ASSET; ?>datetimepicker/jquery.datetimepicker.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

  	<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
  	<script src="<?= BASE_ASSET; ?>/fancy-box/source/jquery.fancybox.js?v=2.1.5"></script>
	<script src="<?= BASE_ASSET; ?>jquery-ui/jquery-ui.js"></script>
  	<script src="<?= BASE_ASSET; ?>/toastr/toastr.js"></script>
  	<script src="<?= BASE_ASSET; ?>/datetimepicker/build/jquery.datetimepicker.full.js"></script>
    <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js" type="text/javascript"></script>
  	<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/icheck.min.js"></script>
  	<script>
	    var BASE_URL = "<?= base_url(); ?>";
	    var HTTP_REFERER = "<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/' ; ?>";
	    var csrf = '<?= $this->security->get_csrf_token_name(); ?>';
	    var token = '<?= $this->security->get_csrf_hash(); ?>';

	    $(document).ready(function(){

	      toastr.options = {
	        "positionClass": "toast-top-center",
	      }

	      //flash message
	      var f_message = "<?= $this->session->flashdata('f_message'); ?>";
	      var f_type = "<?= $this->session->flashdata('f_type'); ?>";
	      if (f_message.length > 0) {
	        toastr[f_type](f_message);
	      }

	      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	        checkboxClass: 'icheckbox_flat-green',
	        radioClass: 'iradio_flat-green'
	      });
	    });
	  </script>
<?php 
foreach ($script_top as $script) {
	echo $script;
}
?>
<?php 
foreach ($html_body as $html) {
	echo $html;
}
foreach ($script_bottom as $script) {
	echo $script;
}
?>
<?php endif; ?>