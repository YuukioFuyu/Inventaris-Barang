function dumyText() {
  return "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
}

/*register component layout*/
CcPageElement.addComponentItem({
  'item_name' : 'container',
  'item_preview' : '<i class="fa fa-stop"></i> container',
  'item_content' : '<div class="container column"></div>',
  'component_group' : 'layout'
});

for (var col = 1; col <= 16; col++) {
  CcPageElement.addComponentItem({
    'item_name' : 'col_'+col,
    'item_preview' : '<i class="fa fa-columns"></i> col '+col,
    'item_content' : '<div class="col-md-'+col+' column"></div>',
    'component_group' : 'layout'
  });
}

CcPageElement.addComponentItem({
  'item_name' : 'divider',
  'item_preview' : '<i class="fa fa-expand"></i> divider',
  'item_content' : '<div class="divider"></div>',
  'component_group' : 'layout'
});

/*register component media*/
CcPageElement.addComponentItem({
  'item_name' : 'image',
  'item_preview' : '<i class="fa fa-image"></i> image',
  'item_content' : '<img class="img-responsive" src="'+BASE_URL_EXTENSION+'/img/placeholder.png" width="460px" height="345px">',
  'component_group' : 'media'
});

CcPageElement.addComponentItem({
  'item_name' : 'galery',
  'item_preview' : '<i class="fa fa-image"></i> galery',
  'item_content' : '<div class="container">'+
      '<h2>Image Gallery</h2>'+
      '<p>The .thumbnail class can be used to display an image gallery.</p>'+
      '<p>The .caption class adds proper padding and a dark grey color to text inside thumbnails.</p>'+
      '<p>Click on the images to enlarge them.</p>'+
      '<div class="row">'+
        '<div class="col-md-4">'+
          '<div class="thumbnail">'+
            '<a href="'+BASE_URL_EXTENSION+'/img/placeholder.png" target="_blank">'+
              '<img src="'+BASE_URL_EXTENSION+'/img/placeholder.png" alt="Pulpit Rock" style="width:100%">'+
              '<div class="caption">'+
                '<p>Lorem ipsum donec id elit non mi porta gravida at eget metus.</p>'+
              '</div>'+
            '</a>'+
          '</div>'+
        '</div>'+
        '<div class="col-md-4">'+
          '<div class="thumbnail">'+
            '<a href="'+BASE_URL_EXTENSION+'/img/placeholder.png" target="_blank">'+
              '<img src="'+BASE_URL_EXTENSION+'/img/placeholder.png" alt="Moustiers Sainte Marie" style="width:100%">'+
              '<div class="caption">'+
                '<p>Lorem ipsum donec id elit non mi porta gravida at eget metus.</p>'+
              '</div>'+
            '</a>'+
          '</div>'+
        '</div>'+
        '<div class="col-md-4">'+
          '<div class="thumbnail">'+
            '<a href="'+BASE_URL_EXTENSION+'/img/placeholder.png" target="_blank">'+
              '<img src="'+BASE_URL_EXTENSION+'/img/placeholder.png" alt="Cinque Terre" style="width:100%">'+
              '<div class="caption">'+
                '<p>Lorem ipsum donec id elit non mi porta gravida at eget metus.</p>'+
              '</div>'+
            '</a>'+
          '</div>'+
        '</div>'+
      '</div>'+
    '</div>',
  'component_group' : 'media'
});


CcPageElement.addComponentItem({
  'item_name' : 'youtube',
  'item_preview' : '<i class="fa fa-youtube-play"></i> youtube',
  'item_content' : '<iframe class="" width="560" height="315" src="https://www.youtube.com/embed/grItaOxuyTE" frameborder="0" allowfullscreen></iframe>'+
                        '<div class="video video-wrapper widged-cover" contenteditable="false" style="width:560px; height:315px; margin-top:-315px;">'+
                        '</div>',
  'component_group' : 'media'
});

CcPageElement.addComponentItem({
  'item_name' : 'media_object',
  'item_preview' : '<i class="fa fa-star"></i> media object',
  'item_content' : '<div><h1>The Title</h1><p>'+dumyText()+'</p><p>'+dumyText()+'</p><p>'+dumyText()+'</p></div>',
  'component_group' : 'media'
});


/*component typography*/
CcPageElement.addComponentItem({
  'item_name' : 'label',
  'item_preview' : '<i class="fa fa-tags"></i> label',
  'item_content' : '<span class="label label-success">my label</span>',
  'component_group' : 'typography'
});

CcPageElement.addComponentItem({
  'item_name' : 'paragraph',
  'item_preview' : '<i class="fa fa-paragraph"></i> paragraph',
  'item_content' : '<p>'+dumyText()+'</p>',
  'component_group' : 'typography'
});

CcPageElement.addComponentItem({
  'item_name' : 'jumbroton',
  'item_preview' : '<i class="fa fa-th-list"></i> jumbroton',
  'item_content' : '<div class="jumbotron col-md-12">'+
  '<h1>Hello, world!</h1>'+
  '<p>'+dumyText()+'</p>'+
  '<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>'+
'</div>',
  'component_group' : 'typography'
});


CcPageElement.addComponentItem({
  'item_name' : 'jumbroton',
  'item_preview' : '<i class="fa  fa-info-circle"></i> jumbroton',
  'item_content' : '<div class="alert alert-success" role="alert">howdy :)</div>',
  'component_group' : 'typography'
});

['success', 'danger', 'warning', 'primary', 'black', 'default'].forEach(function(btn_name){
  CcPageElement.addComponentItem({
    'item_name' : 'button_'+btn_name,
    'item_preview' : '<i class="fa  fa-hand-pointer-o text-'+btn_name+'"></i> button '+btn_name,
    'item_content' : '<a class="btn btn-'+btn_name+'">'+btn_name+'</a>',
    'component_group' : 'button'
  });
})
CcPageElement.addComponentItem({
    'item_name' : 'button_group',
    'item_preview' : '<i class="fa  fa-hand-pointer-o "></i> button group',
    'item_content' : '<div class="btn-group" role="group">'+
      '<button type="button" class="btn btn-default">Left</button>'+
      '<button type="button" class="btn btn-default">Middle</button>'+
      '<button type="button" class="btn btn-default">Right</button>'+
    '</div>'
    ,
    'component_group' : 'button'
  });
