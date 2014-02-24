//////////////////////////////////////////////////////////////////////
///////////////////////////// AUTOCOMPLETE ///////////////////////////
//////////////////////////////////////////////////////////////////////

$('.wkm-autocomplete').each(function() {
	var values   = JSON.parse(this.dataset.values);
	var endpoint = this.dataset.url;
	var template = $(this).siblings('.wkm-template').html();

	// Create Bloodhound object
	var bloodhound = new Bloodhound({
		name           : $(this).attr('name'),
		local          : values,
		remote         : endpoint,
		queryTokenizer : Bloodhound.tokenizers.whitespace,
		datumTokenizer : Bloodhound.tokenizers.whitespace,
	});

	// Initialize Bloodhound
	bloodhound.initialize();

	// Initialize Typeahead
	$(this).typeahead(null, {
		source     : bloodhound.ttAdapter(),
		displayKey : function(suggestion) {
			return suggestion;
		},
		templates : {
			suggestion: function(string) {
				return Handlebars.compile(template)({value: string});
			},
		},
	});
});