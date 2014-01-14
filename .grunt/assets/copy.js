module.exports = {
	dist: {
		files: [
			{
				expand : true,
				src    : ['**'],
				cwd    : '<%= paths.original.img %>',
				dest   : '<%= paths.compiled.img %>'
			},
			{
				expand : true,
				src    : ['*.png'],
				cwd    : '<%= components %>/select2/',
				dest   : '<%= paths.compiled.css %>'
			}
		]
	}
};