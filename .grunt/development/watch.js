module.exports = {
	options: {
		livereload: true,
	},

	grunt: {
		files: 'Gruntfile.js',
		tasks: 'default',
	},
	css: {
		files: ['<%= paths.original.sass %>/**/*'],
		tasks: ['css'],
	},
	js: {
		files: ['<%= paths.original.js %>/**/*'],
		tasks: ['js'],
	},
};