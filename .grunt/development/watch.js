module.exports = {
	options: {
		livereload: true,
	},

	grunt: {
		files: ['Gruntfile.js', '.grunt/**/*'],
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