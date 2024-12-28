<!-- Fine Uploader Gallery CSS file
   ====================================================================== -->
<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-new.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
   ====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
   //This page is a result of an autogenerated content made by running test.html with firefox.
   function domo(){
    
      // Binding keys
      $('*').bind('keydown', 'Ctrl+s', function assets() {
         $('#btn_save').trigger('click');
          return false;
      });
   
      $('*').bind('keydown', 'Ctrl+x', function assets() {
         $('#btn_cancel').trigger('click');
          return false;
      });
   
     $('*').bind('keydown', 'Ctrl+d', function assets() {
         $('.btn_save_back').trigger('click');
          return false;
      });
       
   }
   
   jQuery(document).ready(domo);
</script>
<?php $this->load->view('core_template/fine_upload'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Grup
      <small>Edit Grup</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('group'); ?>">Grup</a></li>
      <li class="active">Edit</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row" >
      <div class="col-md-12">
         <div class="box box-primary">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header ">
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Grup</h3>
                     <h5 class="widget-user-desc">Edit Grup</h5>
                     <hr>
                  </div>
                  <?= form_open(base_url('group/edit_save/'.$this->uri->segment(3)), [
                    'name'    => 'form_group', 
                    'class'   => 'form-horizontal', 
                    'id'      => 'form_group', 
                    'enctype' => 'multipart/form-data', 
                    'method'  => 'POST'
                  ]); ?>

                     <div class="form-group ">
                        <label for="name" class="col-sm-2 control-label">Nama <i class="required">*</i></label>
                        <div class="col-sm-8">
                           <input type="text" class="form-control" name="name" id="name" placeholder="Nama" value="<?= set_value('name', $group->name); ?>">
                           <small class="info help-block">Masukkan nama grup!</small>
                        </div>
                     </div>
                      <div class="form-group ">
                        <label for="definition" class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-8">
                           <input type="text" class="form-control" name="definition" id="definition" placeholder="Keterangan" value="<?= set_value('definition', $group->definition); ?>">
                           <small class="info help-block">Masukkan keterangan grup!</small>
                        </div>
                     </div>
                     <div class="message">
                     </div>
                     <div class="row-fluid col-md-7">
                        <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="Simpan (Ctrl+S)"><i class="fa fa-save" ></i> Simpan</button>
                        <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="Simpan dan kembali ke daftar (Ctrl+D)"><i class="ion ion-ios-list-outline" ></i> Simpan dan Kembali</a>
                        <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="Batal (Ctrl+X)"><i class="fa fa-undo" ></i> Batal</a>
                        <span class="loading loading-hide"><img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> <i>Tunggu, Sedang menyimpan data</i></span>
                     </div>
                  <?= form_close(); ?>
               </div>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->
      </div>
   </div>
</section>
<!-- /.content -->
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->

<script>
   $(document).ready(function() {
     $('#btn_cancel').click(function() {
         swal({
                 title: "Batalkan edit grup?",
                 text: "Data grup yang akan diubah tidak akan disimpan.",
                 type: "warning",
                 showCancelButton: true,
                 confirmButtonColor: "#DD6B55",
                 confirmButtonText: "Batalkan",
                 cancelButtonText: "Kembali",
                 closeOnConfirm: true,
                 closeOnCancel: true
             },
             function(isConfirm) {
                 if (isConfirm) {
                     window.location.href = BASE_URL + 'group';
                 }
             });

         return false;
     }); /*end btn cancel*/

     $('.btn_save').click(function() {
         $('.message').fadeOut();

         var form_group = $('#form_group');
         var data_post = form_group.serializeArray();
         var save_type = $(this).attr('data-stype');

         data_post.push({
             name: 'save_type',
             value: save_type
         });

         $('.loading').show();

         $.ajax({
                 url: form_group.attr('action'),
                 type: 'POST',
                 dataType: 'json',
                 data: data_post,
             })
             .done(function(res) {
                 if (res.success) {
                     if (save_type == 'back') {
                         window.location.href = res.redirect;
                         return;
                     }

                     $('.message').printMessage({
                         message: res.message
                     });
                     $('.message').fadeIn();

                 } else {
                     $('.message').printMessage({
                         message: res.message,
                         type: 'warning'
                     });
                     $('.message').fadeIn();
                 }

             })
             .fail(function() {
                 $('.message').printMessage({
                     message: 'Gagal menyimpan data',
                     type: 'warning'
                 });
             })
             .always(function() {
                 $('.loading').hide();
                 $('html, body').animate({
                     scrollTop: $(document).height()
                 }, 1000);
             });

         return false;
     }); /*end btn save*/

 }); /*end doc ready*/
</script>
