<?php if ($address_map = $this->crud_builder->getFieldByType('address_map')): ?>

<?php endif; ?>
<script src="<?= BASE_ASSET; ?>js/custom.js"></script>

<?php if ($fine_upload = $this->crud_builder->getFieldFile()): ?>
<!-- Fine Uploader Gallery CSS file
    ====================================================================== -->
<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>

<?php $this->load->view('core_template/fine_upload'); ?>
<?php endif; ?>

<form class="form-horizontal form-preview">
<?php foreach ($this->crud_builder->getFieldAllForm(true) as $input => $option): ?> 
<?php if (in_array($option['input_type'], $this->crud_builder->getFieldNotShowInAddForm())) continue; ?>
<?php if ($option['input_type'] == 'input') {?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="<?= $input; ?>" id="<?= $input; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>" value="<?= set_value('<?= $input; ?>'); ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'number') {?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <input type="number" class="form-control" name="<?= $input; ?>" id="<?= $input; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>" value="<?= set_value('<?= $input; ?>'); ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'yes_no') {?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-6">
        <div class="col-md-2 padding-left-0">
            <label>
                <input type="radio" class="flat-red" name="<?= $input; ?>" id="<?= $input; ?>"  value="yes" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
                Yes
            </label>
        </div>
        <div class="col-md-14">
            <label>
                <input type="radio" class="flat-red" name="<?= $input; ?>" id="<?= $input; ?>"  value="no" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
                No
            </label>
        </div>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'email') {?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <input type="email" class="form-control" name="<?= $input; ?>" id="<?= $input; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>" value="<?= set_value('<?= $input; ?>'); ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'datetime') {?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-6">
    <div class="input-group date col-sm-8">
      <input type="text" class="form-control pull-right datetimepicker" name="<?= $input; ?>"  id="<?= $input; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
    </div>
    <small class="info help-block">
    <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'password') {?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-6">
      <div class="input-group col-md-8 input-password">
      <input type="password" class="form-control password" name="<?= $input; ?>" id="<?= $input; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>" value="<?= set_value('<?= $input; ?>'); ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
        <span class="input-group-btn">
          <button type="button" class="btn btn-flat show-password"><i class="fa fa-eye eye"></i></button>
        </span>
      </div>
    <small class="info help-block">
    <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'editor_wysiwyg') { ?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <textarea id="<?= $input; ?>" name="<?= $input; ?>" rows="5" cols="80" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>><?= set_value('<?= ucwords(clean_snake_case($input)); ?>'); ?></textarea>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'textarea') { ?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <textarea id="<?= $input; ?>" name="<?= $input; ?>" rows="5" class="textarea" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>><?= set_value('<?= $input; ?>'); ?></textarea>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'file') { ?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <div id="{table_name}_<?= $input; ?>_galery" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>></div>
        <input class="data_file" name="{table_name}_<?= $input; ?>_uuid" id="{table_name}_<?= $input; ?>_uuid" type="hidden" value="<?= set_value('{table_name}_<?= $input; ?>_uuid'); ?>">
        <input class="data_file" name="{table_name}_<?= $input; ?>_name" id="{table_name}_<?= $input; ?>_name" type="hidden" value="<?= set_value('{table_name}_<?= $input; ?>_name'); ?>">
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'select') { 
$relation = $this->crud_builder->getFieldRelation($input); 
?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <select  class="form-control chosen chosen-select-deselect" name="<?= $input; ?>" id="<?= $input; ?>" data-placeholder="Select <?= ucwords(clean_snake_case($option['input_label'])); ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?> >
            <option value=""></option>
            <?php foreach (db_get_all_data($relation['relation_table']) as $row): ?>
            <option value="<?= $row->{$relation['relation_value']}; ?>"><?= $row->{$relation['relation_label']}; ?></option>
            <?php endforeach; ?>  
        </select>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>

<?php } elseif ($option['input_type'] == 'time') {?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-6">
    <div class="input-group date col-sm-8">
      <input type="text" class="form-control pull-right timepicker" name="<?= $input; ?>" id="<?= $input; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
    </div>
    <small class="info help-block">
    <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'date') {?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-6">
    <div class="input-group date col-sm-8">
      <input type="text" class="form-control pull-right datepicker" name="<?= $input; ?>"  placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>" id="<?= $input; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
    </div>
    <small class="info help-block">
    <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'year') { 
$relation = $this->crud_builder->getFieldRelation($input); 
?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-2">
        <select  class="form-control chosen chosen-select-deselect" name="<?= $input; ?>" id="<?= $input; ?>" data-placeholder="Select <?= ucwords(clean_snake_case($option['input_label'])); ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
            <option value=""></option>
            <?php for ($i = 1970; $i < date('Y')+100; $i++){ ?>
            <option value="<?= $i;?>"><?= $i; ?></option>
            <?php }; ?>  
        </select>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'select_multiple') { 
$relation = $this->crud_builder->getFieldRelation($input); 
?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <select  class="form-control chosen chosen-select" name="<?= $input; ?>[]" id="<?= $input; ?>" data-placeholder="Select <?= ucwords(clean_snake_case($option['input_label'])); ?>" multiple <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
            <option value=""></option>
            <?php foreach (db_get_all_data($relation['relation_table']) as $row): ?>
            <option value="<?= $row->{$relation['relation_value']}; ?>"><?= $row->{$relation['relation_label']}; ?></option>
            <?php endforeach; ?>  
        </select>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'checkboxes') { 
$relation = $this->crud_builder->getFieldRelation($input); 
?><div class="form-group  wrapper-options-crud">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
            <?php foreach (db_get_all_data($relation['relation_table']) as $row): ?>
            <div class="col-md-3  padding-left-0">
            <label>
            <input type="checkbox" class="flat-red" name="<?= $input; ?>[]" value="<?= $row->{$relation['relation_value']}; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>> <?= $row->{$relation['relation_label']}; ?>
            </label>
            </div>
            <?php endforeach; ?>  
            <div class="row-fluid clear-both">
            <small class="info help-block">
            <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
            </div>
            
    </div>
</div>
<?php } elseif ($option['input_type'] == 'options') { 
$relation = $this->crud_builder->getFieldRelation($input); 
?><div class="form-group  wrapper-options-crud">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
            <?php foreach (db_get_all_data($relation['relation_table']) as $row): ?>
            <div class="col-md-3 padding-left-0">
            <label>
            <input type="radio" class="flat-red" name="<?= $input; ?>" value="<?= $row->{$relation['relation_value']}; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>> <?= $row->{$relation['relation_label']}; ?>
            </label>
            </div>
            <?php endforeach; ?>  
        </select>
        <div class="row-fluid clear-both">
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
        </div>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'true_false') {?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-6">
        <div class="col-md-2 padding-left-0">
            <label>
                <input type="radio" class="flat-red" name="<?= $input; ?>" id="<?= $input; ?>"  value="1" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
                Yes
            </label>
        </div>
        <div class="col-md-14">
            <label>
                <input type="radio" class="flat-red" name="<?= $input; ?>" id="<?= $input; ?>"  value="0">
                No
            </label>
        </div>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'custom_option') { 
$custom_value = $this->crud_builder->getFieldCustomValue($input); 
?><div class="form-group  wrapper-options-crud">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
            <?php foreach ($custom_value as $custom): 
            ?><div class="col-md-3 padding-left-0">
            <label>
            <input type="radio" class="flat-red" name="<?= $input; ?>" value="<?= $custom['value']; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>> <?= $custom['label']; ?>
            </label>
            </div>
            <?php endforeach; 
        ?></select>
        <div class="row-fluid clear-both">
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?> </small>
        </div>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'custom_checkbox') { 
$custom_value = $this->crud_builder->getFieldCustomValue($input); 
?><div class="form-group  wrapper-options-crud">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
            <?php foreach ($custom_value as $custom): 
            ?><div class="col-md-3  padding-left-0">
            <label>
            <input type="checkbox" class="flat-red" name="<?= $input; ?>[]" value="<?= $custom['value']; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>> <?= $custom['label']; ?>
            </label>
            </div>
            <?php endforeach; ?>
            <div class="row-fluid clear-both">
            <small class="info help-block">
            <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
            </div>
            
    </div>
</div>
<?php } elseif ($option['input_type'] == 'custom_select_multiple') { 
$custom_value = $this->crud_builder->getFieldCustomValue($input); 
?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <select  class="form-control chosen chosen-select" name="<?= $input; ?>[]" id="<?= $input; ?>" data-placeholder="Select <?= ucwords(clean_snake_case($option['input_label'])); ?>" multiple <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
            <option value=""></option>
            <?php foreach ($custom_value as $custom): 
            ?><option value="<?= $custom['value']; ?>"><?= $custom['label']; ?></option>
            <?php endforeach; 
        ?></select>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'custom_select') { 
$custom_value = $this->crud_builder->getFieldCustomValue($input); 
?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <select  class="form-control chosen chosen-select" name="<?= $input; ?>" id="<?= $input; ?>" data-placeholder="Select <?= ucwords(clean_snake_case($option['input_label'])); ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
            <option value=""></option>
            <?php foreach ($custom_value as $custom): 
            ?><option value="<?= $custom['value']; ?>"><?= $custom['label']; ?></option>
            <?php endforeach; 
        ?></select>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'address_map') {?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <input autocomplete="off" type="text" class="form-control" name="<?= $input; ?>" id="<?= $input; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>" value="<?= set_value('<?= $input; ?>'); ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'heading') {?><div class="">
    <div class="col-sm-14 col-md-offset-2">
        <<?= $option['input_name']; ?> <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>><?= $option['input_label']; ?></<?= $option['input_name']; ?>>
    </div>
    <hr>
</div>
<?php } elseif ($option['input_type'] == 'captcha') {?><div class="form-group ">
    <label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <i class="required">*</i></label>
    <div class="col-sm-8">
        <?php $cap = get_captcha(); ?>
        <div class="captcha-box"  data-captcha-time="<?= $cap['time']; ?>">
            <input type="text" name="<?= $option['input_name']; ?>" placeholder="<?= $option['placeholder']; ?>">
            <a class="btn btn-flat  refresh-captcha  "><i class="fa fa-refresh text-danger"></i></a>
            <span  class="box-image"><?= $cap['image']; ?></span>
            </div>
             <small class="info help-block">
            <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
        </div>
    </div>
</div>
</div>
<?php } else { 
?><div class="form-group ">
<label for="<?= $input; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="<?= $input; ?>" id="<?= $input; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>" value="<?= set_value('<?= $input; ?>'); ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input) : $option['help_block']; ?></small>
    </div>
