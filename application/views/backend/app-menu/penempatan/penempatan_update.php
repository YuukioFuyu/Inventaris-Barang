
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
        Penempatan        <small>Edit Penempatan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('penempatan'); ?>">Penempatan</a></li>
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
                            <h3 class="widget-user-username">Penempatan</h3>
                            <h5 class="widget-user-desc">Edit Penempatan</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('penempatan/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_penempatan', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_penempatan', 
                            'method'  => 'POST'
                            ]); ?>
                         
                        
                                                <div class="form-group ">
                            <label for="nama_barang" class="col-sm-2 control-label">Nama Barang 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="nama_barang" id="nama_barang" data-placeholder="Pilih Nama Barang" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('barang') as $row): ?>
                                    <option <?=  $row->nama_barang ==  $penempatan->nama_barang ? 'selected' : ''; ?> value="<?= $row->nama_barang ?>"><?= $row->nama_barang; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                       
                                                 
                                                <div class="form-group ">
                            <label for="departemen" class="col-sm-2 control-label">Departemen 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="departemen" id="departemen" data-placeholder="Pilih Departemen" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('departemen') as $row): ?>
                                    <option <?=  $row->nama_departemen ==  $penempatan->departemen ? 'selected' : ''; ?> value="<?= $row->nama_departemen ?>"><?= $row->nama_departemen; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="lokasi" class="col-sm-2 control-label">Lokasi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="lokasi" id="lokasi" data-placeholder="Pilih Lokasi" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('lokasi') as $row): ?>
                                    <option <?=  $row->nama_lokasi ==  $penempatan->lokasi ? 'selected' : ''; ?> value="<?= $row->nama_lokasi ?>"><?= $row->nama_lokasi; ?></option>
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
                                <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?= set_value('jumlah', $penempatan->jumlah); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        
                        
                                                <div class="form-group ">
                            <label for="tanggal_penempatan" class="col-sm-2 control-label">Tanggal Penempatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="tanggal_penempatan"  placeholder="Tanggal Penempatan" id="tanggal_penempatan" value="<?= set_value('penempatan_tanggal_penempatan_name', $penempatan->tanggal_penempatan); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="keterangan" class="col-sm-2 control-label">Keterangan 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="keterangan" name="keterangan" rows="10" cols="80"> <?= set_value('keterangan', $penempatan->keterangan); ?></textarea>
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
            title: "Batalkan edit penempatan?",
            text: "Data penempatan yang akan diubah tidak akan disimpan.",
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
              window.location.href = BASE_URL + 'penempatan';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#keterangan').val(keterangan.getData());
                    
        var form_penempatan = $('#form_penempatan');
        var data_post = form_penempatan.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_penempatan.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#penempatan_image_galery').find('li').attr('qq-file-id');
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
      
       
       
           
    
    }); /*end doc ready*/
</script>