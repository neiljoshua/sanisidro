module.exports = function(grunt) {
grunt.initConfig({
  compass: {
    dist: {
      options: {
        sassDir: 'src/sass/',
        specify: 'src/sass/style.scss',
        cssDir: 'src/css'
      }
    }
  },

  cssmin: {
    options: {
      mergeIntoShorthands: false,
      roundingPrecision: -1
    },
    target: {
      files: {
        'style.css': ['src/css/style.css', 'src/css/slick-theme.css','src/css/slick.css','src/css/pluggins/*.*']
      }
    }
  },

  uglify: {
    my_target: {
      files: {
        'sanisidro.js': ['src/js/*.js','src/js/slick-init.js', 'src/js/vendors/*.*']
      }
    }
  },

  watch: {
    css: {
      files: ['src/sass/*.scss', 'style.css'],
      tasks: ['compass', 'cssmin']
    },
    scripts: {
      files: 'src/js/*.js',
      tasks: 'uglify',
    },
  }

});

grunt.loadNpmTasks('grunt-contrib-compass');
grunt.loadNpmTasks('grunt-contrib-cssmin');
grunt.loadNpmTasks('grunt-contrib-uglify');
grunt.loadNpmTasks('grunt-contrib-watch');

grunt.registerTask('default', ['watch']);
grunt.registerTask('dev', ['compass']);
}
