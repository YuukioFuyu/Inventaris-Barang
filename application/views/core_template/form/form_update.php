<?php if ($address_map = $this->crud_builder->getFieldByType('address_map')): ?>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCOi5vktJx2fjOA4X9orhT_-v2SIvsv060 "></script>
<script src="{php_open_tag_echo} BASE_ASSET; {php_close_tag}jquery-map/dist/jquery.addressPickerByGiro.js"></script>
<link href="<?= BASE_ASSET; ?>jquery-map/dist/jquery.addressPickerByGiro.css" rel="stylesheet" media="screen">
<?php endif; ?>

<?php if ($fine_upload = $this->crud_builder->getFieldFile()): ?>
<!-- Fine Uploader Gallery CSS file
    ====================================================================== -->
<link href="{php_open_tag_echo} BASE_ASSET; {php_close_tag}/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="{php_open_tag_echo} BASE_ASSET; {php_close_tag}/fine-upload/jquery.fine-uploader.js"></script>
{php_open_tag} $this->load->view('core_template/fine_upload'); {php_close_tag}
<?php endif; ?>
<script src="{php_open_tag_echo} BASE_ASSET; {php_close_tag}/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
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
        <?= ucwords($subject); ?>
        <small>Edit <?= ucwords(clean_snake_case($subject)); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="{php_open_tag_echo} site_url('{table_name}'); {php_close_tag}"><?= ucwords(clean_snake_case($subject)); ?></a></li>
        <li class="active">Edit</li>
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
                                <img class="img-circle" src="{php_open_tag_echo} BASE_ASSET; {php_close_tag}/img/add2.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username"><?= ucwords($subject); ?></h3>
                            <h5 class="widget-user-desc">Edit <?= ucwords($subject); ?></h5>
                            <hr>
                        </div>
                        {php_open_tag_echo} form_open(base_url('{table_name}/edit_save/'.$this->uri->segment(3)), [
                            'name'    => 'form_{table_name}', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_{table_name}', 
                            'method'  => 'POST'
                            ]); {php_close_tag}
                        <?php foreach ($field_all as $input => $option): ?> 
                        <?php if (in_array($option['input_type'], $this->crud_builder->getFieldNotShowInUpdateForm())) continue; ?>
                        <?php if ($option['input_type'] == 'input') {?><div class="form-group ">
                            <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
                            <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
                            <?php } ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="<?= $option['input_name']; ?>" value="{php_open_tag_echo} set_value('<?= $option['input_name']; ?>', ${table_name}-><?= $option['input_name']; ?>); {php_close_tag}" id="<?= $option['input_name']; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>"  <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
                                <small class="info help-block">
                                <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
                            </div>
                        </div>
                        <?php } elseif ($option['input_type'] == 'number') {?><div class="form-group ">
                            <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
                            <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
                            <?php } ?></label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="<?= $option['input_name']; ?>" value="{php_open_tag_echo} set_value('<?= $option['input_name']; ?>', ${table_name}-><?= $option['input_name']; ?>); {php_close_tag}" id="<?= $option['input_name']; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>"  <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
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
                                        <input type="radio" class="flat-red" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>"  value="yes" {php_open_tag_echo} ${table_name}-><?= $option['input_name']; ?> == "yes" ? "checked" : ""; {php_close_tag} <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>"  value="no" {php_open_tag_echo} ${table_name}-><?= $option['input_name']; ?> == "no" ? "checked" : ""; {php_close_tag} <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
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
                                <input type="email" class="form-control" name="<?= $option['input_name']; ?>" value="{php_open_tag_echo} set_value('<?= $option['input_name']; ?>', ${table_name}-><?= $option['input_name']; ?>); {php_close_tag}" id="<?= $option['input_name']; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>"  <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
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
                              <input type="text" class="form-control pull-right datetimepicker" name="<?= $option['input_name']; ?>" value="{php_open_tag_echo} set_value('<?= $option['input_name']; ?>', ${table_name}-><?= $option['input_name']; ?>); {php_close_tag}" id="<?= $option['input_name']; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
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
                                <textarea id="<?= $option['input_name']; ?>" name="<?= $option['input_name']; ?>" rows="5" cols="80" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>{php_open_tag_echo} set_value('<?= $option['input_name']; ?>', ${table_name}-><?= $option['input_name']; ?>); {php_close_tag}</textarea>
                                <small class="info help-block">
                                <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
                            </div>
                        </div>
                        <?php } elseif ($option['input_type'] == 'textarea') { ?><div class="form-group ">
                            <label for="<?= $option['input_name']; ?>" class="col-sm-2 control-label"><?= ucwords(clean_snake_case($option['input_label'])); ?> 
                            <?php if ($this->crud_builder->getFieldValidation($input, 'required')){ ?><i class="required">*</i>
                            <?php } ?></label>
                            <div class="col-sm-8">
                                <textarea id="<?= $option['input_name']; ?>" name="<?= $option['input_name']; ?>" rows="5" class="textarea" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>{php_open_tag_echo} ${table_name}-><?= $option['input_name']; ?> {php_close_tag}</textarea>
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
                                <input class="data_file data_file_uuid" name="{table_name}_<?= $option['input_name']; ?>_uuid" id="{table_name}_<?= $option['input_name']; ?>_uuid" type="hidden" value="{php_open_tag_echo} set_value('{table_name}_<?= $option['input_name']; ?>_uuid'); {php_close_tag}">
                                <input class="data_file" name="{table_name}_<?= $option['input_name']; ?>_name" id="{table_name}_<?= $option['input_name']; ?>_name" type="hidden" value="{php_open_tag_echo} set_value('{table_name}_<?= $option['input_name']; ?>_name', ${table_name}-><?= $option['input_name']; ?>); {php_close_tag}">
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
                                    <option {php_open_tag_echo}  $row-><?= $relation['relation_value']; ?> ==  ${table_name}-><?= $option['input_name']; ?> ? 'selected' : ''; {php_close_tag} value="{php_open_tag_echo} $row-><?= $relation['relation_value']; ?> {php_close_tag}">{php_open_tag_echo} $row-><?= $relation['relation_label']; ?>; {php_close_tag}</option>
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
                              <input type="text" class="form-control pull-right timepicker" value="{php_open_tag_echo} set_value('<?= $option['input_name']; ?>', ${table_name}-><?= $option['input_name']; ?>); {php_close_tag}"  name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
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
                              <input type="text" class="form-control pull-right datepicker" value="{php_open_tag_echo} set_value('<?= $option['input_name']; ?>', ${table_name}-><?= $option['input_name']; ?>); {php_close_tag}"  name="<?= $option['input_name']; ?>"  placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>" id="<?= $option['input_name']; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
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
                                    <option {php_open_tag_echo}  $i ==  ${table_name}-><?= $option['input_name']; ?> ? 'selected' : ''; {php_close_tag} value="{php_open_tag_echo} $i; {php_close_tag}">{php_open_tag_echo} $i; {php_close_tag}</option>
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
                                    <input {php_open_tag_echo}  in_array($row-><?= $relation['relation_value']; ?>, explode(',', ${table_name}-><?= $option['input_name']; ?>)) ? 'checked' : ''; {php_close_tag} type="checkbox" class="flat-red" name="<?= $option['input_name']; ?>[]" value="{php_open_tag_echo} $row-><?= $relation['relation_value']; ?> {php_close_tag}"> {php_open_tag_echo} $row-><?= $relation['relation_label']; ?>; {php_close_tag}
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
                                        <input type="radio" class="flat-red" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>"  value="1" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?> {php_open_tag_echo} ${table_name}-><?= $option['input_name']; ?> == "1" ? "checked" : ""; {php_close_tag}>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>"  value="0" {php_open_tag_echo} ${table_name}-><?= $option['input_name']; ?> == "0" ? "checked" : ""; {php_close_tag}>
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
                                    <input {php_open_tag_echo} ${table_name}-><?= $option['input_name']; ?> == "<?= $custom['value']; ?>" ? "checked" : ""; {php_close_tag} type="radio" class="flat-red" name="<?= $option['input_name']; ?>" value="<?= $custom['value']; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>> <?= $custom['label']; ?>
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
                                    <input {php_open_tag_echo} in_array('<?= $custom['value']; ?>', explode(',', ${table_name}-><?= $option['input_name']; ?>)) ? 'checked' : ''; {php_close_tag} type="checkbox" class="flat-red" name="<?= $option['input_name']; ?>[]" value="<?= $custom['value']; ?>" <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>> <?= $custom['label']; ?>
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
                                    ?><option  {php_open_tag_echo} in_array('<?= $custom['value']; ?>', explode(',', ${table_name}-><?= $option['input_name']; ?>)) ? 'selected' : ''; {php_close_tag}  value="<?= $custom['value']; ?>"><?= $custom['label']; ?></option>
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
                                    ?><option {php_open_tag_echo} ${table_name}-><?= $option['input_name']; ?> == "<?= $custom['value']; ?>" ? 'selected' :''; ?> value="<?= $custom['value']; ?>"><?= $custom['label']; ?></option>
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
                                <input autocomplete="off" type="text" value="{php_open_tag_echo} set_value('<?= $option['input_name']; ?>', ${table_name}-><?= $option['input_name']; ?>); {php_close_tag}" class="form-control" name="<?= $option['input_name']; ?>" id="<?= $option['input_name']; ?>" placeholder="<?= ucwords(clean_snake_case($option['placeholder'])); ?>"  <?= $this->crud_builder->parseAttributes((isset($option['custom_attributes']) ? $option['custom_attributes'] : [])); ?>>
                                <small class="info help-block">
                                <?= (isset($option['auto_generated_helpblock']) AND $option['auto_generated_helpblock'] == 'yes') ? $this->crud_builder->parseValidationFile($input, '<b>', '</b>', $option['input_label']) : $option['help_block']; ?></small>
                            </div>
                        </div>
                        <?php } ?>
                        <?php endforeach; echo "\n"; ?>
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                            <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="save (Ctrl+s)">
                            <i class="fa fa-save" ></i> Save
                            </button>
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="save and back to the list (Ctrl+d)">
                            <i class="ion ion-ios-list-outline" ></i> Save and Go to The List
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="cancel (Ctrl+x)">
                            <i class="fa fa-undo" ></i> Cancel
                            </a>
                            <span class="loading loading-hide">
                            <img src="{php_open_tag_echo} BASE_ASSET; {php_close_tag}/img/loading-spin-primary.svg"> 
                            <i>Loading, Saving data</i>
                            </span>
                        </div>
                        {php_open_tag_echo} form_close(); {php_close_tag}
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
</section>
<!-- /.content -->
<?php if ($editor_wysiwyg = $this->crud_builder->getFieldByType('editor_wysiwyg')): ?>
<script src="{php_open_tag_echo} BASE_ASSET; {php_close_tag}ckeditor/ckeditor.js"></script>
<?php endif; ?>
<!-- Page script -->
<script>
    $(document).ready(function(){
      <?php foreach ($address_map as $input): ?>$('#<?= $option['input_name']; ?>').addressPickerByGiro({distanceWidget: true});
      <?php 
      endforeach; 
      ?>

      <?php foreach ($editor_wysiwyg as $input): ?>CKEDITOR.replace('<?= $field_all[$input]['input_name']; ?>'); 
      var <?= $field_all[$input]['input_name']; ?> = CKEDITOR.instances.<?= $field_all[$input]['input_name']; ?>;
      <?php endforeach; ?>
       
      $('#btn_cancel').click(function(){
        swal({
            title: "Are you sure?",
            text: "the data that you have created will be in the exhaust!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            cancelButtonText: "No!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + '{table_name}';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        <?php foreach ($editor_wysiwyg as $input): ?>$('#<?= $field_all[$input]['input_name']; ?>').val(<?= $field_all[$input]['input_name']; ?>.getData());
        <?php endforeach; ?>
    
        var form_{table_name} = $('#form_{table_name}');
        var data_post = form_{table_name}.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_{table_name}.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#{table_name}_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            $('.data_file_uuid').val('');
    
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        });
    
        return false;
      }); /*end btn save*/
      
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


        ?>
       var params = {};
       params[csrf] = token;

       $('#{table_name}_<?= $field_all[$input]['input_name']; ?>_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/{table_name}/upload_<?= $field_all[$input]['input_name']; ?>_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/{table_name}/delete_<?= $field_all[$input]['input_name']; ?>_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + '{table_name}/get_<?= $field_all[$input]['input_name']; ?>_file/{php_open_tag_echo} ${table_name}->{primary_key}; {php_close_tag}',
             refreshOnRequest:true
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
                  $.get(BASE_URL + '/{table_name}/delete_<?= $field_all[$input]['input_name']; ?>_file/' + uuid);
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