//////////////////////////////////////////////////////////////////////
////////////////////////////////// FORM //////////////////////////////
//////////////////////////////////////////////////////////////////////

$('form').submit(function(event) {
	event.preventDefault();

	// Strip templates from form before submit
	$(this).find('.wkm-template').remove();
	this.submit();
});
