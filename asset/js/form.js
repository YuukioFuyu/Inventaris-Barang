/*replace all string*/
String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};

function getUnixId() {
    return time_in_ms = Date.now();
}


function buttonToggleSideBarOpen(elem) {
    elem.addClass('close-btn');
    elem.data('state', 2);
}

function buttonToggleSideBarClose(elem) {
    elem.data('state', 1);
    elem.removeClass('close-btn');
}


function updateValidation(target) {
    var validation_group = target.find('option:selected').attr('title');

    var options = $('.validation_rules option.' + validation_group).clone().filter(function(index, elem) {
        return elem;
    });
    target.parents('tr').find('.box-validation').each(function(index, el) {
        if (!$(this).hasClass(validation_group)) {
            $(this).remove();
        }
    });
    target.parents('tr').find('.validation').html(options).trigger('chosen:updated');
}

function addValidation(target, id, name, type, input_able, input_value, input_placeholder) {
    if (!target.parents('td').find('.box-validation.' + type).length) {

        if (typeof input_value == 'undefined') {
            var input_value = '';
        }

        if (typeof input_placeholder == 'undefined') {
            var input_placeholder = '';
        }

        var group_validation = target.find('option:selected').attr('class');

        if (input_able == 'yes') {
            var input = '<input value="' + input_value + '" placeholder="' + input_placeholder + '" class="input_validation" name="form[' + id + '][' + name + '][validation][rules][' + type + ']" >';
            var class_validation_name = 'validation-name';
        } else {
            var input = '<input type="hidden" class="input_validation" name="form[' + id + '][' + name + '][validation][rules][' + type + ']" >';
            var class_validation_name = 'validation-name-max';
        }


        target.parents('td').append('<div class="box-validation ' + group_validation + ' ' + type + '"> <label><div class="' + class_validation_name + '">' + type.replaceAll('_', ' ') + '</div> ' + input + '</label> <a class="delete fa fa-trash"></a> </div>');
        target.parents('td').find('.box-validation.' + type + ' input').focus();
    }
    target.val('').trigger('chosen:updated');
}

