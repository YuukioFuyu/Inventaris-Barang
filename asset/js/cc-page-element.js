/**
 * cc page element
 *
 * set element and custom element
 *
 * @constructor
 * @author Muhamad Ridwan
 * @package cicool
 */

function CcPageElement() {

	/**
	* List of tab
	*/
	this.tab = [];

	/**
	* List of tab field
	*/
	this.tab_field = {};

	/**
	* Target of tab wrapper
	*/
	this.tab_target_wrapper;

	/**
	* Wrapper class name
	*/
	this.div_field_wrapper_class_name = 'wrapper-field-element';

	/**
	* List of element supported for editing
	*/
	this.all_element_supported = 'a,abbr,acronym,address,article,aside,audio,b,blockquote,body,br,button,canvas,caption,center,cite,code,col,colgroup,datalist,dd,details,div,dl,dt,em,embed,fieldset,figcaption,figure,font,footer,form,head,header,hr,html,i,iframe,img,input,label,legend,li,mark,menu,meter,nav,ol,optgroup,option,output,p,pre,q,s,samp,section,select,small,source,video,span,strike,del,strong,style,sub,summary,sup,table,tbody,td,textarea,tfoot,th,thead,time,tr,tt,u,ul,var,frame,frameset';

	/**
	* List of component
	*/
	this.component = [];

	/**
	* List of component item
	*/
	this.component_item = {};

}

/**
* Add tab 
*/
CcPageElement.prototype.addTab = function (opt) {
	var opt_default = {
		'li_class' : 'active ',
		'a_class' : '',
		'a_href' : '',
		'i_class' : '',
		'tab_label' : '',
		'selector_accepted' : 'all'
	};

	$.each(opt, function(index, val) {
		if (typeof opt_default[index] !== undefined) {
			opt_default[index] = val;
		}
	});

	this.tab.push('<li class="'+opt_default.li_class+' '+opt_default.selector_accepted+'">'+
					 '<a class="'+opt_default.a_class+'" href="'+opt_default.a_href+'" data-toggle="tab">'+
					 	'<i class="'+opt_default.i_class+'"></i> '+opt_default.tab_label+''+
					 '</a>'+
				 '</li>');
}

/**
* Display tab 
*/
CcPageElement.prototype.displayTab = function () {
	return this.tab.join('');
}

/**
* Add field to tab 
*/
CcPageElement.prototype.addField = function (opt) {
	var opt_default = {
		'field_name' : '',
		'field_content' : '',
		'tab_group' : '',
		'selector_accepted' : '' ,
		'selector_excepted' : '' ,
		'onTargetClick' : function() {

		},
		'onSave' : function() {

		},
		'onReady' : function() {

		}
	};

	$.each(opt, function(index, val) {
		if (typeof opt_default[index] !== undefined) {
			opt_default[index] = val;
		}
	});

	if (typeof this.tab_field[opt_default.tab_group] == 'undefined') {
		this.tab_field[opt_default.tab_group] = [];
	}

	opt_default.field_content = '<div class="'+this.div_field_wrapper_class_name+'">'+opt_default.field_content+'</div>';

	this.tab_field[opt_default.tab_group].push(opt_default);
}

/**
* display tab field
*/
CcPageElement.prototype.displayTabField = function () {
	var html = '';

	$.each(this.tab_field, function(group_name, groups) {
		html += '<div class="tab-pane padding-left-0" id="'+group_name+'" style="margin-top:20px;">';
		groups.forEach(function(field) {
			html += field.field_content;
		});
		html += '</div>';

	});

	return html;
}

/**
* Display tab content 
*/
CcPageElement.prototype.displayTabContent = function () {
	var html = '';

	html += '<div class="tab-content  padding-left-0">';
	html += '<div class="editing-element-info">'+
              'EDITING : <span class="current-element">a</span>'+
             '</div>'
	html += this.displayTabField();
	html += '<div>';

	return html;
}

