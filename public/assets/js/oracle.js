$('.wkm-oracle[data-remote="true"]').each(function() {
	var $field   = $(this);
	var endpoint = $field.data('url');

	$field.typeahead({
		prefetch: endpoint,
	});
	$('.tt-hint').addClass('form-control');
});