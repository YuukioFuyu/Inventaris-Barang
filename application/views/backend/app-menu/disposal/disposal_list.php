
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/Disposal/add';
       return false;
   });

   $('*').bind('keydown', 'Ctrl+f', function assets() {
       $('#sbtn').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
       $('#reset').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+b', function assets() {

       $('#reset').trigger('click');
       return false;
   });
}

jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Disposal<small>Daftar Semua</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Disposal</li>
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
                     <div class="row pull-right">
                        <?php is_allowed('disposal_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="Tambah Disposal baru (Ctrl+A)" href="<?=  site_url('disposal/add'); ?>"><i class="fa fa-plus-square-o" ></i> Tambah Disposal Baru</a>
                        <?php }) ?>
                        <?php is_allowed('disposal_export', function(){?>
                        <a class="btn btn-flat btn-success" title="Export Disposal dalam format XLS" href="<?= site_url('disposal/export'); ?>"><i class="fa fa-file-excel-o" ></i> Export XLS</a>
                        <?php }) ?>
                        <?php is_allowed('disposal_export', function(){?>
                        <a class="btn btn-flat btn-success" title="Export Disposal dalam format PDF" href="<?= site_url('disposal/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> Export PDF</a>
                        <?php }) ?>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Disposal</h3>
                     <h5 class="widget-user-desc">Daftar Semua Disposal</h5>
                     <h5 class="widget-user-desc">Total : <i class="label bg-blue"><?= $disposal_counts; ?>  Disposal</i></h5>
                  </div>

                  <form name="form_disposal" id="form_disposal" action="<?= base_url('disposal/index'); ?>">
                  

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
                           <th>Nomor Surat</th>
                           <th>Nama Barang</th>
                           <th>Jumlah</th>
                           <th>Berkas</th>
                           <th>Deskripsi</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_disposal">
                     <?php foreach($disposals as $disposal): ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $disposal->id_disposal; ?>">
                           </td>
                           
                           <td><?= _ent($disposal->nomor_surat); ?></td> 
                           <td><?= _ent($disposal->nama_barang); ?></td> 
                           <td><?= _ent($disposal->jumlah); ?></td> 
                           <td>
                              <?php if (!empty($disposal->berkas)): ?>
                                <?php if (is_image($disposal->berkas)): ?>
                                <a class="fancybox" rel="group" href="<?= BASE_URL . 'uploads/disposal/' . $disposal->berkas; ?>">
                                  <img src="<?= BASE_URL . 'uploads/disposal/' . $disposal->berkas; ?>" class="image-responsive" alt="image disposal" title="berkas disposal" width="40px">
                                </a>
                                <?php else: ?>
                                  <a href="<?= BASE_URL . 'file/download/disposal/' . $disposal->berkas; ?>">
                                   <img src="<?= get_icon_file($disposal->berkas); ?>" class="image-responsive image-icon" alt="image disposal" title="berkas <?= $disposal->berkas; ?>" width="40px"> 
                                 </a>
                                <?php endif; ?>
                              <?php endif; ?>
                           </td>
                            
                           <td><?= _ent($disposal->deskripsi); ?></td> 
                           <td width="200">
                              <?php is_allowed('disposal_view', function($option_disposal) use ($disposal){?>
                              <a href="<?= site_url('disposal/view/' . $disposal->id_disposal); ?>" class="label-default"><i class="fa fa-newspaper-o"></i> Lihat
                              <?php }) ?>
                              <?php is_allowed('disposal_update', function($option_disposal) use ($disposal){?>
                              <a href="<?= site_url('disposal/edit/' . $disposal->id_disposal); ?>" class="label-default"><i class="fa fa-edit "></i> Edit</a>
                              <?php }) ?>
                              <?php is_allowed('disposal_delete', function($option_disposal) use ($disposal){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('disposal/delete/' . $disposal->id_disposal); ?>" class="label-default remove-data"><i class="fa fa-close"></i> Hapus</a>
                               <?php }) ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($disposal_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                           Data disposal tidak tersedia :(
                           </td>
                         </tr>
                      <?php endif; ?>
                     </tbody>
                  </table>
                  </div>
               </div>
               <hr>
               <!-- /.widget-user -->
               <div class="row">
                  <div class="col-md-8">
                     <div class="col-sm-2 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="bulk" id="bulk" placeholder="Site Email" >
                           <option value="" selected="true" disabled>Aksi Cepat</option>
                           <option value="delete">Hapus</option>
                        </select>
                     </div>
                     <div class="col-sm-2 padd-left-0 ">
                        <button type="button" class="btn btn-flat" name="apply" id="apply" title="Terapkan aksi">Terapkan</button>
                     </div>
                     <div class="col-sm-3 padd-left-0  " >
                        <input type="text" class="form-control" name="q" id="filter" placeholder="Filter" value="<?= $this->input->get('q'); ?>">
                     </div>
                     <div class="col-sm-3 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                           <option value="">Semua</option>
                            <option <?= $this->input->get('f') == 'nomor_surat' ? 'selected' :''; ?> value="nomor_surat">Nomor Surat</option>
                           <option <?= $this->input->get('f') == 'nama_barang' ? 'selected' :''; ?> value="nama_barang">Nama Barang</option>
                           <option <?= $this->input->get('f') == 'jumlah' ? 'selected' :''; ?> value="jumlah">Jumlah</option>
                           <option <?= $this->input->get('f') == 'berkas' ? 'selected' :''; ?> value="berkas">Berkas</option>
                           <option <?= $this->input->get('f') == 'deskripsi' ? 'selected' :''; ?> value="deskripsi">Deskripsi</option>
                          </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="filter pencarian">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('disposal');?>" title="reset filter">
                        <i class="fa fa-undo"></i>
                        </a>
                     </div>
                  </div>
                  </form>                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                        <?= $pagination; ?>
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

<!-- Page script -->
<script>
  $(document).ready(function(){
   
    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "Hapus disposal ini?",
          text: "Data disposal yang sudah dihapus, tidak dapat dikembalikan lagi!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Hapus",
          cancelButtonText: "Batal",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            document.location.href = url;            
          }
        });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_disposal').serialize();

      if (bulk.val() == 'delete') {
         swal({
            title: "Hapus disposal yang dipilih?",
            text: "Data disposal yang sudah dihapus, tidak dapat dikembalikan lagi!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Konfirmasi, Hapus",
            cancelButtonText: "Batalkan",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
               document.location.href = BASE_URL + '/disposal/delete?' + serialize_bulk;      
            }
          });

        return false;

      } else if(bulk.val() == '')  {
          swal({
            title: "Upss",
            text: "Pilih aksi yang diinginkan terlebih dahulu!",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#5595DD",
            confirmButtonText: "Oke",
            closeOnConfirm: true,
            closeOnCancel: true
          });

        return false;
      }

      return false;

    });/*end appliy click*/


    //check all
    var checkAll = $('#check_all');
    var checkboxes = $('input.check');

    checkAll.on('ifChecked ifUnchecked', function(event) {   
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });

  }); /*end doc ready*/
</script>