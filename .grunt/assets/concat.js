module.exports = {
	css: {
		files: {
			'<%= paths.compiled.css %>/<%= name %>.components.css': [
				'<%= paths.components.bootstrap.css %>',
				'<%= components %>/bootstrap/dist/css/bootstrap-theme.css',
			],
			'<%= paths.compiled.css %>/<%= name %>.core.css': [
				'<%= components %>/bootstrap-markdown/css/bootstrap-markdown.min.css',
				'<%= components %>/select2/select2.css',
				'<%= paths.original.css %>/**/*.css'
			],
			'<%= paths.compiled.css %>/<%= name %>.css': [
				'<%= paths.compiled.css %>/<%= name %>.components.css',
				'<%= paths.compiled.css %>/<%= name %>.core.css',
			],
		},
	},
	js: {
		files: {
			'<%= paths.compiled.js %>/<%= name %>.components.js': [
				'<%= paths.components.jquery %>',
			],
			'<%= paths.compiled.js %>/<%= name %>.core.js': [
				'<%= components %>/yepnope/yepnope.js',
				'<%= components %>/modernizr/modernizr.js',
				'<%= components %>/bootstrap-markdown/js/bootstrap-markdown.js',
				'<%= components %>/bootstrap-wysiwyg/bootstrap-wysiwyg.js',
				'<%= components %>/handlebars/handlebars.js',
				'<%= components %>/jquery.fileapi/FileAPI/FileAPI.min.js',
				'<%= components %>/jquery.fileapi/jquery.fileapi.js',
				'<%= components %>/select2/select2.js',

				'<%= components %>/jquery-ui/ui/jquery.ui.core.js',
				'<%= components %>/jquery-ui/ui/jquery.ui.widget.js',
				'<%= components %>/jquery-ui/ui/jquery.ui.mouse.js',
				'<%= components %>/jquery-ui/ui/jquery.ui.sortable.js',

				'<%= components %>/typeahead.js/dist/typeahead.bundle.js',
				'<%= paths.original.js %>/components/*.js',
				'<%= paths.original.js %>/*.js',
			],
			'<%= paths.compiled.js %>/<%= name %>.js': [
				'<%= paths.compiled.js %>/<%= name %>.components.js',
				'<%= paths.compiled.js %>/<%= name %>.core.js',
			],
		},
	}
};