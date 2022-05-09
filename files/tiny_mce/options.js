	tinyMCE.init({
		// General options
		mode : "specific_textareas",
		editor_selector : "mceEditor",
		theme : "advanced",
		height : "280",
		width : "100%",
		language : "ru",
		plugins : "imagemanager,filemanager,style,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist",

		// Theme options
		theme_advanced_buttons1 : "code,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,forecolor,backcolor,formatselect,fontselect,fontsizeselect,styleselect,sub,sup",
		theme_advanced_buttons2 : "bullist,numlist,|,link,unlink,image,media,charmap,iespell,advhr,|,tablecontrols",
		theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		extended_valid_elements : "iframe[name|src|framespacing|border|frameborder|scrolling|title|height|width],noindex,section[*],aside[*],article[*],script[type|src|async|charset],span[*],div[*],center,a[*],b[*],ul[*]",
		verify_html: false,
		
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
//		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		forced_root_block : false,
		force_br_newlines : true,
		force_p_newlines : false,
		
//                content_css : '/admin/templates/files/misc.css',
		// Style formats
		style_formats : [
                        {title : 'Right bar', selector : '*', classes : 'rightbar'},
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],
    formats: {
        bold : {inline : 'b' },  
        //italic : {inline : 'i' },
        //underline : {inline : 'u'}
    },
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});