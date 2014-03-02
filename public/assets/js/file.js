$('.wkm-file-wrapper').each(function() {
	var $file     = $(this).find('input');
	var endpoint  = $file.data('url') || window.location.href;
	var thumbnail = $file.data('data-thumbnail');
	var width     = $file.data('data-thumbnailwidth');
	var height    = $file.data('data-thumbnailheight');
	var multiple  = $file.data('multiple') || false;

	var options = {
		url        : endpoint,
		multiple   : multiple,
		maxSize    : 20 * FileAPI.MB,
		autoUpload : true,
		elements   : {
			size: '.js-size',
			active: { show: '.js-upload', hide: '.js-browse' },
			progress: '.js-progress'
		}
	};

	if (thumbnail) {
		options.imageSize = {
			minWidth  : width,
			minHeight : height,
		};

		options.elements.preview = {
			el: '.js-preview',
			width: width,
			height: height
		};
	}

	console.log(options);

	$(this).fileapi(options);
});