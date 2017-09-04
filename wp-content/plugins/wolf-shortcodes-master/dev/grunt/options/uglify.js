module.exports = {
	
	options: {
		mangle: true,
		banner : '/*! <%= app.name %> v<%= app.version %> */\n'
	},

	dist: {
		files: {
			'../assets/js/min/accordion.min.js': [ '../assets/js/accordion.js'],
			'../assets/js/min/notifications.min.js': [ '../assets/js/notifications.js'],
			'../assets/js/min/tabs.min.js': [ '../assets/js/tabs.js'],
			'../assets/js/min/toggles.min.js': [ '../assets/js/toggles.js'],
		}
	}
	
};