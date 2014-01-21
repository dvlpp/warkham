$('button[data-action="add-item"]').click(function(event) {
	event.preventDefault();

	// Get template
	var $template = $(this).siblings('.wkm-template')
		.clone()
		.removeClass('wkm-template');

	// Insert it before
	$(this).before($template);
});

$('.wkm-items').on('click', 'button[data-action="remove-item"]', function(event) {
	event.preventDefault();

	$(this).closest('ul').remove();
});