</div>
<?php } ?>
<?php endforeach; echo "\n"; ?>
<div class="col-sm-2">
</div>
<div class="col-sm-8 padding-left-0">
    <button class="btn btn-flat btn-primary" id="btn_save" data-stype='stay'>
    Submit
    </button>
</div>
<?= form_close(); ?>
</div>


<?php if ($editor_wysiwyg = $this->crud_builder->getFieldByType('editor_wysiwyg')): ?>
<script src="{php_open_tag_echo} BASE_ASSET; {php_close_tag}ckeditor/ckeditor.js"></script>
<?php endif; ?>
<!-- Page script -->
<script>
    $(document).ready(function(){
     <?php if ($captcha = $this->crud_builder->getFieldByType('captcha')): ?>
     $('.refresh-captcha').on('click', function(){
        var capparent = $(this);

        $.ajax({
            url: BASE_URL + '/captcha/reload/'+ capparent.parent('.captcha-box').attr('data-captcha-time'),
            dataType: 'JSON',
        })
        .done(function(res) {
            capparent.parent('.captcha-box').find('.box-image').html(res.image);
            capparent.parent('.captcha-box').attr('data-captcha-time', res.captcha.time);
        })
          .fail(function() {
            $('.message').printMessage({message : 'Error getting captcha', type : 'warning'});
          })
          .always(function() {
          });
        
     });
     <?php endif; ?>
     $('.form-preview').submit(function(){
        return false;
     });

     $('input[type="checkbox"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
     });

      <?php foreach ($address_map as $input): ?>$('#<?= $input; ?>').addressPickerByGiro({distanceWidget: true});
      <?php endforeach; ?>
      <?php foreach ($editor_wysiwyg as $input): ?>CKEDITOR.replace('<?= $input; ?>'); 
      var <?= $input; ?> = CKEDITOR.instances.<?= $input; ?>;
      <?php endforeach; ?>
       
       <?php foreach ($fine_upload as $input): 

          $extension =  $this->crud_builder->getFieldValidation($input, 'allowed_extension');
          $extension = is_string($extension) ? str_replace(' ', '', $extension) : '';

          if ($extension) {
            $extensions = explode(',', $extension);
          } else {
            $extensions = [];
          }

          $width = $this->crud_builder->getFieldValidation($input, 'max_width');
          $height = $this->crud_builder->getFieldValidation($input, 'max_height');

          if (!empty($width) OR !empty($height)) {
            $dimension = $width. " * " . $height;
          } else {
            $dimension = false;
          }


        ?>var params = {};
       params[csrf] = token;

       $('#{table_name}_<?= $input; ?>_galery').fineUploader({
          template: 'qq-template-gallery'
      }); /*end <?= $input; ?> galey*/
       <?php endforeach; ?>
    
    }); /*end doc ready*/
</script>