<?php if ($address_map = $this->crud_builder->getFieldByType('address_map')): ?>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCOi5vktJx2fjOA4X9orhT_-v2SIvsv060 "></script>
<script src="{php_open_tag_echo} BASE_ASSET; {php_close_tag}jquery-map/dist/jquery.addressPickerByGiro.js"></script>
<link href="<?= BASE_ASSET; ?>jquery-map/dist/jquery.addressPickerByGiro.css" rel="stylesheet" media="screen">
<?php endif; ?>

<script src="{php_open_tag_echo} BASE_ASSET; {php_close_tag}js/custom.js"></script>

<?php if ($fine_upload = $this->crud_builder->getFieldFile()): ?>
<!-- Fine Uploader Gallery CSS file
    ====================================================================== -->
<link href="{php_open_tag_echo} BASE_ASSET; {php_close_tag}/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="{php_open_tag_echo} BASE_ASSET; {php_close_tag}/fine-upload/jquery.fine-uploader.js"></script>

{php_open_tag} $this->load->view('core_template/fine_upload'); {php_close_tag}
<?php endif; ?>

{php_open_tag_echo} form_open('', [
    'name'    => 'form_{table_name}', 
    'class'   => 'form-horizontal form_{table_name}', 
    'id'      => 'form_{table_name}',
    'enctype' => 'multipart/form-data', 
    'method'  => 'POST'
]); {php_close_tag}
<?php foreach ($field_all = $this->crud_builder->getFieldAllForm(true) as $input => $option): ?>
<?php if (in_array($option['input_type'], $this->crud_builder->getFieldNotShowInAddForm())) continue; ?> 
<?php if ($option['input_type'] == 'input') {?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>"  <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'number') {?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <input type="number" class="form-control" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>"  <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'yes_no') {?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-6">
        <div class="col-md-2 padding-left-0">
            <label>
                <input type="radio" class="flat-red" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>"  value="yes" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
                Yes
            </label>
        </div>
        <div class="col-md-14">
            <label>
                <input type="radio" class="flat-red" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>"  value="no" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
                No
            </label>
        </div>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'email') {?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <input type="email" class="form-control" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>"  <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'datetime') {?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-6">
    <div class="input-group date col-sm-8">
      <input type="text" class="form-control pull-right datetimepicker" name="<?= $option['input_name']; ?>"  id="<?= $option['input_name']; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
    </div>
    <small class="info help-block">
    <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'password') {?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-6">
      <div class="input-group col-md-8 input-password">
      <input type="password" class="form-control password" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>"  <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
        <span class="input-group-btn">
          <button type="button" class="btn btn-flat show-password"><i class="fa fa-eye eye"></i></button>
        </span>
      </div>
    <small class="info help-block">
    <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'editor_wysiwyg') { ?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <textarea id="<?= $option['input_name']; ?>" name="<?= $option['input_name']; ?>" rows="5" cols="80" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>><?= set_value('<?= ucwords(clean_snake_case($input)); ?>'); ?></textarea>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'textarea') { ?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <textarea id="<?= $option['input_name']; ?>" name="<?= $option['input_name']; ?>" rows="5" class="textarea" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>></textarea>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'file') { ?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <div id="{table_name}_<?= $option['input_name']; ?>_galery" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>></div>
        <input class="data_file" name="{table_name}_<?= $option['input_name']; ?>_uuid" id="{table_name}_<?= $option['input_name']; ?>_uuid" type="hidden" >
        <input class="data_file" name="{table_name}_<?= $option['input_name']; ?>_name" id="{table_name}_<?= $option['input_name']; ?>_name" type="hidden" >
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'select') { 
$relation = $this->crud_builder->getFieldRelation($input); 
?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <select  class="form-control chosen chosen-select-deselect" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>" data-placeholder="Select <?= ucwords(clean_snake_case($option['input_label'])); ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?> >
            <option value=""></option>
            {php_open_tag} foreach (db_get_all_data('<?= $relation['relation_table']; ?>') as $row): {php_close_tag}
            <option value="{php_open_tag_echo} $row-><?= $relation['relation_value']; ?> {php_close_tag}">{php_open_tag_echo} $row-><?= $relation['relation_label']; ?>; {php_close_tag}</option>
            {php_open_tag} endforeach; {php_close_tag}  
        </select>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>

<?php } elseif ($option['input_type'] == 'time') {?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-6">
    <div class="input-group date col-sm-8">
      <input type="text" class="form-control pull-right timepicker" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
    </div>
    <small class="info help-block">
    <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'date') {?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-6">
    <div class="input-group date col-sm-8">
      <input type="text" class="form-control pull-right datepicker" name="<?= $option['input_name']; ?>"  placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>" id="<?= $option['input_name']; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
    </div>
    <small class="info help-block">
    <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'year') { 
$relation = $this->crud_builder->getFieldRelation($input); 
?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-2">
        <select  class="form-control chosen chosen-select-deselect" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>" data-placeholder="Select <?= ucwords(clean_snake_case($option['input_label'])); ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
            <option value=""></option>
            {php_open_tag} for ($i = 1970; $i < date('Y')+100; $i++){ {php_close_tag}
            <option value="{php_open_tag_echo} $i; {php_close_tag}">{php_open_tag_echo} $i; {php_close_tag}</option>
            {php_open_tag} }; {php_close_tag} 
        </select>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'select_multiple') { 
$relation = $this->crud_builder->getFieldRelation($input); 
?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <select  class="form-control chosen chosen-select" name="<?= $option['input_name']; ?>[]" id="<?= $option['input_name']; ?>" data-placeholder="Select <?= ucwords(clean_snake_case($option['input_label'])); ?>" multiple <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
            <option value=""></option>
            {php_open_tag} foreach (db_get_all_data('<?= $relation['relation_table']; ?>') as $row): {php_close_tag}
            <option value="{php_open_tag_echo} $row-><?= $relation['relation_value']; ?> {php_close_tag}">{php_open_tag_echo} $row-><?= $relation['relation_label']; ?>; {php_close_tag}</option>
            {php_open_tag} endforeach; {php_close_tag}  
        </select>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'checkboxes') { 
$relation = $this->crud_builder->getFieldRelation($input); 
?><div class="form-group  wrapper-options-crud">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
            {php_open_tag} foreach (db_get_all_data('<?= $relation['relation_table']; ?>') as $row): {php_close_tag}
            <div class="col-md-3  padding-left-0">
            <label>
            <input type="checkbox" class="flat-red" name="<?= $option['input_name']; ?>[]" value="{php_open_tag_echo} $row-><?= $relation['relation_value']; ?> {php_close_tag}"> {php_open_tag_echo} $row-><?= $relation['relation_label']; ?>; {php_close_tag}
            </label>
            </div>
            {php_open_tag} endforeach; {php_close_tag}  
            <div class="row-fluid clear-both">
            <small class="info help-block">
            <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
            </div>
            
    </div>
</div>
<?php } elseif ($option['input_type'] == 'options') { 
$relation = $this->crud_builder->getFieldRelation($input); 
?><div class="form-group  wrapper-options-crud">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
            {php_open_tag} foreach (db_get_all_data('<?= $relation['relation_table']; ?>') as $row): {php_close_tag}
            <div class="col-md-3 padding-left-0">
            <label>
            <input type="radio" class="flat-red" name="<?= $option['input_name']; ?>" value="{php_open_tag_echo} $row-><?= $relation['relation_value']; ?> {php_close_tag}"> {php_open_tag_echo} $row-><?= $relation['relation_label']; ?>; {php_close_tag}
            </label>
            </div>
            {php_open_tag} endforeach; {php_close_tag}  
        </select>
        <div class="row-fluid clear-both">
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
        </div>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'true_false') {?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-6">
        <div class="col-md-2 padding-left-0">
            <label>
                <input type="radio" class="flat-red" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>"  value="1" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
                Yes
            </label>
        </div>
        <div class="col-md-14">
            <label>
                <input type="radio" class="flat-red" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>"  value="0">
                No
            </label>
        </div>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'custom_option') { 
$custom_value = $this->crud_builder->getFieldCustomValue($input); 
?><div class="form-group  wrapper-options-crud">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
            <?php foreach ($custom_value as $custom): 
            ?><div class="col-md-3 padding-left-0">
            <label>
            <input type="radio" class="flat-red" name="<?= $option['input_name']; ?>" value="<?= $custom['value']; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>> <?= $custom['label']; ?>
            </label>
            </div>
            <?php endforeach; 
        ?></select>
        <div class="row-fluid clear-both">
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
        </div>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'custom_checkbox') { 
$custom_value = $this->crud_builder->getFieldCustomValue($input); 
?><div class="form-group  wrapper-options-crud">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
            <?php foreach ($custom_value as $custom): 
            ?><div class="col-md-3  padding-left-0">
            <label>
            <input type="checkbox" class="flat-red" name="<?= $option['input_name']; ?>[]" value="<?= $custom['value']; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>> <?= $custom['label']; ?>
            </label>
            </div>
            <?php endforeach; ?>
            <div class="row-fluid clear-both">
            <small class="info help-block">
            <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
            </div>
            
    </div>
</div>
<?php } elseif ($option['input_type'] == 'custom_select_multiple') { 
$custom_value = $this->crud_builder->getFieldCustomValue($input); 
?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <select  class="form-control chosen chosen-select" name="<?= $option['input_name']; ?>[]" id="<?= $option['input_name']; ?>" data-placeholder="Select <?= ucwords(clean_snake_case($option['input_label'])); ?>" multiple <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
            <option value=""></option>
            <?php foreach ($custom_value as $custom): 
            ?><option value="<?= $custom['value']; ?>"><?= $custom['label']; ?></option>
            <?php endforeach; 
        ?></select>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'custom_select') { 
$custom_value = $this->crud_builder->getFieldCustomValue($input); 
?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <select  class="form-control chosen chosen-select" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>" data-placeholder="Select <?= ucwords(clean_snake_case($option['input_label'])); ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
            <option value=""></option>
            <?php foreach ($custom_value as $custom): 
            ?><option value="<?= $custom['value']; ?>"><?= $custom['label']; ?></option>
            <?php endforeach; 
        ?></select>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'address_map') {?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <input autocomplete="off" type="text" class="form-control" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>"  <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } elseif ($option['input_type'] == 'heading') {?><div class="">
    <div class="col-sm-14 col-md-offset-2">
        <<?= $option['input_name']; ?> <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>><?= $option['input_label']; ?></<?= $option['input_name']; ?>>
    </div>
    <hr>
</div>
<?php } elseif ($option['input_type'] == 'captcha') {?><div class="form-group ">
    <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <i class="required">*</i></label>
    <div class="col-sm-8">
        {php_open_tag} $cap = get_captcha(); {php_close_tag}
        <div class="captcha-box"  data-captcha-time="{php_open_tag_echo} $cap['time']; {php_close_tag}">
            <input type="text" name="<?= $option['input_name']; ?>" placeholder="<?= $option['placeholder']; ?>">
            <a class="btn btn-flat  refresh-captcha  "><i class="fa fa-refresh text-danger"></i></a>
            <span  class="box-image">{php_open_tag_echo} $cap['image']; {php_close_tag}</span>
        </div>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } else { 
?><div class="form-group ">
<label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
    <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
    <?php } ?></label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>"  <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
        <small class="info help-block">
        <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
    </div>