$(document).ready(function() {

    $('.btn-round-element').click(function() {
        var state = $(this).data('state');
        $('.toolbox-detail-element').removeClass('toolbox-detail-element-open');

        switch (state) {
            case 1:
            case undefined:
                buttonToggleSideBarOpen($(this));
                break;
            case 2:
                buttonToggleSideBarClose($(this));
                break;
        }
    });

    $(document).on('keyup', 'table tr td input.field_label, table tr td input.field_name', function(event) {
      var value = $(this).val().replaceAll(/[^0-9a-z]/gi, '_').replaceAll(/_+/g, '_').toLowerCase();

      $(this).parents('td').find('.field_name').val(value);
    });

	$('table tr i.btn-collapse-setting').each(function() {
	    $(this).parents('tr').find('.setting-container .box-setting').not(':eq(0)').slideUp('hight', 'easeInOutQuart');
	    $(this).parents('tr').find('.setting-container .box-setting').eq(0).addClass('active-border');
	    $(this).addClass('fa-plus');
	    $(this).removeClass('fa-minus');
	});

    $(document).on('change', 'table tr .validation', function() {
        var type = $(this).val();
        var input_able = $(this).find('option:selected').attr('title');
        var input_placeholder = $(this).find('option:selected').attr('data-placeholder');
        var id = $(this).parents('tr').find('#form-id').val();
        var name = $(this).parents('tr').find('#form-name').val();

        addValidation($(this), id, name, type, input_able, '', input_placeholder);
    }); /*end validation change*/

    $(document).on('click', 'table tr a.delete', function() {
        $(this).parents('.box-validation').remove();
    }); /*end delte click*/

    /*update validation rules on input type change*/
    $(document).on('change', 'table tr .input_type', function() {
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

    $(document).on('change', 'table tr .relation_table', function() {
        var relation_value = $(this).parents('td').find('.relation_value');
        var relation_label = $(this).parents('td').find('.relation_label');
        var table_name = $(this).val();

        relation_value.parents('.form-group').show();
        relation_label.parents('.form-group').show();

        $.get(BASE_URL + '/form/get_list_field_id/' + table_name, function(data) {
                var res = $.parseJSON(data);

                if (res.success) {
                    relation_value.html(res.html);
                    relation_value.trigger('chosen:updated');

                    relation_label.html(res.html);
                    relation_label.trigger('chosen:updated');
                } else {
                    $('.message').printMessage({
                        message: res.message,
                        type: 'warning'
                    });
                    $('.message').fadeIn();
                }
            }).fail(function() {
                $('.message').printMessage({
                    message: 'Error getting data',
                    type: 'warning'
                });
            })
            .always(function() {
                $('.loading').hide();
            });

        $.get(BASE_URL + '/form/get_list_field_label/' + table_name, function(data) {
                var res = $.parseJSON(data);

                if (res.success) {
                    relation_label.html(res.html);
                    relation_label.trigger('chosen:updated');
                } else {
                    $('.message').printMessage({
                        message: res.message,
                        type: 'warning'
                    });
                    $('.message').fadeIn();
                }
            }).fail(function() {
                $('.message').printMessage({
                    message: 'Error getting data',
                    type: 'warning'
                });
            })
            .always(function() {
                $('.loading').hide();
            });

    });

    /*custom option*/
    $(document).on('click', 'table tr a.add-option', function() {
        var type = $(this).val();
        var id = $(this).parents('tr').find('#form-id').val();
        var name = $(this).parents('tr').find('#form-name').val();
        var type = $(this).parents('td').find('.custom-option-container ').attr('data-type');
        if (typeof type == 'undefined') {
        	type = 'option';
        }
        var time_in_ms = Date.now();
        var option = '<div class="custom-option-item custom-option-' + time_in_ms + '">' +
            '<div class="box-custom-option input padding-left-0 box-top"> ' +
            '<div class="col-md-3">value</div>  <input class="input_validation" name="form[' + id + '][' + name + '][custom_'+type+'][' + time_in_ms + '][value]" value="" type="text"></label>' +
            '</div>' +
            '<div class="box-custom-option input padding-left-0 box-bottom"> ' +
            '<div class="col-md-3">label</div>  <input class="input_validation" name="form[' + id + '][' + name + '][custom_'+type+'][' + time_in_ms + '][label]" value="" type="text">' +
            '</div>' +
            '<a class="text-red delete-option fa fa-trash" data-original-title="" title=""></a> ' +
            '</div>';

        $(this).parents('td').find('.custom-option-contain').append(option);
        $('.custom-option-' + time_in_ms).hide().slideDown();
        $('.custom-option-' + time_in_ms).find('input')[0].focus();

        if (type == 'attributes') {
            var btn_add_option = $(this).parents('td').find('i.btn-collapse-attributes');
            
        	$(this).parents('td').find('.custom-option-contain').slideDown();

            btn_add_option.data('state', 1);
            btn_add_option.removeClass('fa-plus');
            btn_add_option.addClass('fa-minus');
        }
    }); /*end option on click*/

    $(document).on('keydown', 'div.custom-option-item input', function(event){
        if(event.keyCode == 13){
            $(this).parents('.custom-option-container').find('a.add-option').trigger('click');
            event.preventDefault();
            return false;
        }
    });

    $(document).on('click', 'table tr a.delete-option', function() {
        $(this).parents('.custom-option-item').slideUp('fast', 'easeInOutQuart', function(){
        	$(this).remove();
        });
        return;
    }); /*end delte click*/

    $(document).on('click', 'table tr i.delete-item', function() {
        $(this).parents('tr').slideUp('fast', 'easeInOutQuart', function(){
        	$(this).remove();
        });
        return;
    }); /*end delte click*/

    $(document).on('click', 'table tr .custom-option-container i.btn-collapse-option, table tr i.btn-collapse-attributes', function() {
        var state = $(this).data('state');

        switch (state) {
            case 1:
            case undefined:
                $(this).parents('td').find('.custom-option-contain').slideUp();
                $(this).data('state', 2);
                $(this).addClass('fa-plus');
                $(this).removeClass('fa-minus');
                break;
            case 2:
                $(this).parents('td').find('.custom-option-contain').slideDown();
                $(this).data('state', 1);
                $(this).removeClass('fa-plus');
                $(this).addClass('fa-minus');
                break;
        }
    });

    $(document).on('click', 'table tr i.btn-collapse-setting', function() {
        var state = $(this).data('state');
        switch (state) {
            case 1:
            case undefined:
                $(this).parents('tr').find('.setting-container .box-setting').not(':eq(0)').slideDown('hight', 'easeInOutQuart');
                $(this).parents('tr').find('.setting-container .box-setting').eq(0).removeClass('active-border');
                $(this).data('state', 2);
                $(this).removeClass('fa-plus');
                $(this).addClass('fa-minus');
                break;
            case 2:
                $(this).parents('tr').find('.setting-container .box-setting').not(':eq(0)').slideUp('hight', 'easeInOutQuart');
                $(this).parents('tr').find('.setting-container .box-setting').eq(0).addClass('active-border');
                $(this).data('state', 1);
                $(this).addClass('fa-plus');
                $(this).removeClass('fa-minus');
                break;
        }
    });

    $('#btn_cancel').click(function() {
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
            function(isConfirm) {
                if (isConfirm) {
                    window.location.href = HTTP_REFERER;
                }
            });

        return false;
    }); /*end btn cancel*/
});