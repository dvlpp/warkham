module.exports = {
	options: {
		interrupt : true,
		livereload: true,
	},

	grunt: {
		files: 'Gruntfile.js',
		tasks: 'default',
	},
	scripts: {
		files: ['<%= paths.original.js %>/**/*'],
		tasks: ['js'],
	},
};