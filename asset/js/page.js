function unloadEditors() {
    $(document).find('.win-content .editable').each(function() {
        var id = $(this).prop('id');
        new MediumEditor('#' + id).destroy();
    });
}

function addHolderOnCanvas() {
    var holder = '<li class="holder" style="height: 400px; list-style:none">' +
        '<div class="start" id="start">' +
        '<center>' +
        '<span class="noselect btn-build-page no-select" contenteditable="false">Build your page by dragging elements into the canvas</span>' +
        '</center>' +
        '</div>' +
        '</li> ';

    if ($('.win-content ul li').length <= 0) {
        $('.win-content ul').append(holder);
    }
}

function loadEditors() {

    $(document).find('.win-content').each(function() {
        new MediumEditor('#' + $(this).attr('id'), {
            toolbar: {
                allowMultiParagraphSelection: true,
                buttons: CcMediumExtension.getButton(),
            },
            extensions: CcMediumExtension.getExtension()
        });
    });
}

function updateLayoutType() {
    $('.layout-icon-wrapper').each(function() {
        $(this).find('.layout-icon').removeClass('active');
        if ($(this).find('input').prop('checked')) {
            $(this).find('.layout-icon').addClass('active');
        }
    });
}

function loadSpectrum() {
    $(document).find('.spectrum-basic').spectrum({
        allowEmpty: true,
        showInput: true,
        containerClassName: "full-spectrum",
        showInitial: true,
        showPalette: true,
        showSelectionPalette: true,
        showAlpha: true,
        maxPaletteSize: 10,
        preferredFormat: "hex",
        localStorageKey: "spectrum.cicool"
    });
}

function getColorSpectrum(target) {
        return $(target).parents('.style-type').find('.sp-replacer .sp-preview .sp-preview-inner').css('background-color');
    }
    /*replace all string*/
String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};


