<!-- <script type="text/javascript">
	$(window).scroll(function(){
  		$('iframe').height( $('iframe').contents().outerHeight()-50 );
	});
</script>
 -->
<section class="">
        <iframe scrolling="no" src="<?= base_url('apidoc/index.html'); ?>" width="100%"  style="height:2000px; overflow: none; border:none"></iframe>
</section>
<script type="text/javascript">
  $(document).ready(function(){
    $('.web-body').addClass('sidebar-collapse');
  })
</script>