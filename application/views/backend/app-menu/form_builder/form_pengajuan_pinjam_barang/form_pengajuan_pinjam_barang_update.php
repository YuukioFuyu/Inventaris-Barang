
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
        Pengajuan Pinjam Barang        <small>Edit Pengajuan Pinjam Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('form_pengajuan_pinjam_barang'); ?>">Pengajuan Pinjam Barang</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header ">
                            <div class="widget-user-image">
                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Pengajuan Pinjam Barang</h3>
                            <h5 class="widget-user-desc">Edit Pengajuan Pinjam Barang</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('form_pengajuan_pinjam_barang/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_form_pengajuan_pinjam_barang', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_form_pengajuan_pinjam_barang', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="nik_nidn_nim" class="col-sm-2 control-label">NIK/NIDN/NIM 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="nik_nidn_nim" id="nik_nidn_nim" data-placeholder="Select NIK/NIDN/NIM"  >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('karyawan') as $row): ?>
                                    <option <?=  $row->nik ==  $form_pengajuan_pinjam_barang->nik_nidn_nim ? 'selected' : ''; ?> value="<?= $row->nik ?>"><?= $row->nik; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="nama_peminjam" class="col-sm-2 control-label">Nama Peminjam 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="nama_peminjam" id="nama_peminjam" data-placeholder="Select Nama Peminjam"  >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('karyawan') as $row): ?>
                                    <option <?=  $row->nama_lengkap ==  $form_pengajuan_pinjam_barang->nama_peminjam ? 'selected' : ''; ?> value="<?= $row->nama_lengkap ?>"><?= $row->nama_lengkap; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="no_telp_hp" class="col-sm-2 control-label">No Telp / Hp 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_telp_hp" value="<?= set_value('no_telp_hp', $form_pengajuan_pinjam_barang->no_telp_hp); ?>" id="no_telp_hp" placeholder=""  >
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama_barang" class="col-sm-2 control-label">Nama Barang 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="nama_barang" id="nama_barang" data-placeholder="Select Nama Barang"  >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('barang') as $row): ?>
                                    <option <?=  $row->nama_barang ==  $form_pengajuan_pinjam_barang->nama_barang ? 'selected' : ''; ?> value="<?= $row->nama_barang ?>"><?= $row->nama_barang; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="dipakai_di" class="col-sm-2 control-label">Dipakai Di 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="dipakai_di" id="dipakai_di" data-placeholder="Select Dipakai Di"  >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('ruangan') as $row): ?>
                                    <option <?=  $row->ruangan ==  $form_pengajuan_pinjam_barang->dipakai_di ? 'selected' : ''; ?> value="<?= $row->ruangan ?>"><?= $row->ruangan; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="digunakan_untuk" class="col-sm-2 control-label">Digunakan Untuk 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="digunakan_untuk" name="digunakan_untuk" rows="5" cols="80" ><?= set_value('digunakan_untuk', $form_pengajuan_pinjam_barang->digunakan_untuk); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jumlah" class="col-sm-2 control-label">Jumlah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jumlah" value="<?= set_value('jumlah', $form_pengajuan_pinjam_barang->jumlah); ?>" id="jumlah" placeholder=""  >
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                         
                                                <div class="form-group ">
                            <label for="tanggal_kembali" class="col-sm-2 control-label">Tanggal Kembali 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" value="<?= set_value('tanggal_kembali', $form_pengajuan_pinjam_barang->tanggal_kembali); ?>"  name="tanggal_kembali"  placeholder="" id="tanggal_kembali" >
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                            <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="save (Ctrl+s)">
                            <i class="fa fa-save" ></i> Save
                            </button>
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="save and back to the list (Ctrl+d)">
                            <i class="ion ion-ios-list-outline" ></i> Save and Go to The List
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="cancel (Ctrl+x)">
                            <i class="fa fa-undo" ></i> Cancel
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i>Loading, Saving data</i>
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
      
      CKEDITOR.replace('digunakan_untuk'); 
      var digunakan_untuk = CKEDITOR.instances.digunakan_untuk;
             
      $('#btn_cancel').click(function(){
        swal({
            title: "Are you sure?",
            text: "the data that you have created will be in the exhaust!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            cancelButtonText: "No!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'form_pengajuan_pinjam_barang';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#digunakan_untuk').val(digunakan_untuk.getData());
            
        var form_form_pengajuan_pinjam_barang = $('#form_form_pengajuan_pinjam_barang');
        var data_post = form_form_pengajuan_pinjam_barang.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_form_pengajuan_pinjam_barang.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#form_pengajuan_pinjam_barang_image_galery').find('li').attr('qq-file-id');
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