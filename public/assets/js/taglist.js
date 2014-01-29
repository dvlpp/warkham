$('.wkm-taglist').each(function() {
	var $field      = $(this);
	var values      = $field.data('tags') || [];
	var tags        = $field.data('dataset') || [];
	var maxSize     = $field.data('maxselectionsize') || 999;
	var allowCreate = $field.data('allowcreate');

	// Default for allowCreate
	if (allowCreate == void 0) {
		allowCreate = true;
	}

	// Format tags
	for (i = 0; i < tags.length; i++) {
		tags[i] = {text: tags[i], value: tags[i]};
	}

	$field.val(values.join(',')).selectize({
		onInitialize : replaceSelectizeClasses,
		create       : allowCreate,
		maxItems     : maxSize,
		options      : tags,
	});
});