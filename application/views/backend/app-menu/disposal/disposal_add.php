
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
        Disposal        <small>Disposal Baru</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('disposal'); ?>">Disposal</a></li>
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
                            <h3 class="widget-user-username">Disposal</h3>
                            <h5 class="widget-user-desc">Disposal Baru</h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_disposal', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_disposal', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="nomor_surat" class="col-sm-2 control-label">Nomor Surat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" placeholder="Nomor Surat" value="<?= set_value('nomor_surat'); ?>">
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
                                    <option value="<?= $row->nama_barang ?>"><?= $row->nama_barang; ?></option>
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
                                <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?= set_value('jumlah'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="berkas" class="col-sm-2 control-label">Berkas 
                            </label>
                            <div class="col-sm-8">
                                <div id="disposal_berkas_galery"></div>
                                <input class="data_file" name="disposal_berkas_uuid" id="disposal_berkas_uuid" type="hidden" value="<?= set_value('disposal_berkas_uuid'); ?>">
                                <input class="data_file" name="disposal_berkas_name" id="disposal_berkas_name" type="hidden" value="<?= set_value('disposal_berkas_name'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="deskripsi" class="col-sm-2 control-label">Deskripsi 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="deskripsi" name="deskripsi" rows="5" cols="80"><?= set_value('Deskripsi'); ?></textarea>
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
            title: "Batalkan pembuatan disposal?",
            text: "Data disposal yang akan dibuat akan terbuang.",
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
              window.location.href = BASE_URL + 'disposal';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#deskripsi').val(deskripsi.getData());
                    
        var form_disposal = $('#form_disposal');
        var data_post = form_disposal.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/disposal/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id_berkas = $('#disposal_berkas_galery').find('li').attr('qq-file-id');
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            if (typeof id_berkas !== 'undefined') {
                    $('#disposal_berkas_galery').fineUploader('deleteFile', id_berkas);
                }
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
            deskripsi.setData('');
                
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

       $('#disposal_berkas_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/disposal/upload_berkas_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/disposal/delete_berkas_file',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
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
                   var uuid = $('#disposal_berkas_galery').fineUploader('getUuid', id);
                   $('#disposal_berkas_uuid').val(uuid);
                   $('#disposal_berkas_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#disposal_berkas_uuid').val();
                  $.get(BASE_URL + '/disposal/delete_berkas_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#disposal_berkas_uuid').val('');
                  $('#disposal_berkas_name').val('');
                }
              }
          }
      }); /*end berkas galery*/
              
 
       
    
    
    }); /*end doc ready*/
</script>