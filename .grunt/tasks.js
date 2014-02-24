module.exports = function(grunt) {

	grunt.registerTask('default', 'Build assets for local', [
		'bower',
		'css',
		'js',
		'copy',
	]);

	grunt.registerTask('rebuild', 'Rebuild all assets from scratch', [
		'clean',
		'compass:clean',
		'default',
	]);

	grunt.registerTask('test', 'Launch the tests', ['phpunit:dist']);

	// Flow
	////////////////////////////////////////////////////////////////////

	grunt.registerTask('images', 'Recompress images', [
		'svgmin',
		'tinypng',
	]);

	// By filetype
	////////////////////////////////////////////////////////////////////

	grunt.registerTask('js', 'Build scripts', [
		'jshint',
		'concat:js',
		'uglify',
	]);

	grunt.registerTask('css', 'Build stylesheets', [
		'compass:compile',
		'csslint',
		'csscss',
		'autoprefixer',
		'concat:css',
		'cssmin',
	]);

}