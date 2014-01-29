module.exports = {
	css: {
		dest: '<%= paths.compiled.css %>/<%= name %>.css',
		src: [
			'<%= components %>/bootstrap/dist/css/bootstrap.css',
			'<%= components %>/bootstrap-markdown/css/bootstrap-markdown.min.css',
			'<%= components %>/select2/select2.css',
			'<%= components %>/selectize/dist/css/selectize.default.css',
			'<%= paths.original.css %>/*.css'
		],
	},
	js: {
		dest: '<%= paths.compiled.js %>/<%= name %>.js',
		src: [
			'<%= components %>/jquery/jquery.js',
			'<%= components %>/yepnope/yepnope.js',
			'<%= components %>/modernizr/modernizr.js',
			'<%= components %>/bootstrap-markdown/js/bootstrap-markdown.js',
			'<%= components %>/bootstrap-wysiwyg/bootstrap-wysiwyg.js',
			'<%= components %>/hogan/web/1.0.0/hogan.js',
			'<%= components %>/select2/select2.js',
			'<%= components %>/selectize/dist/js/standalone/selectize.js',

			'<%= components %>/typeahead.js/dist/typeahead.js',
			'<%= paths.original.js %>/components/*.js',
			'<%= paths.original.js %>/*.js'
		],
	}
};