 <table class="table table-responsive table table-striped table-form"  id="diagnosis_list">
  
   <tbody>
      <?php $i=0; foreach ($this->db->field_data($table) as $row):  $i++; ?>
      <tr>
         <td class="hide-preview dragable" width="10%">
            <i class="fa fa-bars fa-lg text-muted"></i>
            <input type="hidden" name="form[<?=$i; ?>][<?=$row->name; ?>][sort]" class="priority" value="<?= $i; ?>" >
            <?php if ($row->primary_key == 1) { ?>
            <input type="hidden" name="primary_key" value="<?= $row->primary_key == 1? $row->name : ''; ?>" >
            <?php } ?>
            <input type="hidden" class="form-id" id="form-id" value="<?= $i; ?>" >
            <input type="hidden" class="form-name" id="form-name" value="<?= $row->name; ?>" >
            <input type="hidden" class="form-data-type" id="form-data-type" value="<?= $row->type; ?>" >
            <input type="hidden" class="form-primarykey" id="form-primarykey" value="<?= $row->primary_key; ?>" >
            <input type="hidden" class="form-max-length" id="form-max-length" value="<?= $row->max_length; ?>" >
         </td>
         <td class="field-name-preview" width="20%">
            <input type="text" name="form-name-display" value="<?= $row->name; ?>" class="input-field-name">   
         </td>
         <td class="hide-preview" width="35%">
            <div class="col-md-12">
               <div class="form-group ">
                  <select  class="form-control chosen chosen-select input_type" name="form[<?=$i; ?>][<?=$row->name; ?>][input_type]" id="input_type" tabi-ndex="5" data-placeholder="Select Type" >
                     <option value="" class="<?= $this->model_form->get_input_type(); ?>"></option>
                     <?php foreach (db_get_all_data('crud_input_type') as $input): 
                        if ($row->type == $input->type OR ($row->type == 'timestamp' AND $input->type == 'timestamp')) {
                           $selected = 'selected';
                        } elseif ($row->type == 'int' AND $input->type == 'number') {
                           $selected = 'selected';
                        } elseif ($row->type == 'text' AND $input->type == 'editor_wysiwyg') {
                           $selected = 'selected';
                        } elseif ($row->type == 'tinytext' AND $input->type == 'textarea') {
                           $selected = 'selected';
                        } elseif (($row->type == 'varchar' OR $row->type == 'tinyint') AND $input->type == 'input') {
                           $selected = 'selected';
                        } elseif (($row->type == 'decimal') AND $input->type == 'input') {
                           $selected = 'selected';
                        } elseif ($input->type == 'input') {
                           $selected = 'selected';
                        } else {
                           $selected = '';
                        }
                     ?>
                     <option value="<?= $input->type; ?>" class="<?= $input->type; ?>" title="<?= $input->validation_group; ?>" relation="<?= $input->relation; ?>" custom-value="<?= $input->custom_value; ?>" <?= _ent($selected); ?>><?= _ent(ucwords(clean_snake_case($input->type))); ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
            </div>
            <div class="custom-option-container display-none">
               <i class="fa fa-minus btn-collapse-option"></i>
               <div class="custom-option-contain">
                  <div class="custom-option-item">
                     <div class="box-custom-option padding-left-0 box-top"> 
                        <div class="col-md-3">value</div>  <input type="text" name="form[<?=$i; ?>][<?= $row->name; ?>][custom_option][0][value]"></label>
                     </div>
                     <div class="box-custom-option padding-left-0 box-bottom"> 
                        <div class="col-md-3">label</div>  <input type="text" name="form[<?=$i; ?>][<?= $row->name; ?>][custom_option][0][label]">
                     </div>
                     <a class="text-red delete-option fa fa-trash" data-original-title="" title=""></a> 
                  </div>
               </div>
                <a class="box-custom-option input btn btn-flat btn-block bg-black  add-option"> 
                <i class="fa fa-plus-circle"></i> Add new option
               </a>
            </div>

            <div class="col-md-12" style="margin:0px !important">
               <div class="form-group display-none ">
                  <label><small class="text-muted">Table Reff</small></label>
                  <select  class="form-control chosen chosen-select relation_table relation_field" name="form[<?=$i; ?>][<?=$row->name; ?>][relation_table]" id="relation_table" tabi-ndex="5" data-placeholder="Select Table" >
                     <option value=""></option>
                      <?php foreach ($this->db->list_tables() as $table): ?>
                     <option value="<?= $table; ?>"><?= $table; ?></option>
                     <?php endforeach; ?>  
                  </select>
               </div>
            </div>
            <div class="col-md-12" style="margin:0px !important">
               <div class="form-group display-none ">
                  <label><small class="text-muted">Value Field Reff</small></label>
                  <select  class="form-control chosen chosen-select relation_value relation_field" name="form[<?=$i; ?>][<?=$row->name; ?>][relation_value]" id="relation_value" tabi-ndex="5" data-placeholder="Select ID" >
                     <option value=""></option>
                  </select>
               </div>
            </div>
            <div class="col-md-12" style="margin:0px !important">
               <div class="form-group display-none ">
                  <label><small class="text-muted">Label Field Reff</small></label>
                  <select  class="form-control chosen chosen-select relation_label relation_field" name="form[<?=$i; ?>][<?=$row->name; ?>][relation_label]" id="relation_label" tabi-ndex="5" data-placeholder="Select Label" >
                     <option value=""></option>
                  </select>
               </div>
            </div>
         </td>
         <td class="hide-preview" width="35%">
            <div class="col-md-12">
               <div class="form-group ">
                  <select  class="form-control chosen chosen-select validation" name="form[<?=$i; ?>][<?=$row->name; ?>][validation]" id="validation" tabi-ndex="5" data-placeholder="+ Add Rules">
                      <option value="" class="input file number text datetime select"></option>
                      <?php 
                      foreach (db_get_all_data('crud_input_validation') as $input): 
                      ?>
                        <option value="<?= $input->validation; ?>" class="<?= str_replace(',', ' ', $input->group_input); ?>" data-group-validation="<?= str_replace(',', ' ', $input->group_input); ?>" data-placeholder="<?= $input->input_placeholder; ?>" title="<?= $input->input_able; ?>"><?= ucwords(clean_snake_case($input->validation)); ?></option>
                       <?php endforeach; ?> 
                  </select>
               </div>
            </div>
         </td>
         <td>
            <i class="fa fa-close pointer  delete-item" title="delete item" style="color:#DE2C56;"></i>
            
         </td>
      </tr>
      <?php endforeach; ?>
   </tbody>
</table>