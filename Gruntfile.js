module.exports = function(grunt) {

	// Load modules
	grunt.loadNpmTasks('grunt-bower-task');

	// Project configuration.
	grunt.initConfig({

		//////////////////////////////////////////////////////////////////
		/////////////////////////////// PATHS ////////////////////////////
		//////////////////////////////////////////////////////////////////

		src        : 'public',
		builds     : 'public',
		components : '<%= src %>/components',

		paths: {
			original: {
				css  : '<%= src %>/css',
				js   : '<%= src %>/js',
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
			},

			grunt: {
				files: 'Gruntfile.js',
				tasks: 'default',
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

	});

	////////////////////////////////////////////////////////////////////
	/////////////////////////////// COMMANDS ///////////////////////////
	////////////////////////////////////////////////////////////////////

	grunt.registerTask('default', 'Build assets for local', [
		'bower',
	]);
};