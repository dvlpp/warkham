var components = 'components';

yepnope([
	{
		test : Modernizr.inputtypes,
		nope : [
			components + '/jquery-ui/themes/ui-lightness/jquery-ui.min.css',
			components + '/jquery-ui/ui/minified/jquery-ui.min.js',
			components + '/jquery-timepicker-jt/jquery.timepicker.css',
			components + '/jquery-timepicker-jt/jquery.timepicker.min.js',
		],
		complete : function() {
			if (!Modernizr.inputtypes) {
				// Set datepickers
				$('input[type="date"]').attr('type', 'text').datepicker();

				// Set timepickers
				$('input[type="time"]').each(function() {
					var $field = $(this);

					$field.attr('type', 'text').timepicker({
						maxTime : $field.attr('max'),
						minTime : $field.attr('min'),
						step    : $field.attr('step') / 60 || 1,
					});
				});
			}
		},
	}
]);