/**
* Render tab to target 
*
* @param {Object} target
*/
CcPageElement.prototype.renderTab = function (target) {
	var html = '';

	html += '<ul class="nav nav-tabs tab-elements rest-page-test active " >';
	html += this.displayTab();
	html += '</ul>';
	html += this.displayTabContent();

	$(target).html(html);

	this.tab_target_wrapper = target;

	if (typeof target !== undefined) {
		$.each(this.tab_field, function(group_name, groups) {
			groups.forEach(function(field) {
				var input = $(document).find('#'+field.field_name);
				field.onReady(input);
			});
		});
	}

	return this;
}

/**
* Update element information 
*
* @param {Object} target
*/
CcPageElement.prototype.updateElementInformation = function (target) {

    var icon_triangle = ' <i class="fa fa-play"></i> ';
    var element_info = target.parent().parent().prop('nodeName') + ' ' +
        icon_triangle + target.parent().prop('nodeName') + ' ' +
        icon_triangle + target.prop('nodeName') + ' ';
	
	this.showAllFieldInfo();

    this.tab_target_wrapper.find('.current-element').html(element_info);
	if (typeof target !== undefined) {
		$.each(this.tab_field, function(group_name, groups) {
			groups.forEach(function(field) {
				var input = $(document).find('.tab-content #'+field.field_name);
				var input_wrapper = $(document).find('.tab-content .wrapper-field-element #'+field.field_name).parents('.wrapper-field-element');

				if (field.selector_accepted.length > 0) {
					if (!target.is(field.selector_accepted)) {
						input_wrapper.hide();
						input_wrapper.removeClass('show-field-element');
					}
				}
				if (field.selector_excepted.length > 0) {
					if (target.is(field.selector_excepted)) {
						if (field.selector_accepted.length <= 0) {
							input_wrapper.hide();
							input_wrapper.removeClass('show-field-element');
						} else {
							if (!target.is(field.selector_accepted)) {
								input_wrapper.hide();
								input_wrapper.removeClass('show-field-element');
							}
						}
					}
				}

				field.onTargetClick(input, target);
			});
		});
	}

	this.updateTab();
}

/**
* Update element on apply changes 
*
* @param {Object} target
*/
CcPageElement.prototype.updateElement = function (target) {
	if (typeof target !== undefined) {
		$.each(this.tab_field, function(group_name, groups) {
			groups.forEach(function(field) {
				var input = $(document).find('.tab-content #'+field.field_name);
				var input_wrapper = $(document).find('.tab-content .wrapper-field-element #'+field.field_name).parents('.wrapper-field-element');
				var target_node_name = target.prop('nodeName').toLowerCase();

				
				if (field.selector_accepted.length > 0) {
					if (target.is(field.selector_accepted)) {
						if (field.selector_excepted.split(',').length > 0) {
							if (target.not(field.selector_excepted)) {
								field.onSave(input, target);
							}
						} else {
							field.onSave(input, target);
						}
					}
				}
				if (field.selector_excepted.split(',').length > 0) {
					if (target.not(field.selector_excepted)) {
						if (field.selector_accepted.length > 0) {
							if (target.is(field.selector_accepted)) {
								field.onSave(input, target);
							}
						} else {
							field.onSave(input, target);
						}
					}
				}


			});
		});
	}
}

/**
* Showing all field info 
*/
CcPageElement.prototype.showAllFieldInfo = function () {
	$.each(this.tab_field, function(group_name, groups) {
		groups.forEach(function(field) {
			var input = $(document).find('.tab-content #'+field.field_name);
			var input_wrapper = $(document).find('.tab-content .wrapper-field-element #'+field.field_name).parents('.wrapper-field-element');
			input_wrapper.show();
			input_wrapper.addClass('show-field-element');
		});
	});
}

