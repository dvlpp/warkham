module.exports = {
	options: {
		force   : true,
		browser : true,
		jquery  : true,
		devel   : true,

		bitwise       : true,
		camelcase     : true,
		curly         : true,
		eqeqeq        : true,
		freeze        : true,
		immed         : true,
		indent        : true,
		latedef       : true,
		maxcomplexity : 5,
		maxdepth      : 3,
		maxlen        : 120,
		maxparams     : 3,
		maxstatements : 15,
		newcap        : true,
		noarg         : true,
		noempty       : true,
		nonew         : true,
		quotmark      : true,
		trailing      : true,
		undef         : true,
		unused        : true,

		predef: ['Modernizr', 'Bloodhound', 'Handlebars', 'yepnope', 'FileAPI'],
		globals: {
			replaceClasses: true,
		}
	},

	all: ['<%= paths.original.js %>/*'],
};