
<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<link rel="stylesheet" href="<?= BASE_ASSET; ?>editor/dist/css/medium-editor.css">
<link rel="stylesheet" href="<?= BASE_ASSET; ?>editor/dist/css/themes/beagle.css">

<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<?php $this->load->view('core_template/fine_upload'); ?>
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<link rel="stylesheet" type="text/css" href="<?= BASE_ASSET; ?>spectrum/spectrum.css">

<script src="<?= BASE_ASSET; ?>ace-master/build/src/ace.js"></script>
<script src="<?= BASE_ASSET; ?>ace-master/build/src/ext-language_tools.js"></script>
<script src="<?= BASE_ASSET; ?>ace-master/build/src/ext-beautify.js"></script>

<script src="<?= BASE_ASSET; ?>iframe-auto/release/jquery.browser.js"></script>
<script src="<?= BASE_ASSET; ?>iframe-auto/src/jquery-iframe-auto-height.js"></script>

<script type="text/javascript" src="<?= BASE_ASSET; ?>spectrum/spectrum.js"></script>
<script type="text/javascript" src="<?= BASE_ASSET; ?>js/page.js"></script>

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
        Page        <small>Update Page</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('page'); ?>">Page</a></li>
        <li class="active">Update</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-page" style="border-top: none; overflow: hidden">
                <div class="box-body  padding-left-0 padding-right-0">

                         <!-- Custom Tabs -->
                        <div class="nav-tabs-custom padding-left-0 tab-page ">
                          <ul class="nav nav-tabs">
                            <li class="active"><a class=" active tab_animation" href="#tab_1" data-toggle="tab"><i class="fa fa-gear text-green"></i> Page Settings</a></li>
                            <li><a class=" active btn-form-preview tab_animation" href="#tab_2" data-toggle="tab"><i class="fa fa-code text-green"></i> Page Designer</a></li>
                            <li class="pull-right"><a href="#tab_preview" class="text-muted btn-danger btn-mode btn-mode-phone btn"><i class="fa fa-mobile-phone "></i></a></li>
                            <li class="pull-right"><a href="#tab_preview" class="text-muted btn-danger btn-mode btn-mode-tablet btn"><i class="fa fa-tablet"></i></a></li>
                            <li class="pull-right"><a href="#tab_preview" class="text-muted btn-danger active btn-mode btn-mode-desktop btn"><i class="fa fa-desktop"></i></a></li>
                            <li class="pull-right"><a href="#tab_preview" data-toggle="tab" class="text-muted btn-danger btn-mode-preview btn text-green">Preview</a></li>
                            <li class="pull-right">
                             <span class="loading2 loading-hide">
                             <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                             <i>Loading, Generating Preview</i>
                             <input type="hidden" id="preview_page_name" >
                            </li>
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane rest-page-test active" id="tab_1" style="margin-top:20px;">
                              <div class="box box-widget widget-user-2">
                                  
                                   <?= form_open('', [
                                        'name'    => 'form_page', 
                                        'class'   => 'form-horizontal', 
                                        'id'      => 'form_page', 
                                        'enctype' => 'multipart/form-data', 
                                        'method'  => 'POST'
                                        ]); ?>
                                     
                                    <div class="form-group ">
                                        <label for="title" class="col-sm-2 control-label">Title 
                                        <i class="required">*</i>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?= set_value('title', $page->title); ?>">
                                            <small class="info help-block">
                                            <b>Format Title must</b> Alpha Numeric Spaces.</small>
                                        </div>
                                    </div>
                                                             
                                    <div class="form-group  wrapper-options-crud">
                                        <label for="type" class="col-sm-2 control-label">Type 
                                        <i class="required">*</i>
                                        </label>
                                        <div class="col-sm-8">
                                                <div class="col-sm-2 padding-left-0">
                                                <label>
                                                <input type="radio" class="flat-red" name="type" value="frontend" <?= $page->type == 'frontend' ? 'checked' : ''; ?>> frontend                                    
                                                </label>
                                                </div>
                                                <div class="col-sm-2 padding-left-0">
                                                <label>
                                                <input type="radio" class="flat-red" name="type" value="backend" <?= $page->type == 'backend' ? 'checked' : ''; ?>> backend                                    
                                                </label>
                                                </div>
                                                </select>
                                            <div class="row-fluid clear-both">
                                            <small class="info help-block">
                                            </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="link" class="col-sm-2 control-label">Link 
                                        <i class="required">*</i>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="link" id="link" placeholder="Link" value="<?= set_value('link', $page->link); ?>">
                                            <small class="info help-block page-url-help-block">
                                            ex : about-me
                                            </small>
                                        </div>
                                    </div>
                                                             
                                    <div class="form-group ">
                                        <label for="keyword" class="col-sm-2 control-label">Keyword 
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keyword" value="<?= set_value('keyword', $page->keyword); ?>">
                                            <small class="info help-block">
                                            Keyword for meta data.
                                            </small>
                                        </div>
                                    </div>
                                                             
                                    <div class="form-group ">
                                        <label for="description" class="col-sm-2 control-label">Description 
                                        </label>
                                        <div class="col-sm-8">
                                            <textarea id="description" name="description" rows="5" class="textarea"><?= set_value('description', $page->description); ?></textarea>
                                            <small class="info help-block">
                                            Description for meta data.
                                            </small>
                                        </div>
                                    </div>
                                                             
                                    <div class="form-group ">
                                        <label for="template" class="col-sm-2 control-label">Template 
                                        <i class="required">*</i>
                                        </label>
                                        <div class="col-sm-8">
                                           
                                            <label>
                                              <div class="layout-icon-wrapper">
                                                  <div class="layout-icon">
                                                  </div>
                                                  <div class="layout-info">Blank</div>
                                                  <input type="radio" name="template" value="blank" <?= $page->template == 'blank' ? 'checked' : ''; ?>>
                                              </div>
                                            </label>
                                             <label>
                                              <div class="layout-icon-wrapper">
                                                  <div class="layout-icon layout-icon-default">
                                                    <div class="square-vertical">
                                                    </div>
                                                    <div class="square-horizontal">
                                                    </div>
                                                  </div>
                                                  <div class="layout-info">Default</div>
                                                  <input type="radio" name="template" value="default" <?= $page->template == 'default' ? 'checked' : ''; ?>>
                                              </div>
                                            </label>
                                            <small class="info help-block">
                                            </small>
                                        </div>
                                    </div>

                       
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
                                        <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                                        <i>Loading, Saving data</i>
                                        </span>
                                    </div>
                                    <?= form_close(); ?>
                                                
                              </div>
                            </div><!-- end tab1 -->

                          <div class="tab-pane" id="tab_preview">
                          <div class="windows">
                          <div class="win-bar">
                            <div class="win-bar-responsive">
                              <div class="win-icon bg-red btn-close"></div>
                              <div class="win-icon bg-yellow btn-full-screen"></div>
                              <div class="win-icon bg-green btn-minimize"></div>
                            </div>
                          </div>
                          </div>
                          <iframe class="iframe-page-preview" scrolling="no" width="100%"  style="overflow: none; border:none" ></iframe>
                          </div>

                            <div class="tab-pane" id="tab_2">
                              <div class=" page-content">
                                <div class="windows ">
                                  <div class="win-bar">
                                    <div class="win-icon bg-red btn-close"></div>
                                    <div class="win-icon bg-yellow btn-full-screen"></div>
                                    <div class="win-icon bg-green btn-minimize"></div>
                                  </div>
                                  <div class="win-content" id="content" name="content editable">
                                    <div class="win-content-loading-container display-none ">
                                      <div class="win-content-loading no-select" contenteditable="false">
                                       <div id="fountainG">
                                          <div id="fountainG_1" class="fountainG"></div>
                                          <div id="fountainG_2" class="fountainG"></div>
                                          <div id="fountainG_3" class="fountainG"></div>
                                          <div id="fountainG_4" class="fountainG"></div>
                                          <div id="fountainG_5" class="fountainG"></div>
                                          <div id="fountainG_6" class="fountainG"></div>
                                          <div id="fountainG_7" class="fountainG"></div>
                                          <div id="fountainG_8" class="fountainG"></div>
                                        </div>
                                      </div>
                                    </div>
                                    <ul class="element-sortable " id="draggable">
                                    <?= $page->fresh_content; ?>
                                    </ul>
                                  </div>
                                </div>

                                <div class="btn-round-element noselect " title="Add Block Element" data-toggle="control-sidebar">
                                <span>+</span>
                                </div>
                            </div><!-- end content -->
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
<aside class="control-sidebar control-sidebar-dark toolbox-form"  style="height: 100%; overflow-y: auto;">
<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#tab-element" data-toggle="tab" aria-expanded="true"><i class="fa fa-code text-green"></i> Element</a></li>
      <li class=""><a href="#tab-component" data-toggle="tab" aria-expanded="false"><i class="fa  fa-puzzle-piece text-green"></i> Component</a></li>

    </ul>
  <div class="tab-content" style="height: 100%">
    <div class="tab-pane padding-left-0 active" id="tab-element">
      <h4 class="control-sidebar-heading"><i class="fa fa-bars"></i> Block</h4>
      <div class="tool-wrapper">
        <ul class="block-list">
          <li><a href="#" id="btn-all-element"> All Elements</a></li>
          <?= $this->cc_page_element->displayPageElement(); ?>
          
        </ul>
      </div>
    </div>
  <div class="tab-pane padding-left-0" id="tab-component">
      <h4 class="control-sidebar-heading"><i class="fa fa-bars"></i> Component</h4>
      <div class="component-wrapper">
      </div>
    </div>


  </div>
