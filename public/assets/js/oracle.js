$('select.wkm-oracle').each(function() {
	var $field   = $(this);
	var endpoint = $field.data('url');

	$.getJSON(endpoint, function (results) {
		$.each(results, function (key, value) {
			$field.append(new Option(value, key));
		});

		$field.trigger('change');
	});
});