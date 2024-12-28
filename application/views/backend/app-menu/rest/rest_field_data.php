
 <div class="table-wrapper">
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
      <?php $i=0; foreach ($this->db->field_data($table) as $row):  $i++; ?>
      <tr>
         <td  >
            <?= $i; ?>
            <input type="hidden" name="rest[<?=$i; ?>][<?=$row->name; ?>][sort]" class="priority" value="<?= $i; ?>" >
            <?php if ($row->primary_key == 1) { ?>
            <input type="hidden" name="primary_key" value="<?= $row->primary_key == 1? $row->name : ''; ?>" >
            <?php } ?>
            <input type="hidden" class="rest-id" id="rest-id" value="<?= $i; ?>" >
            <input type="hidden" class="rest-name" id="rest-name" value="<?= $row->name; ?>" >
            <input type="hidden" class="rest-data-type" id="rest-data-type" value="<?= $row->type; ?>" >
            <input type="hidden" class="rest-primarykey" id="rest-primarykey" value="<?= $row->primary_key; ?>" >
            <input type="hidden" class="rest-max-length" id="rest-max-length" value="<?= $row->max_length; ?>" >
         </td>
         <td>
            <?= $row->name; ?>   
         </td>
         <td class="column">
            <input class="flat-red check" type="checkbox" checked name="rest[<?=$i; ?>][<?=$row->name; ?>][show_in_column]" value="yes">
         </td>
         <td class="add_form">
            <input class="flat-red check" type="checkbox" <?= $row->primary_key ? '' : 'checked'; ?> name="rest[<?=$i; ?>][<?=$row->name; ?>][show_in_add_form]" value="yes">
         </td>
         <td class="update_form">
            <input class="flat-red check" type="checkbox" <?= $row->primary_key ? '' : 'checked'; ?> name="rest[<?=$i; ?>][<?=$row->name; ?>][show_in_update_form]" value="yes">
         </td>
         <td class="detail_page">
            <input class="flat-red check" type="checkbox" checked name="rest[<?=$i; ?>][<?=$row->name; ?>][show_in_detail_page]" value="yes">
         </td>
         <td>
            <div class="col-md-12">
               <div class="form-group ">
                  <select  class="form-control chosen chosen-select input_type" name="rest[<?=$i; ?>][<?=$row->name; ?>][input_type]" id="input_type" tabi-ndex="5" data-placeholder="Select Type" >
                     <option value="" class="<?= $this->model_rest->get_input_type(); ?>"></option>
                     <?php foreach (db_get_all_data('rest_input_type') as $input): 
                        if ($input->type == 'input') {
                           $selected = 'selected';
                        } else {
                           $selected = '';
                        }
                     ?>
                     <option value="<?= $input->type; ?>" class="<?= $input->type; ?>" title="<?= $input->validation_group; ?>"  <?= $selected; ?>><?= _ent(ucwords(clean_snake_case($input->type))); ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
            </div>
         </td>
         <td>
            <div class="col-md-12">
               <div class="form-group ">
                  <select  class="form-control chosen chosen-select validation" name="rest[<?=$i; ?>][<?=$row->name; ?>][validation]" id="validation" tabi-ndex="5" data-placeholder="+ Add Rules">
                      <option value="" class="input file number text datetime select"></option>
                      <?php 
                      foreach (db_get_all_data('crud_input_validation') as $input): 
                      ?>
                        <option value="<?= $input->validation; ?>" class="<?= str_replace(',', ' ', $input->group_input); ?>" data-group-validation="<?= str_replace(',', ' ', $input->group_input); ?>" data-placeholder="<?= $input->input_placeholder; ?>" title="<?= $input->input_able; ?>"><?= _ent(ucwords(clean_snake_case($input->validation))); ?></option>
                       <?php endforeach; ?> 
                  </select>
               </div>
            </div>
         </td>
      </tr>
      <?php endforeach; ?>
   </tbody>
</table>
</div>