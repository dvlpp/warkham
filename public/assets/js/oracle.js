//////////////////////////////////////////////////////////////////////
///////////////////////////////// ORACLE /////////////////////////////
//////////////////////////////////////////////////////////////////////

$('.wkm-oracle').each(function() {
	var minLength   = this.dataset.queryminlength;
	var endpoint    = this.dataset.url;
	var placeholder = $(this).attr('placeholder');
	var template    = $(this).siblings('.wkm-template').html();

	$(this).select2({
		placeholder            : placeholder,
		allowClear             : true,
		minimumInputLength     : minLength,
		adaptContainerCssClass : replaceClasses,
		formatResult           : function(string) {
			return Handlebars.compile(template)({value: string});
		},
		ajax : {
			url      : endpoint,
			dataType : 'json',
			data     : function (term) {
				return {q: term};
			},
			results: function (data) {
				var results = [];
				for(var k = 0; k < data.length; k++) {
					results.push({
						id   : k + 1,
						text : data[k],
					});
				}

				return {results: results};
			}
		}
	});
});