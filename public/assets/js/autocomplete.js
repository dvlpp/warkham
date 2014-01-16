$('.wkm-autocomplete').each(function() {
	var values    = JSON.parse(this.dataset.values);
	var endpoint  = this.dataset.url;
	var $template = $(this).siblings('.wkm-template');

	$(this).typeahead({
		prefetch : endpoint,
		local    : values,
		template : $template.html(),
		engine   : Hogan,
	});
});