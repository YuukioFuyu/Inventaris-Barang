<link rel="stylesheet" type="text/css" href="<?= BASE_ASSET; ?>css/form.css">
<link rel="stylesheet" href="<?= BASE_ASSET; ?>jquery-switch-button/jquery.switchButton.css">
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCOi5vktJx2fjOA4X9orhT_-v2SIvsv060 "></script>
<link href="<?= BASE_ASSET; ?>jquery-map/dist/jquery.addressPickerByGiro.css" rel="stylesheet" media="screen">
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

<script src="<?= BASE_ASSET; ?>jquery-map/dist/jquery.addressPickerByGiro.js"></script>
<link href="<?= BASE_ASSET; ?>dist/jquery.addressPickerByGiro.css" rel="stylesheet" media="screen">
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Form
      <small>New Form</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('form'); ?>">Form</a></li>
      <li class="active">New</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row" >
      <div class="col-md-12 col-box-form">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header ">
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="Form Avatar">
                     </div>
                     <!-- /.widget-form-image -->
                     <h3 class="widget-user-username">Form</h3>
                     <h5 class="widget-user-desc">New Form</h5>
                     <hr>
                  </div>
                  <?= form_open('', [
                     'name'    => 'form_form', 
                     'class'   => 'form-horizontal', 
                     'id'      => 'form_form', 
                     'method'  => 'POST'
                     ]); ?>
                  <input type="hidden" name="id" id="id">
                  <div class="form-group ">
                     <label for="label" class="col-sm-2 control-label">Subject <i class="required">*</i></label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" value="<?= set_value('subject'); ?>">
                        <small class="info help-block">The subject of form.</small>
                     </div>
                  </div>
                  <div class="form-group ">
                     <label for="label" class="col-sm-2 control-label">Title </label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?= set_value('title'); ?>">
                        <small class="info help-block">The title of form.</small>
                     </div>
                  </div>
                  <hr>
                
               <div class="col-md-12 padding-left-0 padding-right-0">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                          <ul class="nav nav-tabs">
                            <li class="active"><a class=" active btn-form-designer" href="#tab_1" data-toggle="tab"><i class="fa fa-code text-green"></i> Form Designer</a></li>
                            <li><a class=" active btn-form-preview" href="#tab_2" data-toggle="tab"><i class="fa fa-tv text-green"></i> Form Preview</a></li>
                            <li> <span class="loading3 loading-hide "><img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> <i>Loading, Getting data</i></span></li>
                            <li class="pull-right"><a href="#" data-toggle="control-sidebar" class="text-muted btn-tool">Tools <i class="fa fa-gear"></i></a></li>

                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane rest-page-test active" id="tab_1">
                              <div class="wrapper-form">
                               <table class="table table-responsive table table-striped table-form"  id="diagnosis_list">
                               <tbody>
                                 <tr class="sort-placeholder">
                                   <td colspan="4">Drag Form Here</td>
                                 </tr>
                               </tbody>
                               </table>
                              </div>
                               <div class="view-nav">
                                 <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="save (Ctrl+s)"><i class="fa fa-save" ></i> Save</button>
                                 <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="save and back to the list (Ctrl+d)"><i class="ion ion-ios-list-outline" ></i> Save and Go to The List</a>
                                 <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="cancel (Ctrl+x)"><i class="fa fa-undo" ></i> Cancel</a>
                                 <span class="loading loading-hide"><img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> <i>Loading, Saving data</i></span>
                              </div>
                            </div>
                            <div class="tab-pane rest-page-test" id="tab_2">
                              <div class="preview-form display-none">
                              </div>
                            </div>

                          </div>
                        </div>
                    </div>
                 
                  <div class="validation_rules" style="display: none">
                     <option value="" class="<?= $this->model_form->get_input_type(); ?>"></option>
                     <?php foreach (db_get_all_data('crud_input_validation') as $input): ?>
                       <option value="<?= $input->validation; ?>" class="<?= str_replace(',', ' ', $input->group_input); ?>" title="<?= $input->input_able; ?>" data-placeholder="<?= $input->input_placeholder; ?>" ><?= ucwords(clean_snake_case($input->validation)); ?></option>
                      <?php endforeach; ?> 
                  </div>
                  <div class="message no-message-padding">
                  </div>
                 
                  <?= form_close(); ?>
               </div>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->
      </div>
   </div>

  <?php $this->load->view('backend/app-menu/form/form_component'); ?>
  <div class="btn-round-element noselect " title="Add Block Element" data-toggle="control-sidebar">
  <span>+</span>
  </div>
</section>

