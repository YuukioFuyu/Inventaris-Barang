
function addHeaderRequest(key, value) {
  var item = $('#table-headers tr:last').clone();

  if (typeof key == 'undefined') {
    var key = '';
  }
  if (typeof value == 'undefined') {
    var value = '';
  }
  item.find('.key').val(key);
  item.find('.value').val(value);
  $('#table-headers tbody').append(item);
}

function addParamRequest(key, value) {
  var item = $('#table-param tr:last').clone();

  if (typeof key == 'undefined') {
    var key = '';
  }
  if (typeof value == 'undefined') {
    var value = '';
  }
  item.find('.key').val(key);
  item.find('.value').val(value);
  $('#table-param tbody').append(item);
}

function addBodyRequest(key, value, type) {
  var item = $('#table-body tr:last').clone();

  if (typeof key == 'undefined') {
    var key = '';
  }
  if (typeof value == 'undefined') {
    var value = '';
  }
  if (typeof type == 'undefined') {
    var type = 'text';
  }
  item.find('.key').val(key);
  item.find('.value').val(value);
  item.find('.type').val(type);
  item.find('.container-input-type').hide();
  item.find('.container-text').show();
  $('#table-body tbody').append(item);
}


$(document).ready(function() {

    ace.require("ace/ext/language_tools");
    var editor = ace.edit('result-pretty');
    editor.getSession().setMode("ace/mode/json");
    editor.setValue('');

    var editorRaw = ace.edit('result-raw');
    editorRaw.getSession().setMode("ace/mode/text");
    editorRaw.setValue('');

    $(document).on('change', '.switch-input-type', function() {
        var parent = $(this).parents('tr');
        var type = parent.find('.type').val();

        parent.find('.container-input-type').hide();
        if (type == 'file') {
            parent.find('.container-file').show();
        } else {
            parent.find('.container-text').show();
        }
    });

    $('.switch-method').click(function(event) {
        event.preventDefault();
        var method = $(this).attr('data-value');
        $('.method-selected').html(method);
    });

    $('.btn-mode-preview-type').click(function(event) {
        event.preventDefault();
        var type = $(this).attr('data-value');
        $('.mode-preview-type-selected').html(type.toUpperCase());
        var resultPretty = ace.edit('result-pretty');

        resultPretty.getSession().setMode("ace/mode/" + type);
    });

    $('.btn-toggle-param').click(function(event) {
        event.preventDefault();
        $('#table-param').toggle();
    });

    $(document).on('focus', '#table-headers .key:last', function() {
        addHeaderRequest();
    });

    $(document).on('focus', '#table-param .key:last', function() {
        addParamRequest();
    });

    $(document).on('focus', '#table-body .key:last', function() {
        addBodyRequest();
    });

    $(document).on('click', 'a.btn-remove', function() {
        $(this).parents('tr').remove();
    });

    $(document).on('change', '.file-styling :file', function() {
        $this = $(this);
        $(this).parent().find('.info-file').text($this.val());
    });

    $(document).on('click', '.btn-mode', function() {
        $('.btn-mode').removeClass('active');
        $(this).addClass('active');
    });

    $('#url, #table-headers input, #table-body input, #table-param input').on('keydown', function(event) {
        if (event.keyCode == 13) {
            $('.btn-send').trigger('click');
        }
    });

    $('.btn-send').click(function(event) {
        event.preventDefault();

        var submitButton = $(this);
        var defaultValue = submitButton.html();
        var url = $('#url').val();
        var method = $('.method-selected').html();
        var requestBody = new FormData();
        var requestParam = [];
        var requestHeader = {};
        var start_time = new Date().getTime();

        if (url.length <= 0) {
            return toastr['error']('Fill URL Requested First');
        }
        url = url.replaceAll('{api_endpoint}', BASE_URL + 'api/');

        $('#table-headers tr').each(function(index, el) {
            var key = $(this).find('.key').val();
            var value = $(this).find('.value').val();

            if (key.length) {
                requestHeader[key] = value;
            }
        });
        $('#table-param tr').each(function(index, el) {
            var key = $(this).find('.key').val();
            var value = $(this).find('.value').val();

            if (key.length) {
                requestParam.push({
                    name: key,
                    value: value
                });
            }
        });

        $('#table-body tr').each(function(index, el) {
            var key = $(this).find('.key').val();
            var type = $(this).find('.type').val();
            var value = $(this).find('.value').val();

            if (type == 'file') {
                var file = $(this).find('.file');
                if (key.length) {
                    var blob = new Blob([file[0].files[0]]);
                    requestBody.append(key, blob, file.val());
                }
            } else {
                if (key.length) {
                    requestBody.append(key, value);
                }
            }
        });

        submitButton.html('Sending..');

        var request;

        if (method.toLowerCase() == 'get') {
            request = requestParam;
            var addParams = function(url, data) {
                if (!$.isEmptyObject(data)) {
                    url += (url.indexOf('?') >= 0 ? '&' : '?') + $.param(data);
                }

                return url;
            }

            url = addParams(url, request);
        } else {
            request = requestBody;
        }

        $.ajax({
                url: url,
                type: method,
                dataType: 'JSON',
                data: request,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                headers: requestHeader
            })
            .fail(function(response) {
                if (response.status == 500) {
                    toastr['error']('Error API Request');
                }
            })
            .always(function(response, status, xhr) {
                $('.loading').hide();
                submitButton.html(defaultValue);
                var responseReff = response;

                if (typeof xhr == 'object') {
                    responseReff = xhr;
                }

                if (typeof responseReff.statusText == 'undefined') {
                    responseReff.statusText = 'OK';
                }

                $('.status').html(responseReff.status + ' ' + responseReff.statusText);

                var request_time = new Date().getTime() - start_time;
                $('.time-requested').html(request_time + ' ms');

                if (typeof responseReff.responseJSON != 'undefined') {
                    $('.result-preview').JSONView(responseReff.responseJSON);
                } else {
                    var htmlEntities = function(str) {
                        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
                    }
                    $('.result-preview').html("<iframe  width='100%'  style='height:500px; border:none; overflow: auto'  src=" +
                        "data:text/html," + encodeURIComponent(responseReff.responseText) +
                        "></iframe>");
                }
                $('.status').addClass('response-' + responseReff.status);

                $('.source-fresh').text(responseReff.responseText);
                //ace editor 
                ace.require("ace/ext/language_tools");
                var editor = ace.edit('result-pretty');
                var beautify = ace.require("ace/ext/beautify"); // get reference to extension

                editor.setOptions({
                    readOnly: true,
                    fontSize: "14px"
                });
                editor.getSession().setMode("ace/mode/" + $('.mode-preview-type-selected').html().toLowerCase());
                beautify.beautify(editor.getSession());
                editor.setValue(responseReff.responseText);

                var editorRaw = ace.edit('result-raw');
                editorRaw.setOptions({
                    readOnly: true,
                    fontSize: "14px"
                });
                editorRaw.setValue(responseReff.responseText);
            });

        return false;
    });

}); /*end doc ready*/