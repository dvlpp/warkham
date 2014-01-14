module.exports = {
	dist: {
		expand : true,
		cwd    : '<%= builds %>',
		src    : '<%= name %>.css',
		dest   : '<%= builds %>',
		ext    : '.min.css'
	}
};