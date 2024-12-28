
<aside class="control-sidebar control-sidebar-dark toolbox-form"  style="height: 100%; overflow-y: auto;">
  <div class="tab-content" style="height: 100%">
  <h4 class="control-sidebar-heading">Forms </h4>
   <div class="tool-wrapper">
     
      <table class="table table-responsive table table-striped "  id="tools">
       <?php $i =1; foreach (db_get_all_data('crud_input_type') as $toolbox): ?>
       <?php if (in_array($toolbox->type, $this->crud_builder->getFieldNotShowInFormComponent())) continue; ?>

          <tr>
             <td class="dragable hide-preview" width="2%">
                <i class="fa fa-bars fa-lg text-muted"></i>
                <input type="hidden" name="form[{field_id}][{field_name}][sort]" class="priority" value="{field_id}" >
                <input type="hidden" class="form-id" id="form-id" value="{field_id}" >
                <input type="hidden" class="form-name" id="form-name" value="{field_name}" >
             </td>
             <td class="dragable hide-designer" width="10%" style="color: #747474 !important">
            <?php 
              if ( $toolbox->type =='textarea') {
                echo ' <span class="demo-icon">&#xe807;</span>';
              } elseif ( $toolbox->type =='select') {
                echo ' <span class="demo-icon">&#xe804;</span>';
              } elseif ( $toolbox->type =='editor_wysiwyg') {
                echo ' <span class="demo-icon">&#xe810;</span>';
              } elseif ( $toolbox->type =='password') {
                echo ' <span class="demo-icon">&#xe808;</span>';
              } elseif ( $toolbox->type =='email') {
                echo ' <span class="fa fa-envelope"></span>';
              } elseif ( $toolbox->type =='file') {
                echo ' <span class="demo-icon">&#xe80a;</span>';
              } elseif ( $toolbox->type =='input') {
                echo ' <span class="demo-icon">&#xe808;</span>';
              } elseif ( $toolbox->type =='datetime') {
                echo ' <span class="demo-icon">&#xe801;</span>';
              } elseif ( $toolbox->type =='number') {
                echo ' <span class="demo-icon">&#xe811;</span>';
              } elseif ( $toolbox->type =='date') {
                echo ' <span class="fa fa-calendar-check-o "></span>';
              } elseif ( $toolbox->type =='yes_no') {
                echo ' <span class="demo-icon">&#xe80d;</span>';
              } elseif ( $toolbox->type =='time') {
                echo ' <span class="fa fa-clock-o"></span>';
              } elseif ( $toolbox->type =='year') {
                echo ' <span class="fa fa-calendar-o"></span>';
              } elseif ( $toolbox->type =='select_multiple') {
                echo ' <span class="demo-icon">&#xe804;</span>';
              } elseif ( $toolbox->type =='checkboxes') {
                echo ' <span class="demo-icon">&#xe802;</span>';
              } elseif ( $toolbox->type =='options') {
                echo ' <span class="fa fa-circle-o"></span>';
              } elseif ( $toolbox->type =='true_false') {
                echo ' <span class="demo-icon">&#xe80d;</span>';
              } elseif ( $toolbox->type =='address_map') {
                echo ' <span class="fa fa-at"></span>';
              } elseif ( $toolbox->type =='custom_option') {
                echo ' <span class="fa fa-bullseye"></span>';
              } elseif ( $toolbox->type =='custom_checkbox') {
                echo ' <span class="demo-icon">&#xe802;</span>';
              } elseif ( $toolbox->type =='custom_select_multiple') {
                echo ' <span class="demo-icon">&#xe804;</span>';
              } elseif ( $toolbox->type =='custom_select') {
                echo ' <span class="demo-icon">&#xe804;</span>';
              } elseif ( $toolbox->type =='timestamp') {
                echo ' <span class="fa fa-clock-o"></span>';
              }       ?>
             </td>
              <td class=" hide-designer" width="80%" style="color: #747474 !important">
               <?= ucwords(clean_snake_case($toolbox->type)); ?>
             </td>
             <td class="field-name-preview hide-preview" width="30%">
                <div class="setting-container">
                  <i class="fa fa-minus btn-collapse-setting"></i>
                  <div class="box-setting"> 
                      <label>
                          <div class="setting-name">field label</div> 
                          <input class="input_setting field_label" name="form[{field_id}][{field_name}][input_label]" value="<?= ucwords(clean_snake_case($toolbox->type)); ?>">
                      </label>
                  </div>                  
                  <div class="box-setting"> 
                      <label>
                          <div class="setting-name">field name</div> 
                          <input class="input_setting field_name" name="form[{field_id}][{field_name}][input_name]" value="<?= $toolbox->type; ?>">
                      </label>
                  </div>                      
                  <div class="box-setting"> 
                      <label>
                          <div class="setting-name">placeholder</div> 
                          <input class="input_setting" name="form[{field_id}][{field_name}][placeholder]" value="">
                      </label>
                  </div>                   
                  <div class="box-setting"> 
                      <label>
                          <div class="setting-name"><span>auto generated help block ?</span> 
                              <div class="pull-right">
                                  <input class="switch-button pull-right" type="checkbox" checked="" name="form[{field_id}][{field_name}][auto_generated_helpblock]" value="yes" title="automatic generated help block">
                              </div>
                          </div> 
                          <input class="input_setting" name="form[{field_id}][{field_name}][help_block]" value="" placeholder="type help block here">
                      </label>
                  </div>               
                  <div class="box-setting"> 
                      <div class="setting-name">
                          <span>custom attributes </span> 
                          <i class="fa fa-minus btn-collapse-attributes pull-right"></i>
                      </div> 
                       <div class="custom-option-container  custom-attributes-container" data-type="attributes">
                       <div class="custom-option-contain ignore-first-child">
                       </div>
                        <a class="box-custom-option input btn btn-flat btn-block text-black add-option"> 
                        <i class="fa fa-plus-circle"></i> Add new attributes
                       </a>
                    </div>
                  </div>                  
                </div>
               
             </td>
             <td class="hide-preview" width="35%">
                <div class="col-md-12">
                   <div class="form-group ">
                      <select  class="form-control chosen chosen-select input_type" name="form[{field_id}][{field_name}][input_type]" id="input_type" tabi-ndex="5" data-placeholder="Select Type" >
                         <?php foreach (db_get_all_data('crud_input_type') as $input): ?>
                         <option <?= $toolbox->type == $input->type ? 'selected' : ''; ?> value="<?= $input->type; ?>" class="<?= $input->type; ?>" title="<?= $input->validation_group; ?>" relation="<?= $input->relation; ?>" custom-value="<?= $input->custom_value; ?>" ><?= _ent(ucwords(clean_snake_case($input->type))); ?></option>
                         <?php endforeach; ?>
                      </select>
                   </div>
                </div>
                <div class="custom-option-container display-none">
                   <i class="fa fa-minus btn-collapse-option"></i>
                   <div class="custom-option-contain">
                      <div class="custom-option-item">
                         <div class="box-custom-option padding-left-0 box-top"> 
                            <div class="col-md-3">value</div>  <input type="text" name="form[{field_id}][{field_name}][custom_option][0][value]"></label>
                         </div>
                         <div class="box-custom-option padding-left-0 box-bottom"> 
                            <div class="col-md-3">label</div>  <input type="text" name="form[{field_id}][{field_name}][custom_option][0][label]">
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
                      <select  class="form-control chosen chosen-select relation_table relation_field" name="form[{field_id}][{field_name}][relation_table]" id="relation_table" tabi-ndex="5" data-placeholder="Select Table" >
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
                      <select  class="form-control chosen chosen-select relation_value relation_field" name="form[{field_id}][{field_name}][relation_value]" id="relation_value" tabi-ndex="5" data-placeholder="Select ID" >
                         <option value=""></option>
                      </select>
                   </div>
                </div>
                <div class="col-md-12" style="margin:0px !important">
                   <div class="form-group display-none ">
                      <label><small class="text-muted">Label Field Reff</small></label>
                      <select  class="form-control chosen chosen-select relation_label relation_field" name="form[{field_id}][{field_name}][relation_label]" id="relation_label" tabi-ndex="5" data-placeholder="Select Label" >
                         <option value=""></option>
                      </select>
                   </div>
                </div>
             </td>
             <td class="hide-preview" width="35%">
                <div class="col-md-12">
                   <div class="form-group ">
                      <select  class="form-control chosen chosen-select validation" name="form[{field_id}][{field_name}][validation]" id="validation" tabi-ndex="5" data-placeholder="+ Add Rules">
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
             <td class="hide-preview">
                <i class="fa fa-close pointer  delete-item" title="delete item" style="color:#DE2C56;"></i>
             </td>
          </tr>
        <?php endforeach; ?>
         <tr>
             <td class="dragable hide-preview" width="2%">
                <i class="fa fa-bars fa-lg text-muted"></i>
                <input type="hidden" name="form[{field_id}][{field_name}][sort]" class="priority" value="{field_id}" >
                <input type="hidden" class="form-id" id="form-id" value="{field_id}" >
                <input type="hidden" class="form-name" id="form-name" value="{field_name}" >
             </td>
             <td class="dragable hide-designer" width="10%" style="color: #747474 !important">
                <i class="fa fa-paragraph"></i>
             </td>
              <td class=" hide-designer" width="80%" style="color: #747474 !important">
               Heading
             </td>
             <td class="field-name-preview hide-preview" width="28%">
                <div class="setting-container">
                  <i class="fa fa-minus btn-collapse-setting"></i>
                  <div class="box-setting"> 
                      <label>
                          <div class="setting-name">heading label</div> 
                          <input class="input_setting" name="form[{field_id}][{field_name}][input_label]" value="">
                      </label>
                  </div>      
                  <div class="box-setting"> 
                      <label>
                          <div class="setting-name">heading type</div> 
                          <div class="">
                              <div class="form-group ">
                                  <select  class="form-control chosen chosen-select " name="form[{field_id}][{field_name}][input_name]" id="input_type" tabi-ndex="5" data-placeholder="Select Type" >
                                      <?php for ($i=1; $i <=6; $i++): ?>
                                      <option value="h<?= $i; ?>">H<?= $i; ?></option>
                                      <?php endfor; ?>
                                  </select>
                              </div>
                          </div>
                      </label>
                  </div>  
                  <div class="box-setting"> 
                      <div class="setting-name">
                          <span>custom attributes </span> 
                          <i class="fa fa-minus btn-collapse-attributes pull-right"></i>
                      </div> 
                      <div class="custom-option-container custom-attributes-container" data-type="attributes">
                         <div class="custom-option-contain ignore-first-child">
                         </div>
                         <a class="box-custom-option input btn btn-flat btn-block text-black add-option"> 
                            <i class="fa fa-plus-circle"></i> Add new attributes
                        </a>
                    </div>
                </div>                          
             </td>
             <td class="hide-preview" >
                <div class="col-md-12 ">
                   <div class="form-group ">
                          <select  class="form-control chosen chosen-select input_type" name="form[{field_id}][{field_name}][input_type]" id="input_type" tabi-ndex="5" data-placeholder="Select Type" >
                              <option value="heading">Heading</option>
                          </select>
                   </div>
                </div>
             </td>
             <td class="hide-preview"></td>
             <td class="hide-preview">
                <i class="fa fa-close pointer  delete-item" title="delete item" style="color:#DE2C56;"></i>
             </td>
          </tr>
         <tr>
             <td class="dragable hide-preview" width="2%">
                <i class="fa fa-bars fa-lg text-muted"></i>
                <input type="hidden" name="form[{field_id}][{field_name}][sort]" class="priority" value="{field_id}" >
                <input type="hidden" class="form-id" id="form-id" value="{field_id}" >
                <input type="hidden" class="form-name" id="form-name" value="{field_name}" >
             </td>
             <td class="dragable hide-designer" width="10%" style="color: #747474 !important">
                <span class="demo-icon">&#xe80d;</span>
             </td>
              <td class=" hide-designer" width="80%" style="color: #747474 !important">
               Captcha
             </td>
             <td class="field-name-preview hide-preview" width="28%">
                <div class="setting-container">
                  <i class="fa fa-minus btn-collapse-setting"></i>
                  <div class="box-setting"> 
                      <label>
                          <div class="setting-name">field label</div> 
                          <input class="input_setting field_label" name="form[{field_id}][{field_name}][input_label]" value="Captcha">
                      </label>
                  </div>    
                  <div class="box-setting"> 
                      <label>
                          <div class="setting-name">field name</div> 
                          <input class="input_setting field_name" name="form[{field_id}][{field_name}][input_name]" value="captcha">
                      </label>
                  </div>     
                  <div class="box-setting"> 
                      <label>
                          <div class="setting-name">placeholder</div> 
                          <input class="input_setting" name="form[{field_id}][{field_name}][placeholder]" value="">
                      </label>
                  </div>       
                  <div class="box-setting"> 
                      <label>
                          <div class="setting-name"><span>auto generated help block ?</span> 
                              <div class="pull-right">
                                  <input class="switch-button pull-right" type="checkbox" checked="" name="form[{field_id}][{field_name}][auto_generated_helpblock]" value="yes" title="automatic generated help block">
                              </div>
                          </div> 
                          <input class="input_setting" name="form[{field_id}][{field_name}][help_block]" value="" placeholder="type help block here">
                      </label>
                  </div> 
             </td>
             <td class="hide-preview" colspan="1">
                <div class="col-md-12 ">
                   <div class="form-group ">
                          <select  class="form-control chosen chosen-select input_type" name="form[{field_id}][{field_name}][input_type]" id="input_type" tabi-ndex="5" data-placeholder="Select Type" >
                              <option value="captcha">Captcha</option>
                          </select>
                   </div>
                </div>
             </td>
             <td class="hide-preview"></td>
             <td class="hide-preview">
                <i class="fa fa-close pointer  delete-item" title="delete item" style="color:#DE2C56;"></i>
             </td>
          </tr>
    </table>

    </div>
  </div>
</aside>