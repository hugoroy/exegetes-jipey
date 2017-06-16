module.exports = function (grunt) {


    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        clean: {
            js: [
                'web/assets/js'
            ]
        },
        sass: {
            build: {
                options: {
                    sourcemap: 'none',
                    style: 'expanded'
                },
                files: [{
                    expand: true,
                    cwd: 'app/Resources/assets/sass',
                    src: ['**/*.scss'],
                    dest: 'web/assets/css',
                    ext: '.css'
                }]
            }
        },
        copy: {
            dt: {
                files: [{
                    expand: true,
                    cwd: 'app/Resources/lib/datatables/media/images',
                    src: ['**/*'],
                    dest: 'web/assets/images'
                }]
            },
            fonts: {
                files: [{
                    expand: true,
                    cwd: 'app/Resources/lib/bootstrap-sass/assets/fonts',
                    src: ['**/*'],
                    dest: 'web/assets/fonts'
                }]
            }
        },
        concat: {
            js: {
                options: {
                    separator: ';\n'
                },
                files: {
                    'web/assets/js/main.js': [
                        'app/Resources/lib/jquery/dist/jquery.js',
                        'app/Resources/lib/bootstrap-sass/assets/javascripts/bootstrap.js',
                        'app/Resources/lib/datatables.net/js/jquery.dataTables.min.js',
                        'app/Resources/lib/datatables.net-bs/js/dataTables.bootstrap.js '
                    ]
                }
            }
        },
        watch: {
            options: {
                livereload: true,
                spawn: false
            },
            ts: {
                files: ['app/Resources/assets/ts/**/*.ts'],
                tasks: ['typescript']
            }
        }
    });


    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-symfony2');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['clean:js', 'sass', 'copy:dt', 'copy:fonts', 'concat:js']);

};