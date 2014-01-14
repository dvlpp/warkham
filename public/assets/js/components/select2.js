$('select').select2({
	adaptContainerCssClass: function(classes) {
		return classes.replace('form-control', '');
	},
});