/**
* Update tab 
*/
CcPageElement.prototype.updateTab = function () {
	$(document).find('.tab-elements li').each(function() {
		var tab_btn = $(this);
		var tab = $(this).find('a').attr('href').replace('#', '');
		var count_field = $(document).find('.tab-content #'+tab+' .show-field-element').length;

		if (count_field == 0) {
			tab_btn.find('a').hide();
		} else {
			tab_btn.find('a').show();
		}

         $('.tab-elements li').each(function() {
          if ($(this).find('a').css('display') != 'none') {
            $(this).find('a').tab('show');
          }
        });
	});
}

/**
* On field is ready 
*
* @param {Object} field
*/
CcPageElement.prototype.onReady = function (field) {
	field.onReady(field);
}


/**
* Add component 
*/
CcPageElement.prototype.addComponent = function (component_name) {

	this.component.push('<div class="box box-transparent  box-solid">'+
	    '<div class="box-header">'+
	        '<h4 class="box-title uppercase">'+component_name+'</h4>'+
	        '<div class="box-tools pull-right">'+
	            '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>'+
	            '</button>'+
	        '</div>'+
	    '</div>'+
	    '<div class="box-body">'+
	        '<div class="row-fluid" id="component-'+component_name+'">'+
	            this.displayComponentItem(component_name)+
	        '</div>'+
	    '</div>'+
	'</div>'
	);
}

/**
* Display component 
*/
CcPageElement.prototype.displayComponent = function () {
	return this.component.join('');
}

/**
* Add field to component 
*/
CcPageElement.prototype.addComponentItem = function (opt) {
	var opt_default = {
		'item_name' : '',
		'item_preview' : '',
		'item_content' : '',
		'component_group' : '',
		onDrop : function() {

		},
		onStartDrag : function() {

		},
		onReady : function() {

		}
	};

	$.each(opt, function(index, val) {
		if (typeof opt_default[index] !== undefined) {
			opt_default[index] = val;
		}
	});

	if (typeof this.component_item[opt_default.component_group] == 'undefined') {
		this.component_item[opt_default.component_group] = [];
	}
	this.component_item[opt_default.component_group].push(opt_default);
}

/**
* display tab field
*/
CcPageElement.prototype.displayComponentItem = function (component_name) {
	var html = '';
	
	if (typeof this.component_item[component_name] != undefined) {
		$.each(this.component_item[component_name], function(idx, component_item) {
			var node_name = $(component_item.item_content).prop('nodeName');
			var additional = '<div class="element-info-top not-editable" style="position:" contentEditable="false" >'+
              node_name+ 
              '<span class="remove-component not-editable" onclick="$(this).parent().parent().parent().remove()"><span class="fa fa-trash text-white "></span></span>'+
              '<span class="handle not-editable"><span class="fa fa-arrows text-white "></span></span>'+
          '</div>';

			 var preview = '<a class="btn col-md-6 btn-app btn-flat component-preview-wrapper  " id="'+component_item.item_name+'">'+
               component_item.item_preview+
             '</a>';
             var item = '<div class="component-item-wrapper" style="display:none">'+additional+component_item.item_content+'</div>';
			 html += '<div class="component-list">'+preview+item+'</div>';
		});
	}
	return html;
}

/**
* Render component to target 
*
* @param {Object} target
*/
CcPageElement.prototype.renderComponent = function (target) {

	var group_component = [];
	var obj = this;

	$.each(this.component_item, function(group_name) {
		group_component.push(group_name);
	});
	group_component.forEach(function(group_name){
		obj.addComponent(group_name);
	});
	
	target.html(this.displayComponent());

	return this;
}

/**
* Action on component drag 
*
* @param {Object} target
*/
CcPageElement.prototype.onDragComponent = function (target) {
	if (typeof target !== undefined) {
		$.each(this.component_item, function(group_name) {
			
		});
	}
}

/**
* Action on component drag 
*
* @param {Object} target
*/
CcPageElement.prototype.onDropComponent = function (target) {
	$.each(this.component_item, function(group_name, items) {
		items.forEach(function(item){
			item.onDrop(target);
		});
	});
}



