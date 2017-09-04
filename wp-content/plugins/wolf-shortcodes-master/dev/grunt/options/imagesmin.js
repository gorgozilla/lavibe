module.exports = {

	assets: {                       
		files: [{
			expand: true,
			cwd: '../assets/images/',
			src: ['**/*.{png,jpg,gif}'],
			dest: '../pack/<%= app.slug %>/assets/images/'
		}]
	}	

};