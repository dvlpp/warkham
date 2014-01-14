module.exports = function(grunt) {

	// Load modules
	require('load-grunt-tasks')(grunt);

	// Project configuration.
	grunt.initConfig({

		name: 'warkham',

		//////////////////////////////////////////////////////////////////
		/////////////////////////////// PATHS ////////////////////////////
		//////////////////////////////////////////////////////////////////

		src        : 'public',
		builds     : 'public',
		components : '<%= src %>/components',

		paths: {
			original: {
				css  : '<%= src %>/assets/css',
				js   : '<%= src %>/assets/js',
			},
			compiled: {
				js  : '<%= builds %>',
				css : '<%= builds %>',
			},
		},

		//////////////////////////////////////////////////////////////////
		/////////////////////////////// TASKS ////////////////////////////
		//////////////////////////////////////////////////////////////////

		// Development
		//////////////////////////////////////////////////////////////////

		watch: {
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
		},

		phpunit: {
			options: {
				followOutput: true,
			},

			dist: {},

			coverage: {
				options: {
					coverageText: 'coverage.txt',
					coverageHtml: 'tests/.coverage'
				}
			},
		},

		// Assets
		//////////////////////////////////////////////////////////////////

		bower: {
			install: {
				options: {
					targetDir: '<%= components %>'
				}
			}
		},

		concat: {
			css: {
				dest: '<%= paths.compiled.css %>/<%= name %>.css',
				src: [
					'<%= components %>/bootstrap/dist/css/bootstrap.css',
					'<%= components %>/select2/select2.css',
				],
			},
			js: {
				dest: '<%= paths.compiled.js %>/<%= name %>.js',
				src: [
					'<%= components %>/jquery/jquery.js',
					'<%= components %>/select2/select.js',
					'<%= paths.original.js %>/**/*.js'
				],
			}
		},

		cssmin: {
			dist: {
				expand : true,
				cwd    : '<%= builds %>',
				src    : '<%= name %>.css',
				dest   : '<%= builds %>',
				ext    : '.min.css'
			}
		},

		uglify: {
			dist: {
				expand : true,
				cwd    : '<%= paths.compiled.js %>',
				src    : '<%= name %>.js',
				dest   : '<%= paths.compiled.js %>',
				ext    : '.min.js',
			}
		},

	});

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
		'concat:css',
		'cssmin',
	]);

	grunt.registerTask('js', 'Build scripts', [
		'concat:js',
		'uglify',
	]);
};