var CcPageElement = new CcPageElement;

/*add tabs*/

CcPageElement.addTab({
	'li_class' : '',
	'a_class' : 'active btn-form-preview btn_show_tab_attribute ',
	'a_href' : '#tab_attribute',
	'i_class' : 'fa fa-tag text-black',
	'tab_label' : 'Attribute',
});

CcPageElement.addTab({
	'li_class' : 'active ',
	'a_class' : ' active btn_show_tab_style',
	'a_href' : '#tab_style',
	'i_class' : 'fa fa-edit text-black',
	'tab_label' : 'Style'
});

CcPageElement.addTab({
	'li_class' : '',
	'a_class' : 'active btn-form-preview btn_show_tab_link ',
	'a_href' : '#tab_link',
	'i_class' : 'fa fa-hand-pointer-o text-black',
	'tab_label' : 'Link',
});

CcPageElement.addTab({
	'li_class' : '',
	'a_class' : 'active btn-form-preview btn_show_tab_image ',
	'a_href' : '#tab_image',
	'i_class' : 'fa fa-image text-black',
	'tab_label' : 'Image',
});


CcPageElement.addTab({
	'li_class' : '',
	'a_class' : 'active btn-form-preview btn_show_tab_widged ',
	'a_href' : '#tab_widged',
	'i_class' : 'fa fa-puzzle-piece text-black',
	'tab_label' : 'Widged',
});

CcPageElement.addTab({
	'li_class' : '',
	'a_class' : 'active btn-form-preview btn_show_tab_video ',
	'a_href' : '#tab_video',
	'i_class' : 'fa fa-youtube-play text-black',
	'tab_label' : 'Video',
});

/*add tab content tab attribute*/
CcPageElement.addField({
	'field_name' : 'class_element',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'Class :'+ 
            '<input type="text" class="pull-right" name="class_element" id="class_element">'+
          '</div>',
	'tab_group' : 'tab_attribute',
	'selector_accepted' : '*',
	'onTargetClick' : function (field, target) {
		var classList = target.attr('class').replaceAll('editable-focused', '');
		field.val(classList);
	},
	'onSave' : function (field, target) {
		if (field.val().length) {
			target.attr('class', '');
			target.addClass(field.val() + ' editable-focused');
		}
	}
});

CcPageElement.addField({
	'field_name' : 'id_element',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'Id :'+ 
            '<input type="text" class="pull-right" name="id_element" id="id_element">'+
          '</div>',
	'tab_group' : 'tab_attribute',
	'selector_accepted' : '*',
	'onTargetClick' : function (field, target) {
		var id = target.attr('id');
		field.val(id);
	},
	'onSave' : function (field, target) {
		if (field.val().length) {
			target.attr('id', field.val());
		}
	}
});
CcPageElement.addField({
	'field_name' : 'title_element',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'Title :'+ 
            '<input type="text" class="pull-right" name="title_element" id="title_element">'+
          '</div>',
	'tab_group' : 'tab_attribute',
	'selector_accepted' : '*',
	'onTargetClick' : function (field, target) {
		var title = target.attr('title');
		field.val(title);
	},
	'onSave' : function (field, target) {
		if (field.val().length) {
			target.attr('title', field.val());
		}
	}
});

/*add tab content tab video*/
CcPageElement.addField({
	'field_name' : 'youtube_id',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'youtube id :'+ 
            '<input type="text" class="pull-right" name="youtube_id" id="youtube_id">'+
          '</div>',
	'tab_group' : 'tab_video',
	'selector_accepted' : '.video, video',
	'onTargetClick' : function (field, target) {
		var url = target.parent().find('iframe').attr('src');
		if (url != undefined) {
			var res =  url.match(/embed\/([a-zA-Z0-9-_]+)/gi); 
			var ytb_id = '';
			if (res != null) {
				var ytb_id = res[0].replaceAll('embed/', '');
			}
			field.val(ytb_id);
		}
	},
	'onSave' : function (field, target) {
		if (field.val().length) {
			target.parent().find('iframe').attr('src', 'https://www.youtube.com/embed/'+field.val());
		}
	}
});

