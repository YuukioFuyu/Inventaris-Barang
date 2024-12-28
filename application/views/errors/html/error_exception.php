<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>Pengecualian yang tidak tertangkap ditemukan</h4>

<p>Tipe: <?php echo get_class($exception); ?></p>
<p>Pesan: <?php echo $message; ?></p>
<p>Nama File: <?php echo $exception->getFile(); ?></p>
<p>Nomor Baris: <?php echo $exception->getLine(); ?></p>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

	<p>Backtrace:</p>
	<?php foreach ($exception->getTrace() as $error): ?>

		<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

			<p style="margin-left:10px">
			File: <?php echo $error['file']; ?><br />
			Nomor Baris: <?php echo $error['line']; ?><br />
			Fungsi: <?php echo $error['function']; ?>
			</p>
		<?php endif ?>

	<?php endforeach ?>

<?php endif ?>

</div>