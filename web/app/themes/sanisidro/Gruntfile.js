module.exports = function(grunt) {
grunt.initConfig({
  compass: {
    dist: {
      options: {
        sassDir: 'src/sass/',
        specify: 'src/sass/style.scss',
        cssDir: '../sanisidro'
      }
    }
  },

  watch: {
  css: {
    files: ['src/sass/*.scss'],
    tasks: ['compass']
  }
}

});

grunt.loadNpmTasks('grunt-contrib-compass');
grunt.loadNpmTasks('grunt-contrib-watch');

grunt.registerTask('default', ['watch']);
grunt.registerTask('dev', ['compass']);
}