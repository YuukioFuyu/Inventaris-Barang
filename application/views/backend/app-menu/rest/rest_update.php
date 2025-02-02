<link rel="stylesheet" type="text/css" href="<?= BASE_ASSET; ?>css/rest.css">
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script src="<?= BASE_ASSET; ?>/float-thead/jquery.floatThead.min.js"></script>
<script type="text/javascript">
   //This page is a result of an autogenerated content made by running test.html with firefox.
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
      Rest
      <small>New Rest</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('rest'); ?>">Rest</a></li>
      <li class="active">New</li>
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
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="Rest Avatar">
                     </div>
                     <!-- /.widget-rest-image -->
                     <h3 class="widget-user-username">Rest</h3>
                     <h5 class="widget-user-desc">New Rest</h5>
                     <hr>
                  </div>
                  <?= form_open('', [
                     'name'    => 'form_rest', 
                     'class'   => 'form-horizontal', 
                     'id'      => 'form_rest', 
                     'method'  => 'POST'
                     ]); ?>

                  <input type="hidden"  name="table_name" id="table_name"  value="<?= $rest->table_name; ?>">
                  <input type="hidden" class="primary_key" name="primary_key"  id="primary_key" value="<?= $rest->primary_key; ?>" >

                  <div class="form-group ">
                     <label for="label" class="col-sm-2 control-label">Table name </label>
                     <div class="col-sm-8">
                        <input type="text" readonly="" class="form-control" value="<?= $rest->table_name; ?>">
                     </div>
                  </div>
                  <div class="form-group ">
                     <label for="label" class="col-sm-2 control-label">Subject <i class="required">*</i></label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" value="<?= set_value('subject', $rest->subject); ?>">
                        <small class="info help-block">The subject of rest.</small>
                     </div>
                  </div>

                  <div class="form-group ">
                     <label for="label" class="col-sm-2 control-label">Header Required</label>
                     <div class="col-sm-8">
                        <div class="col-md-2 padding-left-0">
                          <label>
                            <input class="flat-red check page_read" type="checkbox" id="x_token" value="yes" name="x_token" <?= $rest->x_token == 'yes' ? 'checked': ''; ?>> X-Token 
                          </label>
                        </div>
                     </div>
                  </div>

                  <hr>
                  <div class="wrapper-rest">
                     <table class="table table-responsive table table-bordered table-striped"  id="diagnosis_list">
                        <thead>
                           <tr>
                              <th width="20" rowspan="2" valign="midle" style="vertical-align: middle; text-align: center;">No</th>
                              <th width="120" rowspan="2" valign="midle" style="vertical-align: middle; text-align: center;">Field</th>
                              <th width="80" colspan="4" style="text-align: center;">Show in</th>
                              <th width="100" rowspan="2" valign="midle" style="vertical-align: middle; text-align: center;">Input Type</th>
                              <th width="200" rowspan="2" valign="midle" style="vertical-align: middle; text-align: center;">Validation</th>
                           </tr>
                           <tr>
                              <th width="60" class="module-page-list column" style="vertical-align: middle; text-align: center;">All <i><b>GET</b></i></th>
                              <th width="60" class="module-page-add add_form" style="vertical-align: middle; text-align: center;">Add <i><b>POST</b></i></th>
                              <th width="60" class="module-page-update update_form" style="vertical-align: middle; text-align: center;">Update <i><b>POST</b></i></th>
                              <th width="60" class="detail_page" style="vertical-align: middle; text-align: center;">Detail <i><b>GET</b></i></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $i=0; foreach ($rest_field as $row):  $i++; 
                           ?>
                           <tr>
                              <td  >
                                 <?= $i; ?>
                                 <input type="hidden" name="rest[<?=$i; ?>][<?=$row->field_name; ?>][sort]" class="priority" value="<?= $i; ?>" >
                                 <?php if ($rest->primary_key == 1) { ?>
                                 <input type="hidden" name="primary_key" value="<?= $rest->primary_key == 1? $row->field_name : ''; ?>" >
                                 <?php } ?>
                                 <input type="hidden" class="rest-id" id="rest-id" value="<?= $i; ?>" >
                                 <input type="hidden" class="rest-name" id="rest-name" value="<?= $row->field_name; ?>" >
                              </td>
                              <td>
                                 <?= $row->field_name; ?>   
                              </td>
                              <td class="column">
                                 <input class="flat-red check" type="checkbox" <?= $row->show_column == 'yes' ? 'checked' : ''; ?> name="rest[<?=$i; ?>][<?=$row->field_name; ?>][show_in_column]" value="yes">
                              </td>
                              <td class="add_form">
                                 <input class="flat-red check" type="checkbox" <?= $row->show_add_api == 'yes' ? 'checked' : ''; ?> name="rest[<?=$i; ?>][<?=$row->field_name; ?>][show_in_add_form]" value="yes">
                              </td>
                              <td class="update_form">
                                 <input class="flat-red check" type="checkbox" <?= $row->show_update_api == 'yes' ? 'checked' : ''; ?> name="rest[<?=$i; ?>][<?=$row->field_name; ?>][show_in_update_form]" value="yes">
                              </td>
                              <td class="detail_page">
                                 <input class="flat-red check" type="checkbox" <?= $row->show_detail_api == 'yes' ? 'checked' : ''; ?> name="rest[<?=$i; ?>][<?=$row->field_name; ?>][show_in_detail_page]" value="yes">
                              </td>
                              <td>
                                 <div class="col-md-12">
                                    <div class="form-group ">
                                       <select  class="form-control chosen chosen-select input_type" name="rest[<?=$i; ?>][<?=$row->field_name; ?>][input_type]" id="input_type" tabi-ndex="5" data-placeholder="Select Type" >
                                          <option value="" class="<?= $this->model_rest->get_input_type(); ?>"></option>
                                          <?php foreach (db_get_all_data('rest_input_type') as $input): 
                                          ?>
                                          <option  value="<?= $input->type; ?>" class="<?= $input->type; ?>" title="<?= $input->validation_group; ?>" relation="<?= $input->relation; ?>" <?= $input->type == $row->input_type ? 'selected="selected"' : ''; ?> ><?= ucwords(clean_snake_case($input->type)); ?></option>
                                          <?php endforeach; ?>
                                       </select>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <div class="col-md-12">
                                    <div class="form-group ">
                                       <select  class="form-control chosen chosen-select validation" name="rest[<?=$i; ?>][<?=$row->field_name; ?>][validation]" id="validation" tabi-ndex="5" data-placeholder="+ Add Rules">
                                           <option value="" class="input file number text datetime select"></option>
                                           <?php 
                                           foreach (db_get_all_data('crud_input_validation') as $input): 
                                           ?>
                                             <option value="<?= $input->validation; ?>" class="<?= str_replace(',', ' ', $input->group_input); ?>" data-group-validation="<?= str_replace(',', ' ', $input->group_input); ?>" data-placeholder="<?= $input->input_placeholder; ?>" title="<?= $input->input_able; ?>"><?= ucwords(clean_snake_case($input->validation)); ?></option>
                                            <?php endforeach; ?> 
                                       </select>
                                    </div>
                                 </div>
                                 <?php if (isset($rest_field_validation[$row->id])): 
                                 foreach ($rest_field_validation[$row->id] as $rule) {
                                 ?>
                                 <div class="box-validation <?= str_replace(',', ' ', $rule->group_input).' '.$rule->validation_name; ?>"> 
                                   <label><div class="validation-name<?= $rule->input_able == 'yes' ? '' : '-max'; ?>"><?= clean_snake_case($rule->validation); ?></div> 
                                   <input class="input_validation" name="rest[<?=$i; ?>][<?= $row->field_name; ?>][validation][rules][<?= $rule->validation; ?>]" type="<?= $rule->input_able == 'yes' ? 'text' : 'hidden'; ?>" value="<?= $rule->validation_value; ?>"></label> <a class="delete fa fa-trash"></a> 
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
                  <div class="validation_rules" style="display: none">
                     <option value="" class="<?= $this->model_rest->get_input_type(); ?>"></option>
                     <?php foreach (db_get_all_data('crud_input_validation') as $input): ?>
                       <option value="<?= $input->validation; ?>" class="<?= str_replace(',', ' ', $input->group_input); ?>" title="<?= $input->input_able; ?>" data-placeholder="<?= $input->input_placeholder; ?>" ><?= ucwords(clean_snake_case($input->validation)); ?></option>
                      <?php endforeach; ?> 
                  </div>
                  <div class="message no-message-padding">
                  </div>
                  <div class="view-nav">
                     <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="save (Ctrl+s)"><i class="fa fa-save" ></i> Save</button>
                     <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="save and back to the list (Ctrl+d)"><i class="ion ion-ios-list-outline" ></i> Save and Go to The List</a>
                     <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="cancel (Ctrl+x)"><i class="fa fa-undo" ></i> Cancel</a>
                     <span class="loading loading-hide"><img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> <i>Loading, Saving data</i></span>
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
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<script src="<?= BASE_ASSET; ?>js/rest.js"></script>
<!-- Page script -->
<script>
$(document).ready(function() {
    /*update validation*/
    $(document).find('table tr .input_type').each(function() {
        updateValidation($(this));
    });

    $('.btn_save').click(function() {
        $('.message').hide();

        var form_rest = $('#form_rest');
        var data_post = form_rest.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({
            name: 'save_type',
            value: save_type
        });

        $('.loading').show();

        $.ajax({
                url: BASE_URL + '/rest/edit_save/' + <?= $rest->id; ?> ,
                type: 'POST',
                dataType: 'json',
                data: data_post,
            })
            .done(function(res) {
                if (res.success) {
                    if (save_type == 'back') {
                        window.location.href = res.redirect;
                        return;
                    }

                    $('.message').printMessage({
                        message: res.message
                    });
                    $('.message').fadeIn();

                } else {
                    $('.message').printMessage({
                        message: res.message,
                        type: 'warning'
                    });
                    $('.message').fadeIn();
                }

            })
            .fail(function() {
                $('.message').printMessage({
                    message: 'Gagal menyimpan data',
                    type: 'warning'
                });
            })
            .always(function() {
                $('.loading').hide();
                $('html, body').animate({
                    scrollTop: $(document).height()
                }, 3000);
            });

        return false;
    }); /*end btn save*/

    $('#table_name').on('change', function() {
        var table = $(this).val();
        $('.loading2').show();
        $.ajax({
                url: BASE_URL + '/rest/get_field_data/' + table,
                type: 'GET',
                dataType: 'JSON',
            })
            .done(function(res) {
                if (res.success) {
                    $('#subject, #title').val(res.subject);
                    $('.wrapper-rest').html(res.html);
                    var config = {
                        '.chosen-select': {},
                        '.chosen-select-deselect': {
                            allow_single_deselect: true
                        },
                        '.chosen-select-no-single': {
                            disable_search_threshold: 10
                        },
                        '.chosen-select-no-results': {
                            no_results_text: 'Oops, nothing found!'
                        },
                        '.chosen-select-width': {
                            width: "95%"
                        }
                    }
                    for (var selector in config) {
                        $(document).find(selector).chosen(config[selector]);
                    }

                    //check all
                    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                        checkboxClass: 'icheckbox_flat-green',
                        radioClass: 'iradio_flat-green'
                    });

                    /*update validation*/
                    $(document).find('table tr .input_type').each(function() {
                        updateValidation($(this));
                    });


                    /*added devfault validation rules*/
                    $(document).find('table tr .validation').each(function() {

                        var parent = $(this).parents('tr');
                        var id = parent.find('#rest-id').val();
                        var name = parent.find('#rest-name').val();
                        var data_type = parent.find('#rest-data-type').val();
                        var primarykey = parent.find('#rest-primarykey').val();
                        var max_length = parent.find('#rest-max-length').val();

                        if (primarykey != 1) {
                            addValidation($(this), id, name, 'required', 'no');

                            if (max_length != 0) {
                                addValidation($(this), id, name, 'max_length', 'yes', max_length);
                            }
                        }

                        if (data_type == 'number') {
                            addValidation($(this), id, name, 'number', 'no');
                        }

                    });

                } /*end response success*/

            })
            .fail(function() {
                $('.message').printMessage({
                    message: 'Error getting data',
                    type: 'warning'
                });
            })
            .always(function() {
                $('.loading2').hide();
            });
    });
}); /*end doc ready*/
</script>