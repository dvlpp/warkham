module.exports = function(grunt) {

	grunt.registerTask('default', 'Build assets for local', [
		'bower',
		'css',
		'js',
		'copy',
	]);

	grunt.registerTask('test', 'Launch the tests', ['phpunit:dist']);

	// Asset types
	////////////////////////////////////////////////////////////////////

	grunt.registerTask('css', 'Build stylesheets', [
		'compass:compile',
		'autoprefixer',
		'csslint',
		'csscss',
		'concat:css',
		'cssmin',
	]);

	grunt.registerTask('js', 'Build scripts', [
		'concat:js',
		'jshint',
		'uglify',
	]);

}