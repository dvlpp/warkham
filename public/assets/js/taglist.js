//////////////////////////////////////////////////////////////////////
/////////////////////////////// TAGLIST //////////////////////////////
//////////////////////////////////////////////////////////////////////

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

	$field.select2({
		adaptContainerCssClass : replaceClasses,
		tags                   : tags,
		maximumSelectionSize   : maxSize,
		createSearchChoice     : function(term) {
			return allowCreate ? {id: 0, text: term} : false;
		}
	});

	// Initialize values
	$field.val(values).trigger('change');
});