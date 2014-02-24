module.exports = {
	css: {
		dest: '<%= paths.compiled.css %>/<%= name %>.css',
		src: [
			'<%= paths.components.bootstrap.css %>',
			'<%= components %>/bootstrap-markdown/css/bootstrap-markdown.min.css',
			'<%= components %>/select2/select2.css',
			'<%= paths.original.css %>/**/*.css'
		],
	},
	js: {
		dest: '<%= paths.compiled.js %>/<%= name %>.js',
		src: [
			'<%= paths.components.jquery %>',
			'<%= components %>/yepnope/yepnope.js',
			'<%= components %>/modernizr/modernizr.js',
			'<%= components %>/bootstrap-markdown/js/bootstrap-markdown.js',
			'<%= components %>/bootstrap-wysiwyg/bootstrap-wysiwyg.js',
			'<%= components %>/handlebars/handlebars.js',
			'<%= components %>/select2/select2.js',

			'<%= components %>/jquery-ui/ui/jquery.ui.core.js',
			'<%= components %>/jquery-ui/ui/jquery.ui.widget.js',
			'<%= components %>/jquery-ui/ui/jquery.ui.mouse.js',
			'<%= components %>/jquery-ui/ui/jquery.ui.sortable.js',

			'<%= components %>/typeahead.js/dist/typeahead.bundle.js',
			'<%= paths.original.js %>/components/*.js',
			'<%= paths.original.js %>/*.js',
		],
	}
};