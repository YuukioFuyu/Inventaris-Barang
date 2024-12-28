// Copyright (c) 2015, Fujana Solutions - Moritz Maleck. All rights reserved.
// For licensing, see LICENSE.md

CKEDITOR.plugins.add( 'imageuploader', {
	icons : 'code', // %REMOVE_LINE_CORE%
    init: function( editor ) {
        editor.config.filebrowserBrowseUrl = BASE_URL + 'ckeditor/plugins/imageuploader/imgbrowser.php';
    }
});
