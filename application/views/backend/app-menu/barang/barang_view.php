
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
      Barang      <small>Detail Barang</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('barang'); ?>">Barang</a></li>
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
                     <h3 class="widget-user-username">Barang</h3>
                     <h5 class="widget-user-desc">Detail Barang</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_barang" id="form_barang" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Id Barang </label>

                        <div class="col-sm-8">
                           <?= _ent($barang->id_barang); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama Barang </label>

                        <div class="col-sm-8">
                           <?= _ent($barang->nama_barang); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Merek </label>

                        <div class="col-sm-8">
                           <?= _ent($barang->merek); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Kategori </label>

                        <div class="col-sm-8">
                           <?= _ent($barang->kategori); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Jumlah </label>

                        <div class="col-sm-8">
                           <?= _ent($barang->jumlah); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Satuan </label>

                        <div class="col-sm-8">
                           <?= _ent($barang->satuan); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label"> Gambar </label>
                        <div class="col-sm-8">
                             <?php if (is_image($barang->gambar)): ?>
                              <a class="fancybox" rel="group" href="<?= BASE_URL . 'uploads/barang/' . $barang->gambar; ?>">
                                <img src="<?= BASE_URL . 'uploads/barang/' . $barang->gambar; ?>" class="image-responsive" alt="image barang" title="gambar barang" width="40px">
                              </a>
                              <?php else: ?>
                              <label>
                                <a href="<?= BASE_URL . 'file/download/barang/' . $barang->gambar; ?>">
                                 <img src="<?= get_icon_file($barang->gambar); ?>" class="image-responsive" alt="image barang" title="gambar <?= $barang->gambar; ?>" width="40px"> 
                               <?= $barang->gambar ?>
                               </a>
                               </label>
                              <?php endif; ?>
                        </div>
                    </div>
                                       
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Keterangan </label>

                        <div class="col-sm-8">
                           <?= _ent($barang->keterangan); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('barang_update', function($option_barang) use ($barang){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="Edit barang (Ctrl+E)" href="<?= site_url('barang/edit/'.$barang->id_barang); ?>"><i class="fa fa-edit" ></i> Edit Barang</a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="Kembali (Ctrl+X)" href="<?= site_url('barang/'); ?>"><i class="fa fa-undo" ></i> Kembali ke Daftar</a>
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
