
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+e', function assets() {
      $('#btn_edit').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
      $('#btn_back').trigger('click');
       return false;
   });
    
}


jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Penempatan      <small>Detail Penempatan</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('penempatan'); ?>">Penempatan</a></li>
      <li class="active">Detail</li>
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
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/view.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Penempatan</h3>
                     <h5 class="widget-user-desc">Detail Penempatan</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_penempatan" id="form_penempatan" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Id Penempatan </label>

                        <div class="col-sm-8">
                           <?= _ent($penempatan->id_penempatan); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama Barang </label>

                        <div class="col-sm-8">
                           <?= _ent($penempatan->nama_barang); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Departemen </label>

                        <div class="col-sm-8">
                           <?= _ent($penempatan->departemen); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Lokasi </label>

                        <div class="col-sm-8">
                           <?= _ent($penempatan->lokasi); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Jumlah </label>

                        <div class="col-sm-8">
                           <?= _ent($penempatan->jumlah); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Tanggal Penempatan </label>

                        <div class="col-sm-8">
                           <?= _ent($penempatan->tanggal_penempatan); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Keterangan </label>

                        <div class="col-sm-8">
                           <?= _ent($penempatan->keterangan); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('penempatan_update', function($option_penempatan) use ($penempatan){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="Edit penempatan (Ctrl+E)" href="<?= site_url('penempatan/edit/'.$penempatan->id_penempatan); ?>"><i class="fa fa-edit" ></i> Edit Penempatan</a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="Kembali (Ctrl+X)" href="<?= site_url('penempatan/'); ?>"><i class="fa fa-undo" ></i> Kembali ke Daftar</a>
                     </div>
                    
                  </div>
               </div>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
   </div>
</section>
<!-- /.content -->