$(document).ready(function() {
    $('#preview_page_name').val('');
    
    /*render tab*/
    CcPageElement.renderTab($('.nav-tabs-custom-element'));

    /*render component*/
    CcPageElement.renderComponent($('.component-wrapper'));


    $(document).on('keyup', '#title', function(event) {
      var link = $(this).val().replaceAll(/[^0-9a-z]/gi, '-').replaceAll(/_+/g, '-').toLowerCase();
      var title = $(this).val().replaceAll(/[^0-9a-z ]/gi, ' ').toLowerCase().replaceAll(/ +/g, ' ').toLowerCase();

      $('#link').val(link);
      $('#title').val(title);
    });

    $(document).on('keyup', '#link', function(event) {
      var link = $(this).val().replaceAll(/[^0-9a-z]/gi, '-').replaceAll(/-+/g, '-').toLowerCase();

      $('#link').val(link);
    });

    $(document).on('click', 'a.remove-component', function(event) {
        event.preventDefault();
        $(this).parent('.component-list').remove();
    });

    $('.btn-mode-phone').click(function() {
        checkPreview();
        resetMode();
        $('.iframe-page-preview').addClass('col-md-4 col-md-offset-4 border-windows');
        $('.iframe-page-preview').iframeAutoHeight();
        setTimeout(function() {
            $('.iframe-page-preview').iframeAutoHeight();
        }, 2000);
        $(this).addClass('active');
        $('.win-bar-responsive').addClass('col-md-offset-4');

        return false;
    });

    $('.btn-mode-tablet').click(function() {
        checkPreview();
        resetMode();
        $('.iframe-page-preview').addClass('col-md-8 col-md-offset-2 border-windows');
        $('.iframe-page-preview').iframeAutoHeight();
        setTimeout(function() {
            $('.iframe-page-preview').iframeAutoHeight();
        }, 2000);
        $(this).addClass('active');
        $('.win-bar-responsive').addClass('col-md-offset-2');

        return false;
    });

    $('.btn-mode-desktop').click(function() {
        checkPreview();
        resetMode();
        $('.iframe-page-preview').addClass('col-md-12');
        setTimeout(function() {
            $('.iframe-page-preview').removeClass('col-md-12');
        }, 1700, function() {
            $('.iframe-page-preview').iframeAutoHeight();
        });
        $(this).addClass('active');

        return false;
    });

    $('.iframe-page-preview').on('load', function() {
        $('.iframe-page-preview').iframeAutoHeight();
        $('.loading2').hide();
    });


    $('.btn-mode-preview').click(function() {
        var data_preview = [];
        var content = '';

        $(document).find('.win-content ul .block-item').each(function() {
            content += $(this).find(' .block-content').html();
        });

        if (content.length <= 0) {
            toastr['error']('Please create a page first');
            $('.nav-tabs li a[href="#tab_2"]').tab('show');
            return;
        }

        data_preview.push({
            name: 'content',
            value: content
        });
        data_preview.push({
            name: csrf,
            value: token
        });
        data_preview.push({
            name: 'preview_name',
            value: $('#preview_page_name').val()
        });
        $('.loading2').show();
        $.ajax({
                url: BASE_URL + '/page/preview',
                dataType: 'json',
                type: 'POST',
                data: data_preview,
            })
            .done(function(res) {
                if (res.success) {
                    $('.iframe-page-preview').attr('src', 'data:text/html,' + encodeURIComponent(res.preview_html));
                } else {
                    $('.message').printMessage({
                        message: res.message,
                        type: 'warning'
                    });
                }
            })
            .fail(function() {
                $('.message').printMessage({
                    message: 'Error save data',
                    type: 'warning'
                });
            })
            .always(function() {});

    });

    function checkPreview() {
        if ($('#preview_page_name').val().length <= 0) {
            $('.btn-mode-preview').trigger('click');
        }
    }

    function resetMode() {
        $('.btn-mode').removeClass('active');
        $('.iframe-page-preview').animate({
            left: '0%'
        }, 2000).removeClass('col-md-12  col-md-8 col-md-offset-2 col-md-4 col-md-offset-4  col-md-4 col-md-offset-4 border-windows');
        $('.win-bar-responsive').removeClass('col-md-offset-3 col-md-offset-4');
    }

    $('.windows .btn-full-screen').click(function() {
        $('.page-content').addClass('full-screen-window');
        $('.page-content').animate({
                width: '100%',
                height: '100%'
            },
            'fast');
        $('.toolbox-detail-element, .control-sidebar').addClass('z-index-top');
    });

    $('.windows .btn-minimize, windows .btn-close').click(function() {
        $('.page-content').removeClass('full-screen-window');
        $('.toolbox-detail-element, .control-sidebar').removeClass('z-index-top');
        $('.page-content').animate({
                width: 'auto',
                height: 'auto'
            },
            'fast');
    });

    $('.web-body').addClass('sidebar-collapse');
    $('.sidebar-toggle[data-toggle="offcanvas"]').hide();

    $(document).on('click', 'center span.btn-build-page', function() {
        $('.toolbox-form').addClass('control-sidebar-open');
        buttonToggleSideBarOpen($('.btn-round-element'));
    });

    var element_editable = '.win-content p';
    var element_editables = 'div,hr,header,section,aside,img,.element-editable,.fa,a,button,p, .btn, input,h1,h2,h3,h4,h5,h6,div:not(.not-editable), a:not(.not-editable), i:not(.not-editable), li, ul';
    var element_editable_list = element_editables.split(',');

    $.each(element_editable_list, function(index, val) {
        element_editable += ", .win-content .block-content " + val;
    });

    $(document).on({
        mouseenter: function() {
            addOutlineBlock(this);
        }
    }, element_editable);


    $(document).on('click', '.toolbox-detail-element .close-sidebar', function(event) {
        event.preventDefault();
        $('.toolbox-detail-element').removeClass('toolbox-detail-element-open');

    });

    $(document).on('click', element_editable, function(event) {
        event.preventDefault();

        var target_element = this;
        removeOutlineBlock();

        $('.toolbox-detail-element').addClass('toolbox-detail-element-open');
        $('.toolbox-form').removeClass('control-sidebar-open');

        $(this).addClass('editable-focused');
        $('.win-content *:not(.editable-focused)').css({
            'outline': '',
            'outline-offset': ''
        });;

        buttonToggleSideBarClose($('.btn-round-element'));
        addOutlineBlock(this);
        updateDetailElement(this);
        loadSpectrum();


        return false;
    });

    $(document).on('click', '.box-action .btn-reset-element', function(event) {
        event.preventDefault();

        var target_element = $(document).find('.editable-focused');

        updateDetailElement();
    });

    $(document).on('click', '.box-action .btn-remove-element', function(event) {
        event.preventDefault();
        var target_element = $(document).find('.editable-focused');

        target_element.remove();
    });

    $(document).on('click', '.box-action .btn-clone-element', function(event) {
        event.preventDefault();
        var target_element = $(document).find('.editable-focused');

        var new_block = $(target_element.parent().html());
        new_block = new_block.removeClass('.editable-focused');

        new_block.insertAfter(target_element);
    });

    $(document).on('click', '.toolbox-detail-element .btn-apply-element', function(event) {
        event.preventDefault();
        var target_element = $(document).find('.editable-focused');
        var box_detail_element = $('.toolbox-detail-element');

        CcPageElement.updateElement(target_element);

        toastr.options = {
            "positionClass": "toast-top-right",
            "newestOnTop": false,
            "preventDuplicates": true,
        }
        toastr['success']('Element successfully updated');

    });

    function updateDetailElement() {
        var target_element = $(document).find('.editable-focused');
        var box_detail_element = $('.toolbox-detail-element');

        CcPageElement.updateElementInformation(target_element);
    }

    function resetDetailElementData() {
        var box_detail_element = $('.toolbox-detail-element');

        box_detail_element.find('#font_size').val('');
        box_detail_element.find('#background_color').val('');
        box_detail_element.find('#font_family').val('');
        box_detail_element.find('#font_color').val('');
        box_detail_element.find('#font_size').val('');
    }

    $('body .box').click(function() {
        removeOutlineBlock();
    });

    $(document).on('mouseout', element_editable, function() {
        $(this).css({
            'outline': '',
            'outline-offset': ''
        });
    });

    function removeOutlineBlock() {
        $(document).find('.win-content .editable-focused').css({
            'outline': '',
            'outline-offset': ''
        }).removeClass('editable-focused');
    }

    function addOutlineBlock(target) {
        $(target).css({
            'outline': '2px solid rgba(233, 94, 94, 0.5)',
            'outline-offset': '-2px'
        });
    }

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

    function buttonToggleSideBarOpen(elem) {
        elem.addClass('close-btn');
        elem.data('state', 2);
    }

    function buttonToggleSideBarClose(elem) {
        elem.data('state', 1);
        elem.removeClass('close-btn');
    }

    $(document).on('click', '.block-item div.delete', function() {
        var parent = $(this).parents('.block-item');
        swal({
                title: "Are you sure?",
                text: "you want to delete this block? ",
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
                    parent.fadeOut('slow', function() {
                        parent.remove();
                        addHolderOnCanvas();
                    });
                }
            });

        return false;
    });


    $(document).on('click', '.block-item div.copy', function() {
        var parent = $(this).parents('.block-item');
        var new_block = $('<li class="block-item">' + parent.html() + '</li>');

        $(new_block).insertAfter(parent).hide().fadeIn('slow');
    });

    $(document).on('click', '.block-item div.source', function() {
        var source_parent = $(this).parents('.block-item');
        if (!source_parent.find('div.source-code').length) {
            source_parent.prepend(
                '<pre class="source-code" id="source-code" style="width:100%;resize: none;scroll:none;"></pre>'
            );
            source_parent.prepend(
                '<div class="btn-wrapper pull-right" style="margin-bottom:-10px; position:absolute; right:0%; z-index:99;">' +
                '<div class="btn btn-save-source btn-success btn-flat"><i class="fa fa-check fa-icon-save"></i></div>' +
                '<div class="btn btn-cancel-source btn-danger btn-flat"><i class="fa fa-close fa-icon-close"></i></div>' +
                '</div>'
            );
        }
        var code = source_parent.find('.block-content').html();

        source_parent.find('.source-code').html();
        source_parent.find('.source-code').height('200');

        ace.require("ace/ext/language_tools");
        var beautify = ace.require("ace/ext/beautify"); // get reference to extension

        var editor = ace.edit('source-code');
        editor.setOptions({
            enableBasicAutocompletion: true,
            enableSnippets: true,
            enableLiveAutocompletion: true
        });
        beautify.beautify(editor.session);
        editor.getSession().setMode("ace/mode/html");
        editor.setValue(code, 1);

        source_parent.find('.block-content').hide();
        source_parent.find('.nav-content-wrapper').hide();

    });

    $(document).on('click', '.block-item div.btn-save-source', function() {
        var source_parent = $(this).parents('.block-item');
        var editor = ace.edit('source-code');
        $('.toolbox-detail-element').removeClass('toolbox-detail-element-open');

        source_parent.find('.block-content').html(editor.getValue()).hide().fadeIn('slow');
        source_parent.find('.block-content').show();
        source_parent.find('.nav-content-wrapper').show();
        source_parent.find('.source-code, .btn-wrapper').remove();
    });


    $(document).on('click', '.block-item div.btn-cancel-source', function() {
        var source_parent = $(this).parents('.block-item');
        var editor = ace.edit('source-code');
        $('.toolbox-detail-element').removeClass('toolbox-detail-element-open');

        source_parent.find('.block-content').show();
        source_parent.find('.nav-content-wrapper').show();
        source_parent.find('.source-code, .btn-wrapper').remove();
        editor.destroy();
    });


    $('.block-list li a').click(function() {
        var state = $(this).data('state');
        switch (state) {
            case 1:
            case undefined:
                $(this).parents('li').find('ul').slideDown('slow', 'easeInOutQuart');
                $(this).data('state', 2);
                break;
            case 2:
                $(this).parents('li').find('ul').slideUp('slow', 'easeInOutQuart');
                $(this).data('state', 1);
                break;
        }

        return false;
    });

    $('.block-list li a#btn-all-element').click(function() {
        var state = $(this).data('states');
        var btn_all_element = $(this);

        $(document).find('.block-list li ul').slideDown();
        switch (state) {
            case 1:
            case 'undefined':
            case undefined:
            case null:
                $(document).find('.block-list li ul').slideDown();
                btn_all_element.data('states', 2);
                break;
            case 2:
                $(document).find('.block-list li ul').slideUp();
                btn_all_element.data('states', 1);
                break;
        }

        return false;
    });

    $(".win-content div").sortable({
        handle: '.handle',
        connectWith: ".win-content div",
        connectToSortable: '.win-content div',
        beforeStop: function(event, ui) {
            newItem = ui.item;
        },
        start: function(item, event) {
            removeOutlineBlock();
        },
    });

    $(document).find(".component-list").draggable({
        cursor: "crosshair",
        revert: "invalid",
        helper: 'clone',
        accept: '.component-item-wrapper',
        connectToSortable: '.win-content div, .win-content span, .win-content p',
        start: function(item, event) {
            $('.toolbox-form').css('overflow', '');
            $('.toolbox-form').css('overflow-y', '');
            removeOutlineBlock();
        },
        stop: function(item, event) {
            $('.toolbox-form').css('overflow', 'auto');
            $('.toolbox-form').css('overflow-y', 'auto');

            $(".win-content .column").sortable({
                handle: '.handle',
                receive: function(e, ui) {}
            });
            CcPageElement.onDropComponent($(newItem));
            updateWinContent();
            removeOutlineBlock();
        }
    });

    $(".block-list li ul li").draggable({
        connectToSortable: $(document).find(".element-sortable"),
        placeholder: "ui-state-highlight",
        accept: '.block-content',
        revert: function(valid_drop) {
            if (valid_drop) {
                $('.toolbox-form').removeClass('control-sidebar-open');
            }
            return true;
        },
        helper: 'clone',
        start: function(ui, event) {
            $('.toolbox-form').css('overflow', '');
            $('.toolbox-form').css('overflow-y', '');
            removeOutlineBlock();
        },
        stop: function(ui, event) {
            $('.toolbox-form').css('overflow-y', 'auto');
            $('.win-content .start').fadeOut();
            $(document).find('.win-content .preview-only').remove();
            $(document).find('li.holder').remove();

            updateWinContent();

            $(ui.target).attr('id', 'element_' + getUnixId());
            buttonToggleSideBarClose($('.btn-round-element'));
            addHolderOnCanvas();
            $(".win-content div").sortable({
                handle: '.handle',
                receive: function(e, ui) {}
            });
            removeOutlineBlock();
        }
    });

    /*replace all string*/
    String.prototype.replaceAll = function(search, replacement) {
        var target = this;
        return target.split(search).join(replacement);
    };


    function updateWinContent() {
        $(document).find('.win-content .component-preview-wrapper').remove();
        $(document).find('.win-content .component-item-wrapper').show();
        $(document).find('.win-content .component-list').css('width', '');

        $(document).find('.win-content ul li.block-item:not(.block-item-loaded)').each(function() {
            var container = $(this);
            var src = $(this).attr('data-src');
            var block_name = $(this).attr('data-block-name');

            container.hide();
            if (typeof src != 'undefined') {
                $('.win-content-loading-container').show();
                container.hide();
                $.ajax({
                        url: BASE_URL + 'page/get_html',
                        data: {
                            'url': BASE_URL + 'cc-content/page-element/' + src,
                            'base_element': BASE_URL + 'cc-content/page-element/' + block_name + '/',
                        },
                        dataType: 'JSON',
                    })
                    .done(function(data) {
                        if (data.success) {
                            container.find('.block-content').html(data.content);
                            $('.win-content-loading-container').fadeOut('slow');
                            container.addClass('block-item-loaded');
                            container.fadeIn('slow');
                        } else {
                            toastr['error'](data.message);
                            $('.win-content-loading-container').fadeOut('fast');
                        }
                    })
                    .fail(function() {
                        toastr['error']('error load data');
                        $('.win-content-loading-container').fadeOut('fast');
                    })
                    .always(function() {
                    });
            }
        });
        removeOutlineBlock();

    }

    $('.layout-icon-wrapper').on('click', function() {
        updateLayoutType();
    });
    $(".element-sortable").sortable({
        handle: '.handle',
        receive: function(e, ui) {}
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
                    window.location.href = BASE_URL + 'page';
                }
            });

        return false;
    }); /*end btn cancel*/
})