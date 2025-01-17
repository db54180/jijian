$(function() {
	var browse_button = 'img_upload';
	var img_uploader = new plupload.Uploader({
		runtimes : 'html5,flash',
		browse_button : browse_button, // you can pass an id...
		container : document.getElementById('img_upload_container'), // ... or DOM Element itself
		url : upload_url,
		flash_swf_url : app_path + '/Public/Static/plupload/Moxie.swf',
		chunk_size : '2mb',
		filters : {
			max_file_size : '2mb',
			mime_types : [{
				title : "image files",
				extensions : "jpg,gif,png"
			}]
		},

		init : {
			FilesAdded : function(up, files) {
				up.start();
			},
			FileUploaded : function(up, file, data) {
				var myObject = eval('(' + data.response + ')');
				if (myObject.status) {
					$img = "<p><img src='" + myObject.path + "'></p>";
					tinymce.EditorManager.activeEditor.insertContent($img);
				} else {
					ui_alert(myObject.info, function() {

					});
				}
			},
			Error : function(up, err) {
				document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
			}
		}
	});
	
 	img_uploader.init();
 	
	if (is_mobile()) {
		$editor = {
			language : "zh_CN",
			selector : ".editor",
			plugins : ["autosave imageupload advlist autolink lists link image imagetools charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
			toolbar : "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link imageupload",
		};
		$simple = {
			menu : {},
			language : "zh_CN",
			selector : ".simple",
			plugins : ["autosave imageupload advlist autolink lists link image imagetools charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
			toolbar : false,
		};

	} else {
		$editor = {
			language : "zh_CN",
			selector : ".editor",
			plugins : ["autosave imageupload advlist autolink lists link image imagetools charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
			toolbar : "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link imageupload",
		};
		$simple = {
			menu : {},
			language : "zh_CN",
			selector : ".simple",
			plugins : ["autosave imageupload advlist autolink lists link image imagetools charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
			toolbar : "styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link imageupload",
		};
	}

	tinymce.init($editor);
	tinymce.init($simple);
});
