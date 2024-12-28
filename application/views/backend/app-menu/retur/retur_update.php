
<!-- Fine Uploader Gallery CSS file
    ====================================================================== -->
<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<?php $this->load->view('core_template/fine_upload'); ?>
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
        Retur        <small>Edit Retur</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('retur'); ?>">Retur</a></li>
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
                            <h3 class="widget-user-username">Retur</h3>
                            <h5 class="widget-user-desc">Edit Retur</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('retur/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_retur', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_retur', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="nomor_surat" class="col-sm-2 control-label">Nomor Surat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" placeholder="Nomor Surat" value="<?= set_value('nomor_surat', $retur->nomor_surat); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama_barang" class="col-sm-2 control-label">Nama Barang 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="nama_barang" id="nama_barang" data-placeholder="Pilih Nama Barang" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('barang') as $row): ?>
                                    <option <?=  $row->nama_barang ==  $retur->nama_barang ? 'selected' : ''; ?> value="<?= $row->nama_barang ?>"><?= $row->nama_barang; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="jumlah" class="col-sm-2 control-label">Jumlah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?= set_value('jumlah', $retur->jumlah); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="penerima_barang" class="col-sm-2 control-label">Penerima Barang 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="penerima_barang" id="penerima_barang" data-placeholder="PIlih Penerima Barang" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('departemen') as $row): ?>
                                    <option <?=  $row->nama_departemen ==  $retur->penerima_barang ? 'selected' : ''; ?> value="<?= $row->nama_departemen ?>"><?= $row->nama_departemen; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="berkas" class="col-sm-2 control-label">Berkas 
                            </label>
                            <div class="col-sm-8">
                                <div id="retur_berkas_galery"></div>
                                <input class="data_file data_file_uuid" name="retur_berkas_uuid" id="retur_berkas_uuid" type="hidden" value="<?= set_value('retur_berkas_uuid'); ?>">
                                <input class="data_file" name="retur_berkas_name" id="retur_berkas_name" type="hidden" value="<?= set_value('retur_berkas_name', $retur->berkas); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="deskripsi" class="col-sm-2 control-label">Deskripsi 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="deskripsi" name="deskripsi" rows="10" cols="80"> <?= set_value('deskripsi', $retur->deskripsi); ?></textarea>
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
      
      CKEDITOR.replace('deskripsi'); 
      var deskripsi = CKEDITOR.instances.deskripsi;
                   
      $('#btn_cancel').click(function(){
        swal({
            title: "Batalkan edit retur?",
            text: "Data retur yang akan diubah tidak akan disimpan.",
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
              window.location.href = BASE_URL + 'retur';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#deskripsi').val(deskripsi.getData());
                    
        var form_retur = $('#form_retur');
        var data_post = form_retur.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_retur.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#retur_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            $('.data_file_uuid').val('');
    
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
      
                     var params = {};
       params[csrf] = token;

       $('#retur_berkas_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/retur/upload_berkas_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/retur/delete_berkas_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'retur/get_berkas_file/<?= $retur->id_retur; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#retur_berkas_galery').fineUploader('getUuid', id);
                   $('#retur_berkas_uuid').val(uuid);
                   $('#retur_berkas_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#retur_berkas_uuid').val();
                  $.get(BASE_URL + '/retur/delete_berkas_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#retur_berkas_uuid').val('');
                  $('#retur_berkas_name').val('');
                }
              }
          }
      }); /*end berkas galey*/
              
       
           
    
    }); /*end doc ready*/
</script>