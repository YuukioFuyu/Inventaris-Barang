  function resetForm() {
      $('form input[type = text], form input[type = email], form input[type = number], form input[type = password], form textarea').val('');
      $('form textarea').text('');
      $('.data_file').val('');
      $('input.flat-red').each(function(index, element) {
          $(element).iCheck('uncheck');
      });
      $('.refresh-captcha').trigger('click');
  }
  function getUnixId() {
      return time_in_ms = Date.now();
  }
  var config_choosen = {
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

  function getStyle(target, css_to_find) {
    var style = target.attr('style').trim().split(';');
    var selected = '';
    $.each(style, function(index, val) {
      css = val.trim().split(':');
      css_name = typeof css[0] != 'undefined' ? css[0].trim() : false;
      css_val = typeof css[1] != 'undefined' ? css[1].trim() : false;

      if (css_name) {
        if (css_name == css_to_find) {
          selected = css_val;
        }
      }
    });

    return selected;
  }

  function goUrl(url) {
    document.location = BASE_URL + url;
  }

  $(document).ready(function() {
      $('a, button, input[type=submit], .tip').tooltip();
      $('.fancybox').fancybox();

      toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": false,
          "preventDuplicates": true,
          "progressBar": false,
          "rtl": false,
          "positionClass": "toast-top-center",
          "onclick": null,
          "showDuration": 300,
          "hideDuration": 1000,
          "timeOut": 5000,
          "extendedTimeOut": 1000,
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
      }

      $('.demo-version, .demo-version a').click(function() {
          toastr['warning']("Sorry, demo version can't be accessed this!", "Warning!");

          return false;
      }); /*end demo version click*/

      /*add activer menu side bar*/
      var i = $('.sidebar-menu li.active').parents('li').addClass('active');


      if (typeof $('form input, form select')[1] != 'undefined') {
          $('form input')[1].focus();
      }

      /*show loading*/
      $.fn.loader = function(opsi) {
          $(this).html('<span class="loading loading-hide pull-right padding-10"><img src="' + BASE_URL + 'asset/img/loading-spin-primary.svg"> <i>Loading, Submitting Data</i></span>');
      };

      /*print message*/
      $.fn.printMessage = function(opsi) {
          var opsi = $.extend({
              type: 'success',
              timeout: 500000
          }, opsi);

          $title=[opsi.type] == 'success' ? 'Sukses' : 'Perhatian';
          
          $(this).hide();
          $(this).html(' <div class="col-md-12 message-alert" ><div class="callout callout-' + opsi.type + '"><h4>' + $title + '!  <a href="#" class="close pull-right" >&times;</a></h4>' + opsi.message + '</div></div>');
          $(this).slideDown('slow');
          // Run the effect
          setTimeout(function() {
              $('.message-alert').slideUp('slow');
          }, opsi.timeout);

          var parentElem  = $(this);

          $(this).find('.message-alert .close').click(function(event) {
            event.preventDefault();
            parentElem.html('');
          });
      };

      /*replace all string*/
      String.prototype.replaceAll = function(search, replacement) {
          var target = this;
          return target.split(search).join(replacement);
      };

      /*show  hide password*/
      $('.input-password').each(function(index, el) {
          var eye = $(this).parent().parent().find('.eye');
          $(this).find('.show-password').mousedown(function() {
              $(this).parent().parent().find('.password').attr('type', 'text');
              eye.addClass('fa-eye-slash');
              eye.removeClass('fa-eye');
          });
          $(this).find('.show-password').mouseup(function() {
              $(this).parent().parent().find('.password').attr('type', 'password');
              eye.removeClass('fa-eye-slash');
              eye.addClass('fa-eye');
          });
      });

      $('.datepicker').datetimepicker({
          timepicker: false,
          formatDate: 'Y.m.d',

      });

      $('.datepicker').inputmask({
          mask: "y-1-2",
          placeholder: "yyyy-mm-dd",
          leapday: "-02-29",
          separator: "-",
          alias: "yyyy/mm/dd"
      });

      $('.datetimepicker').inputmask({
          mask: "y-1-2 h:s",
          placeholder: "yyyy-mm-dd hh:mm",
          leapday: "-02-29",
          separator: "-",
          alias: "yyyy/mm/dd"
      });

      $('.datetimepicker').datetimepicker({
          formatTime: 'H:i',
          formatDate: 'yyyy-mm-dd hh:ii',
      });

      $('.timepicker').inputmask({
          mask: "h:s",
          placeholder: "hh:mm",
          leapday: "-02-29",
          separator: "-",
          alias: "yyyy/mm/dd"
      });

      $('.timepicker').datetimepicker({
          datepicker: false,
          format: 'H:i',
          step: 5
      });

      var config = {
          '.chosen-select': {
              search_contains: true,
              search_contains: true,
              parser_config: {
                  copy_data_attributes: true
              }
          },
          '.chosen-select-deselect': {
              allow_single_deselect: true,
              search_contains: true,
              parser_config: {
                  copy_data_attributes: true
              }
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
          $(selector).chosen(config[selector]);
      }
      //Flat red color scheme for iCheck
      $('input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
      });


      $('a[data-toggle="tab"].tab_animation').on('shown.bs.tab', function (e) {   
          var target = $(this).attr('href');

          $(target).css('top','-'+$(window).height()+'px');   
          var top = $(target).offset().left;
          $(target).css({top:top}).animate({"top":"0px"}, {
            duration: 'slow',
            specialEasing: {
              height: "easeInOutQuart"
            }
          }
        );
      });
  });