<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script src="<?= BASE_ASSET; ?>/float-thead/jquery.floatThead.min.js"></script>
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<script src="<?= BASE_ASSET; ?>js/form.js"></script>
<script>
$(document).ready(function() {
    $('#id').val('');

    $(document).find("#diagnosis_list tbody").sortable({
        helper: fixHelperModified,
        handle: 'td:first',
        start: function() {
            $(this).addClass('target-area');
            updatePlaceHolder();
        },
        stop: function(event, ui) {
            renumber_table('#diagnosis_list');
            updatePlaceHolder();
        }
    });

    $(document).on('change', 'input.switch-button', function() {
        if ($(this).prop('checked')) {
            $(this).parents('.box-setting').find('.input_setting').fadeOut('easeInOutQuart');
        } else {
            $(this).parents('.box-setting').find('.input_setting').focus().fadeIn('easeInOutQuart');
        }
    });

    $(document).find(".trash").sortable({
        connectWith: $(document).find("#diagnosis_list tbody"),
    });

    $("#tools tbody").sortable({
        connectWith: $(document).find("#diagnosis_list tbody"),
        helper: 'clone',
        placeholder: "ui-state-highlight",
        start: function(ui, event) {
            $('.toolbox-form').css('overflow', '');
            $('.toolbox-form').css('overflow-y', '');
            updatePlaceHolder();
        },
        remove: function(event, ui) {
            ui.item.enableSelection().clone().prependTo($(".toolbox-form .tool-wrapper table tbody"));
            $('.toolbox-form').css('overflow-y', 'auto');
            updatePlaceHolder();
            renumber_table('#diagnosis_list');
            var id_field = getUnixId();
            var tpl = ui.item.html()
                .replaceAll('{field_name}', 'field_' + id_field)
                .replaceAll('{field_id}', id_field);

            ui.item.replaceWith('<tr class="new-item-sortable">' + tpl + '</tr>');

            var new_item_sortable = $('.new-item-sortable');

            new_item_sortable.find('.chosen-select').chosen('destroy');
            new_item_sortable.find('#input_type_chosen, #validation_chosen,#relation_table_chosen, #relation_value_chosen, #relation_label_chosen').remove();
            new_item_sortable.find('.chosen-select').chosen();

            /*added default validation rules*/
            new_item_sortable.find('.validation').each(function() {
                var id = $(this).parents('tr').find('#form-id').val();
                var name = $(this).parents('tr').find('#form-name').val();

                addValidation($(this), id, name, 'required', 'no');
            });

            new_item_sortable.find('.switch-button').switchButton({
                labels_placement: 'right',
                on_label: 'yes',
                off_label: 'no'
            });

            $('.new-item-sortable').removeClass('new-item-sortable');

        }
    }).disableSelection();

    function updatePlaceHolder() {
        if ($('.table-form tr[class!="sort-placeholder"]').length <= 0) {
            $('.table-form .sort-placeholder').show();
        } else {
            $('.table-form .sort-placeholder').hide();
        }
    }

    /*update validation*/
    $(document).find('table tr .input_type').each(function() {
        updateValidation($(this));

        var relation = $(this).find('option:selected').attr('relation');
        var custom_value = $(this).find('option:selected').attr('custom-value');
        var table_relation = $(this).parents('td').find('.relation_table');
        var custom_option_container = $(this).parents('td').find('.custom-option-container');

        if (relation == 1) {
            table_relation.val('').trigger('chosen:updated').parents('.form-group').show();

        } else {
            $(this).parents('td').find('.relation_field').parents('.form-group').hide();
            $(this).parents('td').find('.relation_field').val('');
        }

        if (custom_value == 1) {
            custom_option_container.show();

        } else {
            custom_option_container.hide();
        }
    });

    $('input[type="checkbox"].preview').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    $('.btn-tool').click(function(event) {
        $('.toolbox-form').css('overflow-y', 'auto');

        return false;
    });

    $('.btn-form-designer').click(function(event) {
        $('.control-sidebar').addClass('control-sidebar-open');
        buttonToggleSideBarClose($('.btn-round-element'));
    });

    var preview = $('#preview');

    $('.btn-form-preview').click(function() {
        if ($('.table-form tr[class!="sort-placeholder"]').length <= 0) {
            $('.control-sidebar').addClass('control-sidebar-open');
            toastr['warning']('Please make form first');
            buttonToggleSideBarOpen($('.btn-round-element'));
            return false;
        }
        $('.control-sidebar').removeClass('control-sidebar-open');
        $('.loading3').show();

        var form_form = $('#form_form');
        var data_post = form_form.serialize();
        $('.preview-form').html('');

        $.ajax({
                url: BASE_URL + '/form/preview',
                type: 'POST',
                dataType: 'json',
                data: data_post,
            })
            .done(function(res) {
                $('.message').html('');
                if (res.success) {
                    $('.preview-form').html(res.html);
                    $('.preview-form').show();
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
                    message: 'Error getting data',
                    type: 'warning'
                });
            })
            .always(function() {
                $('.loading3').hide();
            });
    });

    $('.btn_save').click(function() {
        $('.message').hide();

        var form_form = $('#form_form');
        var data_post = form_form.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({
            name: 'save_type',
            value: save_type
        });

        $('.loading').show();

        $.ajax({
                url: BASE_URL + '/form/add_save',
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

                    if (typeof res.id != 'undefined') {
                        $('#id').val(res.id);
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

    //Helper function to keep table row from collapsing when being sorted
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        return $helper;
    };

    //Renumber table rows
    function renumber_table(tableID) {
        $(tableID + " tr").each(function() {
            count = $(this).parent().children().index($(this)) + 1;
            $(this).find('.priority').val(count);
        });
    }
}); /*end doc ready*/
</script>