CcPageElement.addField({
	'field_name' : 'vimeo_id',
	'field_content' : '<br><br><CENTER class="margin-top-20"><b class="text-red" style="margin-bottom:-20px">-----OR-----</b></CENTER>'+
		  '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'vimeo id :'+ 
            '<input type="text" class="pull-right" name="vimeo_id" id="vimeo_id">'+
          '</div>',
	'tab_group' : 'tab_video',
	'selector_accepted' : '.video, video',
	'onTargetClick' : function (field, target) {
		var url = target.parent().find('iframe').attr('src');
		if (url != undefined) {
			var res =  url.match(/video\/([a-zA-Z0-9-_]+)/gi); 
			var vimeo_id = '';
			if (res != null) {
				console.log(res);
				var vimeo_id = res[0].replaceAll('video/', '');
			}
			field.val(vimeo_id);
		}
	},
	'onSave' : function (field, target) {
		if (field.val().length) {
			target.parent().find('iframe').attr('src', 'https://www.player.vimeo.com/video/'+field.val());
		}
	}
});

CcPageElement.addField({
	'field_name' : 'video_width',
	'field_content' : '<hr><br>'+
		  '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'video width :'+ 
            '<input type="text" class="pull-right" name="video_width" id="video_width">'+
          '</div>',
	'tab_group' : 'tab_video',
	'selector_accepted' : '.video, video',
	'onTargetClick' : function (field, target) {
		var width = target.parent().find('iframe').attr('width');
		if (width != undefined) {
			field.val(width);
		}
	},
	'onSave' : function (field, target) {
		target.parent().find('iframe').attr('width', field.val());
		target.parent().find('.video-wrapper').css('width', field.val());
	}
});

CcPageElement.addField({
	'field_name' : 'video_height',
	'field_content' : '<hr>'+
		  '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'video height :'+ 
            '<input type="text" class="pull-right" name="video_height" id="video_height">'+
          '</div>',
	'tab_group' : 'tab_video',
	'selector_accepted' : '.video, video',
	'onTargetClick' : function (field, target) {
		var height = target.parent().find('iframe').attr('height');
		if (height != undefined) {
			field.val(height);
		}
	},
	'onSave' : function (field, target) {
		target.parent().find('iframe').attr('height', field.val());
		console.log(field.val());
		target.parent().find('.video-wrapper').css({marginTop:  '-'+field.val()+'px', height : field.val()});
	}
});


/*add tab content tab widged*/
CcPageElement.addField({
	'field_name' : 'make_tab',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'field-widged :'+ 
            '<div id="make_tab" class="pull-right"><div class="component-list">khiuh<input></div></div>'+
          '</div>',
	'tab_group' : 'tab_widged',
	'selector_accepted' : '.droppable',
	'onTargetClick' : function (field, target) {

	},
	'onSave' : function (field, target) {
		target.css('color', field.val());
	}
});



/*add tab content tab style*/
CcPageElement.addField({
	'field_name' : 'font_size',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type no-margin">'+
            'font-size :'+ 
            '<input type="text" class="pull-right" name="font_size" id="font_size">'+
          '</div>',
	'tab_group' : 'tab_style',
	'selector_excepted' : 'img,video',
	'onTargetClick' : function (field, target) {
		field.val(target.css('font-size'));
	},
	'onSave' : function (field, target) {
		target.css('font-size', field.val());
	}
});

CcPageElement.addField({
	'field_name' : 'font_color',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'font-color :'+ 
            '<input type="" class="pull-right spectrum-basic" name="font_color" id="font_color">'+
          '</div>',
	'tab_group' : 'tab_style',
	'selector_excepted' : 'img,video',
	'onTargetClick' : function (field, target) {
		field.val(target.css('color'));
	},
	'onSave' : function (field, target) {
		target.css('color', field.val());
	}
});

