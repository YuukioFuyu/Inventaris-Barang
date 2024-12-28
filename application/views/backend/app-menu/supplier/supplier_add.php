
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
        Supplier        <small>Supplier Baru</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('supplier'); ?>">Supplier</a></li>
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
                            <h3 class="widget-user-username">Supplier</h3>
                            <h5 class="widget-user-desc">Supplier Baru</h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_supplier', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_supplier', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="nama_supplier" class="col-sm-2 control-label">Nama Supplier 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" placeholder="Nama Supplier" value="<?= set_value('nama_supplier'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        
                                                 
                                                <div class="form-group ">
                            <label for="no_telp" class="col-sm-2 control-label">Nomor Telepon 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="no_telp" id="no_telp" placeholder="Nomor Telepon" value="<?= set_value('no_telp'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>                        
                                                 
                                                 
                                                <div class="form-group ">
                            <label for="alamat_lengkap" class="col-sm-2 control-label">Alamat Lengkap 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="alamat_lengkap" name="alamat_lengkap" rows="5" cols="80"><?= set_value('Alamat Lengkap'); ?></textarea>
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
            CKEDITOR.replace('alamat_lengkap'); 
      var alamat_lengkap = CKEDITOR.instances.alamat_lengkap;
                   
      $('#btn_cancel').click(function(){
        swal({
            title: "Batalkan pembuatan supplier?",
            text: "Data supplier yang akan dibuat akan terbuang.",
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
              window.location.href = BASE_URL + 'supplier';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#alamat_lengkap').val(alamat_lengkap.getData());
                    
        var form_supplier = $('#form_supplier');
        var data_post = form_supplier.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/supplier/add_save',
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
            alamat_lengkap.setData('');
                
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