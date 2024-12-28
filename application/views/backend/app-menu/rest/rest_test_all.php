<style type="text/css">
   .file-styling input[type=file] {
      opacity: 0;
   }
   .file-styling .info-file {
      padding:10px;
      padding-top: 20px;
      margin-top: 20px;
   }
</style>
<link rel="stylesheet" href="<?= BASE_ASSET; ?>/json-view/jquery.jsonview.css" />
<script type="text/javascript" src="<?= BASE_ASSET; ?>/json-view/jquery.jsonview.js"></script>

<form class="form-horizontal form-add" name="form_rest" id="form_rest" enctype="multipart/form-data" action="<?= base_url('api/'.$rest->table_name.'/all'); ?>" method="GET" >

 <table class="table table-responsive table table-bordered table-striped"  id="diagnosis_list">
   <thead>
      <tr>
         <th width="25%" rowspan="2" valign="midle">HEADER</th>
         <th width="120" rowspan="2" valign="midle">Value</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td>X-Api-Key</td>
         <td>
            <div class="col-md-6 padding-left-0">
               <input type="text" id="x_api_key" name="X-Api-Key" class='form-control'>
            </div>
         </td>
      </tr>
      <?php if ($rest->x_token == 'yes'): ?> 
         <tr>
            <td>X-Token</td>
            <td>
               <div class="col-md-6 padding-left-0">
                  <input type="text" id="x_token" name="X-Token" class='form-control'>
               </div>
            </td>
         </tr>
      <?php endif; ?>
   </tbody>

   <table class="table table-responsive table table-bordered table-striped"  id="diagnosis_list">
      <thead>
         <tr>
            <th width="5%" rowspan="2" valign="midle">No</th>
            <th width="20%" rowspan="2" valign="midle">Field</th>
            <th width="200" rowspan="2" valign="midle">Value</th>
            <th width="200" rowspan="2" valign="midle">Validation</th>
         </tr>
      </thead>
      <tbody>
      
      <tr>
         <td>
            1
         </td>
         <td>
            Filter 
         </td>
         <td>
            <div class="col-md-12">
               <div class="form-group ">
                  <input type="text" name="filter" class='form-control'>
               </div>
            </div>
         </td>
         <td></td>
      </tr>
      <tr>
         <td>
            2
         </td>
         <td>
            Field
         </td>
         <td>
            <div class="col-md-12">
               <div class="form-group ">
                  <input type="text" name="field" class='form-control'>
               </div>
            </div>
         </td>
         <td></td>
      </tr>
      <tr>
         <td>
            3
         </td>
         <td>
            Start
         </td>
         <td>
            <div class="col-md-12">
               <div class="form-group ">
                  <input type="text" name="start" class='form-control'>
               </div>
            </div>
         </td>
         <td></td>
      </tr>
      <tr>
         <td>
            4
         </td>
         <td>
            Limit
         </td>
         <td>
            <div class="col-md-12">
               <div class="form-group ">
                  <input type="text" name="limit" class='form-control'>
               </div>
            </div>
         </td>
         <td></td>
      </tr>
     </tbody>
  </table>
</div>

<div class="row">
   <div class="col-md-12">
      <div class="col-xs-3 padding-left-0"><b>Response</b></div>
      <div class="col-xs-4"><b>Status : </b><span class="status text-blue"></span></div>
      <div class="col-xs-5 padding-right-0">
         <input type="submit" value="Send" class="btn btn-lg btn-primary btn-flat pull-right">
         <span class="loading loading-hide pull-right padding-10"><img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> <i>Loading, Submitting Data</i></span>
      </div>
   </div>
</div>
</form>

<div class="result-json">
</div>

<script type="text/javascript">
   $(document).ready(function() {
     var fileInput = $('.file-styling :file');

     fileInput.change(function() {
         $this = $(this);
         $(this).parent().find('.info-file').text($this.val());
     });

     var form = $('.form-add');

     form.submit(function() {
         $('.loading').show();
         var submitButton = $(this).find('input[type=submit]');
         var defaultValue = submitButton.val();

         submitButton.val('Submitting');
         $.ajax({
                 url: form.attr('action'),
                 type: form.attr('method'),
                 dataType: 'JSON',
                 data: form.serialize(),
                 headers: {
                     'X-Api-Key': $('#x_api_key').val(),
                     'X-Token': $('#x_token').val(),
                 }
             })
             .fail(function(response) {
                 toastr['error']('Error API Request');
             })
             .always(function(response, status, xhr) {
                 $('.loading').hide();
                 submitButton.val(defaultValue);
                 var responseReff = response;

                 if (typeof xhr == 'object') {
                     responseReff = xhr;
                 }

                 if (typeof responseReff.statusText == 'undefined') {
                     responseReff.statusText = 'OK';
                 }

                 $('.status').html(responseReff.status + ' ' + responseReff.statusText);
                 $('.result-json').JSONView(responseReff.responseJSON);
                 $('.status').addClass('response-' + responseReff.status);

                 $('html, body').animate({
                     scrollTop: $(document).height()
                 }, 2000);
             });

         return false;
     });
 })
</script>