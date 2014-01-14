module.exports = {
	css: {
		dest: '<%= paths.compiled.css %>/<%= name %>.css',
		src: [
			'<%= components %>/bootstrap/dist/css/bootstrap.css',
			'<%= components %>/select2/select2.css',
			'<%= paths.original.css %>/*.css'
		],
	},
	js: {
		dest: '<%= paths.compiled.js %>/<%= name %>.js',
		src: [
			'<%= components %>/jquery/jquery.js',
			'<%= components %>/select2/select2.js',
			'<%= paths.original.js %>/**/*.js'
		],
	}
};