
<script src="<?= BASE_ASSET; ?>js/custom.js"></script>


<?= form_open('', [
    'name'    => 'form_form_pengajuan_pinjam_barang', 
    'class'   => 'form-horizontal form_form_pengajuan_pinjam_barang', 
    'id'      => 'form_form_pengajuan_pinjam_barang',
    'enctype' => 'multipart/form-data', 
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
            <option value="<?= $row->nik ?>"><?= $row->nik; ?></option>
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
            <option value="<?= $row->nama_lengkap ?>"><?= $row->nama_lengkap; ?></option>
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
        <input type="text" class="form-control" name="no_telp_hp" id="no_telp_hp" placeholder=""  >
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
            <option value="<?= $row->nama_barang ?>"><?= $row->nama_barang; ?></option>
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
            <option value="<?= $row->ruangan ?>"><?= $row->ruangan; ?></option>
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
        <textarea id="digunakan_untuk" name="digunakan_untuk" rows="5" cols="80" ></textarea>
        <small class="info help-block">
        </small>
    </div>
</div>
 
<div class="form-group ">
    <label for="jumlah" class="col-sm-2 control-label">Jumlah 
    <i class="required">*</i>
    </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder=""  >
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
      <input type="text" class="form-control pull-right datepicker" name="tanggal_kembali"  placeholder="" id="tanggal_kembali" >
    </div>
    <small class="info help-block">
    </small>
    </div>
</div>


<div class="row col-sm-12 message">
</div>
<div class="col-sm-2">
</div>
<div class="col-sm-8 padding-left-0">
    <button class="btn btn-flat btn-primary btn_save" id="btn_save" data-stype='stay'>
    Submit
    </button>
    <span class="loading loading-hide">
    <img src="http://localhost:80/pinjam/asset//img/loading-spin-primary.svg"> 
    <i>Loading, Submitting data</i>
    </span>
</div>
</form></div>


<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->
<script>
    $(document).ready(function(){
          $('.form-preview').submit(function(){
        return false;
     });

     $('input[type="checkbox"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
     });


    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#digunakan_untuk').val(digunakan_untuk.getData());
            
        var form_form_pengajuan_pinjam_barang = $('#form_form_pengajuan_pinjam_barang');
        var data_post = form_form_pengajuan_pinjam_barang.serializeArray();
        var save_type = $(this).attr('data-stype');
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + 'form/form_pengajuan_pinjam_barang/submit',
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
            digunakan_untuk.setData(''); 
                
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 1000);
        });
    
        return false;
      }); /*end btn save*/


      
      CKEDITOR.replace('digunakan_untuk'); 
      var digunakan_untuk = CKEDITOR.instances.digunakan_untuk;
             
           
    }); /*end doc ready*/
</script>