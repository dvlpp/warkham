module.exports = function(grunt) {

	// Load modules
	require('load-grunt-tasks')(grunt);

	/**
	 * Loads all available tasks options
	 *
	 * @param {String} folder
	 *
	 * @return {Object}
	 */
	function loadConfig(folder) {
		var glob = require('glob');
		var path = require('path');
		var key;

		glob.sync('**/*.js', {cwd: folder}).forEach(function(option) {
			key = path.basename(option, '.js');
			config[key] = require(folder + option);
		});
	}

	////////////////////////////////////////////////////////////////////
	//////////////////////////// CONFIGURATION /////////////////////////
	////////////////////////////////////////////////////////////////////

	var config = {
		name : 'warkham',

		src        : 'public/assets',
		builds     : 'public/builds',
		components : 'public/components',

		paths: {
			original: {
				css  : '<%= src %>/css',
				img  : '<%= src %>/img',
				js   : '<%= src %>/js',
				sass : '<%= src %>/sass',
			},
			compiled: {
				js  : '<%= builds %>/js',
				img : '<%= builds %>/img',
				css : '<%= builds %>/css',
			},
		},
	};

	// Load all tasks
	loadConfig('./.grunt/');
	grunt.initConfig(config);

	////////////////////////////////////////////////////////////////////
	/////////////////////////////// COMMANDS ///////////////////////////
	////////////////////////////////////////////////////////////////////

	grunt.registerTask('default', 'Build assets for local', [
		'bower',
		'css',
		'js',
	]);

	grunt.registerTask('test', 'Launch the tests', ['phpunit:dist']);

	// Asset types
	////////////////////////////////////////////////////////////////////

	grunt.registerTask('css', 'Build stylesheets', [
		'compass:compile',
		'concat:css',
		'cssmin',
	]);

	grunt.registerTask('js', 'Build scripts', [
		'concat:js',
		'uglify',
	]);
};