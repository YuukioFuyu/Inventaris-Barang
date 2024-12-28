
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
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
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Jenis Pengadaan        <small>Jenis Pengadaan Baru</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('jenis_pengadaan'); ?>">Jenis Pengadaan</a></li>
        <li class="active">Baru</li>
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
                            <h3 class="widget-user-username">Jenis Pengadaan</h3>
                            <h5 class="widget-user-desc">Jenis Pengadaan Baru</h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_jenis_pengadaan', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_jenis_pengadaan', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="jenis_pengadaan" class="col-sm-2 control-label">Jenis Pengadaan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jenis_pengadaan" id="jenis_pengadaan" placeholder="Jenis Pengadaan" value="<?= set_value('jenis_pengadaan'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="keterangan" class="col-sm-2 control-label">Keterangan 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="keterangan" name="keterangan" rows="5" cols="80"><?= set_value('Keterangan'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                            <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="Simpan (Ctrl+S)">
                            <i class="fa fa-save" ></i> Simpan
                            </button>
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="Simpan dan kembali ke daftar (Ctrl+D)">
                            <i class="ion ion-ios-list-outline" ></i> Simpan dan Kembali
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="Batal (Ctrl+X)">
                            <i class="fa fa-undo" ></i> Batal
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i>Tunggu, Sedang menyimpan data</i>
                            </span>
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
    $(document).ready(function(){
            CKEDITOR.replace('keterangan'); 
      var keterangan = CKEDITOR.instances.keterangan;
                   
      $('#btn_cancel').click(function(){
        swal({
            title: "Batalkan pembuatan jenis pengadaan?",
            text: "Data jenis pengadaan yang akan dibuat akan terbuang.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Batalkan",
            cancelButtonText: "Kembali",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'jenis_pengadaan';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#keterangan').val(keterangan.getData());
                    
        var form_jenis_pengadaan = $('#form_jenis_pengadaan');
        var data_post = form_jenis_pengadaan.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/jenis_pengadaan/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
            keterangan.setData('');
                
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Gagal menyimpan data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        });
    
        return false;
      }); /*end btn save*/
      
       
 
       
    
    
    }); /*end doc ready*/
</script>