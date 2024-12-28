
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
        Pengadaan        <small>Pengadaan Baru</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('pengadaan'); ?>">Pengadaan</a></li>
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
                            <h3 class="widget-user-username">Pengadaan</h3>
                            <h5 class="widget-user-desc">Pengadaan Baru</h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_pengadaan', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pengadaan', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>

                                                 
                                                <div class="form-group ">
                            <label for="jenis_pengadaan" class="col-sm-2 control-label">Jenis Pengadaan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="jenis_pengadaan" id="jenis_pengadaan" data-placeholder="Pilih Jenis Pengadaan" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('jenis_pengadaan') as $row): ?>
                                    <option value="<?= $row->jenis_pengadaan ?>"><?= $row->jenis_pengadaan; ?></option>
                                    <?php endforeach; ?>  
                                </select>
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
                            <label for="supplier" class="col-sm-2 control-label">Supplier 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="supplier" id="supplier" data-placeholder="Pilih Supplier" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('supplier') as $row): ?>
                                    <option value="<?= $row->nama_supplier ?>"><?= $row->nama_supplier; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="harga" class="col-sm-2 control-label">Harga 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?= set_value('harga'); ?>">
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
                            <label for="tanggal_pengadaan" class="col-sm-2 control-label">Tanggal Pengadaan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="tanggal_pengadaan"  placeholder="Tanggal Pengadaan" id="tanggal_pengadaan">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="deskripsi_barang" class="col-sm-2 control-label">Deskripsi Barang 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="deskripsi_barang" name="deskripsi_barang" rows="5" cols="80"><?= set_value('Deskripsi Barang'); ?></textarea>
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
            CKEDITOR.replace('deskripsi_barang'); 
      var deskripsi_barang = CKEDITOR.instances.deskripsi_barang;
                   
      $('#btn_cancel').click(function(){
        swal({
            title: "Batalkan pembuatan pengadaan?",
            text: "Data pengadaan yang akan dibuat akan terbuang.",
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
              window.location.href = BASE_URL + 'pengadaan';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#keterangan').val(keterangan.getData());
                $('#deskripsi_barang').val(deskripsi_barang.getData());
                    
        var form_pengadaan = $('#form_pengadaan');
        var data_post = form_pengadaan.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/pengadaan/add_save',
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
            deskripsi_barang.setData('');
                
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