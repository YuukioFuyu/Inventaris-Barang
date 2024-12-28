
CcPageElement.addTab({
  'li_class' : '',
  'a_class' : 'active btn-form-preview btn_show_tab_form ',
  'a_href' : '#tab_form',
  'i_class' : 'fa fa-paper-plane-o text-black',
  'tab_label' : 'Form',
});

/*add tab content tab attribute*/
CcPageElement.addField({
  'field_name' : 'form_reff',
  'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'Form Reff :'+ 
            '<select name="form_reff" id="form_reff">'+
            '<option value="0">select form</option>'+
            '</select>'+
          '</div>'+
          '<div class="col-md-12 padding-left-0 padding-right-0 style-type  display-none" id="info-form">'+
          'form not avaiable please create form in '+
          '<a href="'+BASE_URL+'form/add'+'" target="blank">this link</a>'+
          '</div>'+
          '<iframe scrolling="no" width="50%"  style="height:400px; position:fixed; right:10%; z-index:9999999999; overflow: none; border:1px solid #ccc; top:20%; backgroud:#fff" class="display-none" id="preview-form-builder">'+
          '</iframe>',
  'tab_group' : 'tab_form',
  'selector_accepted' : '.form-builder',
  onTargetClick : function (field, target) {
    $.ajax({
        url: BASE_URL + '/form/get_form',
        dataType: 'JSON',
      })
      .done(function(response) {
        if (response.success) {
          if (response.html.trim() != 'empty') {
            field.html(response.html);
          } else {
            $('#info-form').show();
          }
        } else {
          toastr['error'](response.message);
        }
      })
      .fail(function() {
        toastr['error']('error getting data');
      }).complete(function(){
        var ids = target.html().match(/\{form_builder\((.[0-9])\)\}/);
        if (ids != null) {
          if (typeof ids[1] != 'undefined') {
            id = ids[1];
          } else {
            id = 0;
          }
          field.val(id);
        }
      });
      $(document).find('#preview-form-builder').hide();
  },
  onSave : function (field, target) {
    if (field.val().length) {
      target.html('{form_builder('+field.val()+')}');
    }
  },
  onReady : function (field) {
    $.ajax({
      url: BASE_URL + '/form/get_form',
      dataType: 'JSON',
    })
    .done(function(response) {
      if (response.success) {
        if (response.html.trim() != 'empty') {
          field.html(response.html);
        } else {
          $('#info-form').show();
        }
      } else {
        toastr['error'](response.message);
      }
    })
    .fail(function() {
      toastr['error']('error getting data');
    });

    field.on('mouseenter', 'option', function(){
      $(document).find('#preview-form-builder').show().attr('src', $(this).attr('data-form-url'));
    });
    field.on('mouseleave', 'option', function(){
      $(document).find('#preview-form-builder').hide();
      $(document).find('.form-builder-preview-page').remove();
    });
  }
});
