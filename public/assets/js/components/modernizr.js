var components = 'components';

// Tests
//////////////////////////////////////////////////////////////////////

/**
 * Test an input for sanitation
 *
 * @param {String} type
 * @param {String} correct
 *
 * @return {Boolean}
 */
var testInputType = function(type, correct) {
	var element   = document.createElement('input');
	var incorrect = 'incorrect';

	// Set type
	element.setAttribute('type', type);

	// Check if the browser corrected us
	element.setAttribute('value', incorrect);
	incorrect = element.value !== incorrect;

	// And if it didn't
	element.setAttribute('value', correct);
	correct = element.value === correct;

	return correct && incorrect;
};

Modernizr.date = testInputType('date', '2013-12-02');
Modernizr.time = testInputType('time', '12:34');

// Polyfills loading
//////////////////////////////////////////////////////////////////////

yepnope([
	{
		test : Modernizr.date,
		nope : [
			components + '/jquery-ui/themes/ui-lightness/jquery-ui.min.css',
			components + '/jquery-ui/ui/minified/jquery-ui.min.js',
		],
		complete : function() {
			if (!Modernizr.date) {
				$('input[type="date"]').attr('type', 'text').datepicker();
			}
		},
	},
	{
		test : Modernizr.time,
		nope : [
			components + '/jquery-timepicker-jt/jquery.timepicker.css',
			components + '/jquery-timepicker-jt/jquery.timepicker.min.js',
		],
		complete : function() {
			if (!Modernizr.time) {
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