</aside>

<aside class=" toolbox-detail-element "  style="width:300px;background:rgb(249, 249, 249);height: 100%; overflow-y: auto; box-shadow: rgba(0, 0, 0, 0.1) 0px 6px 1px 6px; ">
  <div class="tab-content  tab-detail-element" style="height: 100%">
    <h4 class="control-sidebar-heading"><i class="fa fa-cubes"></i> Detail Element <a href="" class="badge bg-muted close-sidebar pull-right" title="close">+</a></h4>
    <div class="tool-wrapper" >
       <div class="nav-tabs-custom-element padding-left-0" >
          <!-- render in cc page element -->
        </div><!-- end nav tab -->
    </div>
    <div class="col-md-12 style-type">
      <br>
      <br>
      <br>
    </div>
     <div class="divider"></div>
     <a href="#" class="btn btn-success btn-flat btn-block btn-apply-element" style="clear: both"> Apply Changes</a>
     <div class="row-fluid box-action" >
        <a href="#" class="btn btn-success btn-flat btn-xs col-md-4 btn-clone-element"> <i class="fa fa-copy"> </i> clone</a>
        <a href="#" class="btn btn-warning btn-flat btn-xs col-md-4 btn-reset-element"> <i class="fa fa-refresh"> </i> reset</a>
        <a href="#" class="btn btn-danger btn-flat btn-xs col-md-4 btn-remove-element"> <i class="fa fa-trash"> </i> remove</a>
     </div>
    </div>
  </div>
</aside>

<!-- Page script -->
<script>
$(document).ready(function() {
    $('.btn_save').click(function() {
        $('.message').fadeOut();

        var form_page = $('#form_page');
        var data_post = form_page.serializeArray();
        var save_type = $(this).attr('data-stype');

        var content = '';
        var plate = $('.win-content ul').html();

        $(document).find('.win-content ul li.block-item').each(function() {
            content += $(this).find(' .block-content').html();
        });

        data_post.push({
            name: 'save_type',
            value: save_type
        });
        data_post.push({
            name: 'content',
            value: content
        });
        data_post.push({
            name: 'plate',
            value: plate
        });

        $('.loading').show();

        $.ajax({
                url: BASE_URL + '/page/edit_save/<?= $page->id; ?>',
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
                    $('.chosen option').prop('selected', false).trigger('chosen:updated');
                } else {
                    $('.message').printMessage({
                        message: res.message,
                        type: 'warning'
                    });
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
            });

        return false;
    }); /*end btn save*/

    /*load editors*/
    loadEditors();

    /*adding holder on canvas*/
    addHolderOnCanvas();

    /*load spectrum*/
    loadSpectrum();

    /*load spectrum*/
    updateLayoutType();

}); /*end doc ready*/
</script>