$('.wkm-autocomplete').each(function() {
	var values   = JSON.parse(this.dataset.values);
	var endpoint = this.dataset.url;
	var template = $(this).siblings('.wkm-template').html();

	$(this).typeahead({
		prefetch : values,
		remote   : endpoint,
		template : template,
		engine   : Hogan,
	});
});