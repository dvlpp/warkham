module.exports = {
	dist: {
		expand : true,
		cwd    : '<%= paths.compiled.css %>',
		src    : '<%= name %>.css',
		dest   : '<%= paths.compiled.css %>',
		ext    : '.min.css'
	}
};