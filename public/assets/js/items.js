//////////////////////////////////////////////////////////////////////
///////////////////////////////// ITEMS //////////////////////////////
//////////////////////////////////////////////////////////////////////

// Addable
//////////////////////////////////////////////////////////////////////

$('button[data-action="add-item"]').click(function(event) {
	event.preventDefault();

	// Get template
	var index     = $(this).siblings('ul.list-group:not(.wkm-template)').length;
	var $template = $(this).siblings('.wkm-template')
		.clone()
		.removeClass('wkm-template')
		.get(0).outerHTML;

	// Replace index
	$template = $template.replace(/\[new\]/g, '[' +index+ ']');

	// Insert it before
	$(this).before($template);
});

// Removeable
//////////////////////////////////////////////////////////////////////

$('.wkm-items').on('click', 'button[data-action="remove-item"]', function(event) {
	event.preventDefault();

	$(this).closest('ul').remove();
});

// Sortable
//////////////////////////////////////////////////////////////////////

$('[data-sortable="true"] div').sortable();