</div>
<?php } ?>
<?php endforeach; echo "\n"; ?>

<div class="row col-sm-12 message">
</div>
<div class="col-sm-2">
</div>
<div class="col-sm-8 padding-left-0">
    <button class="btn btn-flat btn-primary btn_save" id="btn_save" data-stype='stay'>
    Submit
    </button>
    <span class="loading loading-hide">
    <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
    <i>Loading, Submitting data</i>
    </span>
</div>
<?= form_close(); ?>
</div>


<?php if ($editor_wysiwyg = $this->crud_builder->getFieldByType('editor_wysiwyg')): ?>
<script src="{php_open_tag_echo} BASE_ASSET; {php_close_tag}ckeditor/ckeditor.js"></script>
<?php endif; ?>
<!-- Page script -->
<script>
    $(document).ready(function(){
     <?php if ($captcha = $this->crud_builder->getFieldByType('captcha')): ?>$('.refresh-captcha').on('click', function(){
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


    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        <?php foreach ($editor_wysiwyg as $input): ?>$('#<?= $field_all[$input]['input_name']; ?>').val(<?= $field_all[$input]['input_name']; ?>.getData());
        <?php endforeach; ?>
    
        var form_{table_name} = $('#form_{table_name}');
        var data_post = form_{table_name}.serializeArray();
        var save_type = $(this).attr('data-stype');
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + 'form/{table_name}/submit',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            <?php 
            foreach ($fine_upload as $input):
            ?>var id_<?= $field_all[$input]['input_name']; ?> = $('#{table_name}_<?= $field_all[$input]['input_name']; ?>_galery').find('li').attr('qq-file-id');
            <?php 
            endforeach; 
            ?>

            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            <?php 
            foreach ($fine_upload as $input):
                ?>if (typeof id_<?= $field_all[$input]['input_name']; ?> !== 'undefined') {
                    $('#{table_name}_<?= $field_all[$input]['input_name']; ?>_galery').fineUploader('deleteFile', id_<?= $field_all[$input]['input_name']; ?>);
                }
            <?php
            endforeach; 

            ?>$('.chosen option').prop('selected', false).trigger('chosen:updated');
            <?php foreach ($editor_wysiwyg as $input): ?><?= $field_all[$input]['input_name']; ?>.setData(''); 
            <?php endforeach; ?>
    
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 1000);
        });
    
        return false;
      }); /*end btn save*/


      <?php foreach ($address_map as $input):
      ?>$('#<?= $field_all[$input]['input_name']; ?>').addressPickerByGiro({distanceWidget: true});
      <?php 
      endforeach; ?>

      <?php foreach ($editor_wysiwyg as $input): ?>CKEDITOR.replace('<?= $field_all[$input]['input_name']; ?>'); 
      var <?= $field_all[$input]['input_name']; ?> = CKEDITOR.instances.<?= $field_all[$input]['input_name']; ?>;
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

       $('#{table_name}_<?= $field_all[$input]['input_name']; ?>_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + 'form/{table_name}/upload_<?= $field_all[$input]['input_name']; ?>_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + 'form/{table_name}/delete_<?= $field_all[$input]['input_name']; ?>_file',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: [<?= count($extensions) ? '"'.implode('","', $extensions).'"' : '"*"'; ?>],
              sizeLimit : <?= (int) $this->crud_builder->getFieldValidation($input, 'max_size') * 1024; ?>,
              <?php if (($dimension)) {?>
              dimension : <?= $dimension; ?>
              <?php }; ?>
          },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#{table_name}_<?= $field_all[$input]['input_name']; ?>_galery').fineUploader('getUuid', id);
                   $('#{table_name}_<?= $field_all[$input]['input_name']; ?>_uuid').val(uuid);
                   $('#{table_name}_<?= $field_all[$input]['input_name']; ?>_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#{table_name}_<?= $field_all[$input]['input_name']; ?>_uuid').val();
                  $.get(BASE_URL + 'form/{table_name}/delete_<?= $field_all[$input]['input_name']; ?>_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#{table_name}_<?= $field_all[$input]['input_name']; ?>_uuid').val('');
                  $('#{table_name}_<?= $field_all[$input]['input_name']; ?>_name').val('');
                }
              }
          }
      }); /*end <?= $field_all[$input]['input_name']; ?> galey*/
       <?php endforeach; ?>
    
    }); /*end doc ready*/
</script>