CcPageElement.addField({
	'field_name' : 'background_color',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'background-color :'+ 
            '<input type="" class="pull-right spectrum-basic" name="background_color" id="background_color">'+
          '</div>',
	'tab_group' : 'tab_style',
	'onTargetClick' : function (field, target) {
		field.val(target.css('background-color'));
	},
	'onSave' : function (field, target) {
		target.css('background-color', field.val());
	}
});

CcPageElement.addField({
	'field_name' : 'font_family',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'font-family :'+
            '<input type="text" class="pull-right" name="font_family" id="font_family">'+
          '</div>',
	'tab_group' : 'tab_style',
	'selector_excepted' : 'img,video',
	'onTargetClick' : function (field, target) {
		field.val(target.css('font-family'));
	},
	'onSave' : function (field, target) {
		target.css('font-family', field.val());
	}
});

CcPageElement.addField({
	'field_name' : 'border_width',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'border-width :'+
            '<input type="text" class="pull-right" name="border_width" id="border_width">'+
          '</div>',
	'tab_group' : 'tab_style',
	'selector_accepted' : '*',
	'onTargetClick' : function (field, target) {
		field.val(getStyle(target, 'border-width'));
	},
	'onSave' : function (field, target) {
		target.css('border-width', field.val());
	}
});

CcPageElement.addField({
	'field_name' : 'border_color',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'border-color :'+ 
            '<input type="" class="pull-right spectrum-basic" name="border_color" id="border_color">'+
          '</div>',
	'tab_group' : 'tab_style',
	'selector_accepted' : '*',
	'onTargetClick' : function (field, target) {
		field.val(getStyle(target, 'border-color'));
	},
	'onSave' : function (field, target) {
		target.css('border-color', field.val());
	}
});

CcPageElement.addField({
	'field_name' : 'border_style',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'border-style :'+
            '<select type="text" class="pull-right" name="border_style" id="border_style">'+
            '<option value=""></option>'+
            '<option value="none">none</option>'+
            '<option value="hidden">hidden</option>'+
            '<option value="dotted">dotted</option>'+
            '<option value="dashed">dashed</option>'+
            '<option value="solid">solid</option>'+
            '<option value="double">double</option>'+
            '<option value="groove">groove</option>'+
            '<option value="ridge">ridge</option>'+
            '<option value="inset">inset</option>'+
            '<option value="outset">outset</option>'+
            '<option value="initial">initial</option>'+
            '<option value="inherit">inherit</option>'+
            '</select>'+
          '</div>',
	'tab_group' : 'tab_style',
	'selector_accepted' : '*',
	'onTargetClick' : function (field, target) {
		field.val(getStyle(target, 'border-style'));
	},
	'onSave' : function (field, target) {
		if (field.val().length) {
			target.css('border-style', field.val());
		}
	}
});

CcPageElement.addField({
	'field_name' : 'border_radius',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'border-radius :'+
            '<select type="text" class="pull-right" name="border_radius" id="border_radius">'+
            '<option value=""></option>'+
            '<option value="0px">0px</option>'+
            '<option value="2px">2px</option>'+
            '<option value="5px">5px</option>'+
            '<option value="10px">10px</option>'+
            '<option value="15px">15px</option>'+
            '<option value="20px">20px</option>'+
            '<option value="50%">50%</option>'+
            '<option value="100%">100%</option>'+
            '</select>'+
          '</div>',
	'selector_accepted' : '*',
	'tab_group' : 'tab_style',
	'onTargetClick' : function (field, target) {
		field.val(getStyle(target, 'border-radius'));
	},
	'onSave' : function (field, target) {
		if (field.val().length) {
			target.css('border-radius', field.val());
		}
	}
});


