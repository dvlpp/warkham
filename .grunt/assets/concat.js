module.exports = {
	css: {
		dest: '<%= paths.compiled.css %>/<%= name %>.css',
		src: [
			'<%= components %>/bootstrap/dist/css/bootstrap.css',
			'<%= components %>/select2/select2.css',
		],
	},
	js: {
		dest: '<%= paths.compiled.js %>/<%= name %>.js',
		src: [
			'<%= components %>/jquery/jquery.js',
			'<%= components %>/select2/select.js',
			'<%= paths.original.js %>/**/*.js'
		],
	}
};