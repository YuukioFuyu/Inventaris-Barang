
/**
 * cc extension
 *
 * set extensions, add buttons to medium editor
 *
 * @constructor
 * @return {void}
 */
function CcMediumExtension() {
  
    /* default button */
    this.listButtons = [
      'bold', 'italic', 
      'underline', 
      { name : 'justifyLeft', contentDefault : '<i class="fa fa-align-left"></i>'},
      { name : 'justifyCenter', contentDefault : '<i class="fa fa-align-center"></i>'},
      { name : 'justifyRight', contentDefault : '<i class="fa fa-align-right"></i>'},
      { name : 'justifyFull', contentDefault : '<i class="fa fa-align-justify"></i>'},
      { name : 'anchor', contentDefault : '<i class="fa fa-chain"></i>'},
      'anchor', 
      'h1', 
      'h2', 
      'h3', 
      'h4', 
      'quote'];

    this.listExtensions = {};
}

CcMediumExtension.prototype.addButton = function(buttonName) {
    this.listButtons.push(buttonName);
};

CcMediumExtension.prototype.getButton = function() {
    return this.listButtons;
};

CcMediumExtension.prototype.addExtension = function(extensionName, ext) {
    this.listExtensions[extensionName] = ext;
};

CcMediumExtension.prototype.getExtension = function() {
    return this.listExtensions;
};

var CcMediumExtension = new CcMediumExtension;