/*add tab content tab img*/
CcPageElement.addField({
	'field_name' : 'img_src',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type input-large">'+
                'src :'+ 
                '<input type="text" class="pull-right" name="img_src" id="img_src">'+
              '</div>',
	'tab_group' : 'tab_image',
	'selector_accepted' : 'img',
	'onTargetClick' : function (field, target) {
		field.val(target.attr('src'));
	},
	'onSave' : function (field, target) {
		target.attr('src', field.val());
	}
});


CcPageElement.addField({
	'field_name' : 'image_alt',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
                'alt :'+ 
                '<input type="text" class="pull-right" name="image_alt" id="image_alt">'+
              '</div>',
	'tab_group' : 'tab_image',
	'selector_accepted' : 'img',
	'onTargetClick' : function (field, target) {
		field.val(target.attr('alt'));
	},
	'onSave' : function (field, target) {
		target.attr('alt', field.val());
	}
});

CcPageElement.addField({
	'field_name' : 'image_height',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
                'height :'+ 
                '<input type="text" class="pull-right" name="image_height" id="image_height">'+
              '</div>',
	'tab_group' : 'tab_image',
	'selector_accepted' : 'img',
	'onTargetClick' : function (field, target) {
		field.val(target.css('height'));
	},
	'onSave' : function (field, target) {
		target.css('height', field.val());
	}
});


CcPageElement.addField({
	'field_name' : 'image_width',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
                'width :'+ 
                '<input type="text" class="pull-right" name="image_width" id="image_width">'+
              '</div>',
	'tab_group' : 'tab_image',
	'selector_accepted' : 'img',
	'onTargetClick' : function (field, target) {
		field.val(target.css('width'));
	},
	'onSave' : function (field, target) {
		target.css('width', field.val());
	}
});

CcPageElement.addField({
	'field_name' : 'btn-upload',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
				'<div id="image_galery"></div>'+
              '</div>',
	'tab_group' : 'tab_image',
	'selector_accepted' : 'img',
	'onReady' : function (field) {
	   var params = {};
       params[csrf] = token;

       $('#image_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/page/upload_image_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/page/delete_image_file',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["jpg","png","jpeg","gif","svg"],
              sizeLimit : 2000 * 1024,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                $('#img_src').val(xhr.thumbnailUrl);
              },
              onSubmit : function(id, name) {
                  var uuid = $('#image_uuid').val();
                  $.get(BASE_URL + '/page/delete_image_file/' + uuid);
              }
          }
      });
    
	}

});



/*add tab content tab link*/

CcPageElement.addField({
	'field_name' : 'link_href',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
                'href : '+
                '<input type="text" class="pull-right" name="link_href" id="link_href">'+
              '</div>',
	'tab_group' : 'tab_link',
	'selector_accepted' : 'a',
	'onTargetClick' : function (field, target) {
		field.val(target.attr('href'));
	},
	'onSave' : function (field, target) {
		target.attr('href', field.val());
	}
});

CcPageElement.addField({
	'field_name' : 'link_label',
	'field_content' : '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
                'link label : '+
                '<input type="text" class="pull-right" name="link_label" id="link_label">'+
              '</div>',
	'tab_group' : 'tab_link',
	'selector_accepted' : 'a',
	'onTargetClick' : function (field, target) {
		field.val(target.html());
	},
	'onSave' : function (field, target) {
		target.html(field.val());
	}
});

CcPageElement.addField({
	'field_name' : 'link_target',
	'field_content' :  '<div class="col-md-12 padding-left-0 padding-right-0 style-type">'+
            'link target :'+
            '<select type="text" class="pull-right" name="link_target" id="link_target">'+
            '<option value=""></option>'+
            '<option value="_blank">blank</option>'+
            '<option value="_self">self</option>'+
            '<option value="_parent">parent</option>'+
            '<option value="_blank">blank</option>'+
            '</select>'+
          '</div>',
	'tab_group' : 'tab_link',
	'selector_accepted' : 'a',
	'onTargetClick' : function (field, target) {
		field.val(target.attr('target'));
	},
	'onSave' : function (field, target) {
		target.attr('target', field.val());
	}
});
