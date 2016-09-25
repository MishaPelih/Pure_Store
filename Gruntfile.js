module.exports = function( grunt ) {

    grunt.initConfig ({

        pkg: grunt.file.readJSON('package.json'),

        watch: {
            scripts: {
                files: ['less/**/*.less'],
                tasks: ['concat','less'],
                options: {
                    spawn: false
                }
            }
        },

        concat: {
            basic_and_extras: {
                files: {
                    'less/style.less': [
                        getLess( 'themeinfo' ),
                        getLess( 'config' ),
                        getLess( 'fonts' ),
                        getLess( 'mixins' ),
                        getLess( 'base/body' ),
                        getLess( 'base/buttons' ),
                        getLess( 'base/global' ),
                        getLess( 'base/*' ),
                        getLess( 'libs/*' ),
                        getLess( 'libs/defaults/*' ),
                        getLess( 'blog/blog.less' ),
                        getLess( 'blog/**/*' ),
                        getLess( 'woocommerce/woocommerce.less' ),
                        getLess( 'woocommerce/**/*' ),
                        getLess( 'modules/**/*' )
                    ],
                }
            }
        },

        less: {
            development: {
                /* options: {
                    compress: true
                },*/
                files: {
                    "style.css": "less/style.less",
                }
            }
        },

        postcss: {
            options: {
                    map: false,
                    processors: [require('autoprefixer')({browsers: ['last 20 version']})]
            },
            dist: {
                    src: ['style.css']
            }
        },

        cssmin: {
                target: {
                files:
                [{
                    expand: true,
                    cwd: 'css/',
                    src: ['*.css', '!*.min.css'],
                    dest: 'css/',
                    ext: '.min.css',
                }, /*{
                    expand: true,
                    cwd: 'css/lib/',
                    src: ['*.css'],
                    dest: 'css/lib/',
                    ext: '.min.css',
                }*/],
                }
        },

        uglify: {
            options: {
                /*mangle: { except: ['js/lib/*.js'], }*/
            },
            target: {
                files: [{
                    expand: true,
                    cwd: 'src/js/',
                    src: ['*.js', '!*.min.js'],
                    dest: 'js/',
                    ext: '.min.js',
                }]
            }
        }

    });

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-newer');

    grunt.registerTask('default', ['concat', 'less', 'newer:postcss:dist','newer:cssmin','newer:uglify']);

    function getLess( path ) { return 'less/' + path + '.less'; };
};