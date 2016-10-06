/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.addStylesSet( 'basic_styles',
[
    // Block Styles
    { name : 'Normaal' , element : 'p', styles : {  } },
    { name : 'Titel1' , element : 'h1', styles : {  } },
    { name : 'Titel2' , element : 'h2', styles : {  } },
    { name : 'Titel3' , element : 'h3', styles : {  } }
]);



CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	config.toolbar = 'Full';
	
	/*config.toolbar_Admin =
	[
	    ['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList', 'Indent', 'Outdent', '-', 'Link', 'Unlink','Image','Styles']
	];*/
	config.stylesCombo_stylesSet = 'basic_styles';
	
	
	//alert(webpath);
	config.filebrowserBrowseUrl = webpath+'js/kcfinder-2.21/browse.php?type=files';
	config.filebrowserImageBrowseUrl = webpath+'js/kcfinder-2.21/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = webpath+'js/kcfinder-2.21/browse.php?type=flash';
	config.filebrowserUploadUrl = webpath+'js/kcfinder-2.21/upload.php?type=files';
	config.filebrowserImageUploadUrl = webpath+'js/kcfinder-2.21/upload.php?type=images';
	config.filebrowserFlashUploadUrl = webpath+'js/kcfinder-2.21/upload.php?type=flash';

};
