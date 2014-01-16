$('.wkm-oracle').each(function() {
	var minLength = this.dataset.queryminlength;
	var endpoint  = this.dataset.url;
	var template = $(this).siblings('.wkm-template').html();

	$(this).select2({
		placeholder: "Rechercher un film de Dustin Hoffmann",
		minimumInputLength: minLength,
		adaptContainerCssClass: function(classes) {
			return classes.replace('form-control', '');
		},
		formatResult: function(result) {
			if (!template) {
				return result.text;
			}

			return template.replace('{{value}}', result.text);
		},
		ajax: {
			url      : endpoint,
			dataType : 'json',
			data     : function (term) {
				return {q: term};
			},
			results: function (data, page) {
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