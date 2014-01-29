$('.wkm-list').each(function() {
	var $field   = $(this);
	var multiple = $field.data('multiple');
	var maxSize  = $field.data('maxselectionsize') || 999;

	// Cancel if classic Choice
	if (!multiple) {
		return;
	}

	$field.selectize({
		maxItems     : maxSize,
		onInitialize : replaceSelectizeClasses,
	});
});