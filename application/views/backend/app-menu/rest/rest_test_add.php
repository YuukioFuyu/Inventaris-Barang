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

<form class="form-horizontal form-add" name="form_rest" id="form_rest" enctype="multipart/form-data" action="<?= base_url('api/'.$rest->table_name.'/add'); ?>" method="POST" >

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
      <?php $i=0; foreach ($rest_field as $row):  $i++; 
      if ($row->input_type == 'timestamp') continue;
      ?>
      <tr>
         <td>
            <?= $i; ?>
         </td>
         <td>
            <?= $row->field_name; ?>   
         </td>
         <td>
            <div class="col-md-12">
               <div class="form-group ">
               <?php if ($row->input_type == 'input') {?>
               <input type="text" name="<?= $row->field_name; ?>" class='form-control'>
               <?php } elseif ($row->input_type == 'file') { ?>
               <label class="file-styling">
                  <div class="btn btn-flat btn-default col-md-4">Select file </div><span class="info-file"> No File Chosen</span>
                  <input type="file" name="<?= $row->field_name; ?>" >
               </label>

               <?php } ?>
             </div>
          </div>
       </td>
       <td>
         <?php if (isset($rest_field_validation[$row->id])): 
         foreach ($rest_field_validation[$row->id] as $rule) {
            ?>
            <div class="box-validation <?= str_replace(',', ' ', $rule->group_input).' '.$rule->validation_name; ?>"> 
             <label><?= clean_snake_case($rule->validation); ?> <?= $rule->input_able == 'yes' ? ':' : ''; ?>   <span class="text-red"> <?= $rule->validation_value; ?></span></div> 

             </div>
             <?php 
          }
          endif; ?>
       </td>
    </tr>
 <?php endforeach; ?>
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
        var formData = new FormData($(this)[0]);

        $('.loading').show();
        var submitButton = $(this).find('input[type=submit]');
        var defaultValue = submitButton.val();

        submitButton.val('Submitting');
        $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                dataType: 'JSON',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-Api-Key': $('#x_api_key').val(),
                    'X-Token': $('#x_token').val(),
                }
            })
            .always(function(response) {
                if (typeof response.responseJSON == 'undefined') {
                    $('.result-json').JSONView(response);
                    $('.status').html('200 OK');
                    $('.status').addClass('response-200');
                } else {
                    $('.result-json').JSONView(response.responseJSON);
                    $('.status').html(response.status + ' ' + response.statusText);
                    $('.status').addClass('response-' + response.status);
                }

                submitButton.val(defaultValue);
                $('html, body').animate({
                    scrollTop: $(document).height()
                }, 2000);
                $('.loading').hide();
            });

        return false;
    });
})
</script>