/*register extension*/
CcMediumExtension.addExtension(
  'JS',
  new MediumButton({
      label: '<i class="fa fa-bank"></i>',
      start: '<pre><code>',
      end: '</code></pre>',
      action: function(html, mark, parent){
               return html;
              }
}));

/*register extension*/
CcMediumExtension.addExtension(
  'node',
  new MediumButton({
      label: '<i class="fa fa-bank"></i>',
      start: '<pre><code>',
      end: '</code></pre>',
      action: function(html, mark, parent){
               return html;
              }
}));

function Extension() {
  this.button = document.createElement('button');
  this.button.className = 'medium-editor-action fa fa-bars';
  this.button.onclick = this.onClick.bind(this);
}

Extension.prototype.getButton = function() {
  return this.button;
};

Extension.prototype.onClick = function() {
  alert('This is editor: #' + this.base.id);
};

/*register extension*/
CcMediumExtension.addExtension(
  'extension',
  new Extension()
);

/*register button*/
CcMediumExtension.addButton('extension');
CcMediumExtension.addButton('JS');
CcMediumExtension.addButton('node');