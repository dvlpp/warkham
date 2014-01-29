var replaceClasses = function(classes) {
	return classes.replace('form-control', '');
};

var replaceSelectizeClasses = function() {
	$('.selectized, .selectize-control, .selectize-dropdown').removeClass('form-control');
};