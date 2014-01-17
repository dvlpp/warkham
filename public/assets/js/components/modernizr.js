yepnope([
	{
		test     : Modernizr.inputtypes,
		nope     : ['components/jquery-ui/ui/minified/jquery-ui.min.js', 'components/jquery-ui/themes/ui-lightness/jquery-ui.min.css'],
		complete : function() {
			if (!Modernizr.inputtypes) {
				$('input[type="date"]').attr('type', 'text').datepicker();
			}
		},
	}
]);