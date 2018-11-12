'use strict';

module.exports=function(grunt){
    require('time-grunt')(grunt);
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        clean:{
            devel:'.tmp'
          , dist:'../php/draft'
        }
      , concurrent:{
            devel:[
                'jade:devel'
              , 'less:devel'
            ]
          , dist:[
                'jade:dist'
              , 'less:dist'
            ]
        }
      , jade:{
            devel:{
                options:{
                    pretty:true
                  , data:{
                        debug:true
                    }
                }
              , files:{
                    '.tmp/index.html':'web/jade/index-dev.jade'
                  , '.tmp/map.html':'web/jade/map.jade'
                }
            }
          , dist:{
                options:{
                    pretty:false
                }
              , files:{
                    '.tmp/index.html':'web/jade/index-prod.jade'
                }
            }
        }
      , less:{
            devel:{
                options:{
                    dumpLineNumbers:'all'
                  , paths:['bower_components']
                }
              , files:{
                    '.tmp/style.css':'web/less/index.less'
                }
            }
          , dist:{
                options:{
                    cleancss:true
                  , paths:['bower_components']
                }
              , files:{
                    '.tmp/style.css':'web/less/index.less'
                }
            }
        }
      , connect:{
            options:{
                port:2999
              , livereload:35729
              , hostname:'localhost'
            }
          , livereload:{
                options:{
                    base:['.tmp']
                  , middleware:function(connect){
                        return [
                            connect.static('.tmp')
                          , connect.static('public')
                          , connect().use('/vendor',
                                connect.static('bower_components'))
                        ];
                    }
                }
            }
        }
      , watch:{
            jade:{
                files:['web/jade/**/*.jade']
              , tasks:['jade:devel']
            }
          , less:{
                files:['web/less/**/*.less']
              , tasks:['less:devel']
            }
          , js:{
                files:['public/js/**/*.js']
              , options:{
                    livereload:true
                }
            }
          , livereload:{
                options:{
                    livereload:'<%= connect.options.livereload %>'
                }
              , files:[
                    '.tmp/index.html'
                  , '.tmp/map.html'
                  , '.tmp/style.css'
                ]
            }
        }
      , concat:{
            options:{
                separator:';'
            }
          , dist:{
                src:[
                    'public/js/blueprint.js'
                  , 'public/js/drag.js'
                  , 'public/js/abs/simple.js'
                  , 'public/js/abs/multiple.js'
                  , 'public/js/abs/compose2.js'
                  , 'public/js/abs/graph2.js'
                  , 'public/js/abs/install.js'
                  , 'public/js/obj/lines/line.js'
                  , 'public/js/obj/lines/polyline.js'
                  , 'public/js/obj/areas/rect.js'
                  , 'public/js/obj/areas/polygon.js'
                  , 'public/js/obj/areas/arc.js'
                  , 'public/js/obj/doors/door1.js'
                  , 'public/js/obj/doors/door2.js'
                  , 'public/js/obj/doors/door3.js'
                  , 'public/js/obj/doors/door4.js'
                  , 'public/js/obj/doors/door5.js'
                  , 'public/js/obj/doors/door6.js'
                  , 'public/js/obj/doors/door7.js'
                  , 'public/js/obj/windows/window1.js'
                  , 'public/js/obj/gas/meter.js'
                  , 'public/js/obj/gas/piston.js'
                  , 'public/js/obj/gas/input.js'
                  , 'public/js/obj/gas/output.js'
                  , 'public/js/obj/gas/aeration.js'
                  , 'public/js/obj/gas/heater.js'
                  , 'public/js/obj/rooms.js'
                  , 'public/js/obj/text.js'
                  , 'public/js/obj/graph.js'
                  , 'public/js/index.js'
                ]
              , dest:'.tmp/blueprint.js'
            }
        }
      , uglify:{
            dist:{
                files:{
                    '../php/draft/js/blueprint.js':['.tmp/blueprint.js']
                }
            }
        }
      , cssmin:{
            dist:{
                files:{
                    '../php/draft/style.css':['.tmp/style.css']
                  , '../php/draft/leaflet.css':['bower_components/leaflet/dist/leaflet.css']
                }
            }
        }
      , htmlmin:{
            dist:{
                options:{
                    collapseBooleanAttributes:true
                  , collapseWhitespace:true
                  , removeAttributeQuotes:true
                  , removeComments:true
                }
              , files:{
                    '../php/draft/index.php':'.tmp/index.html'
                }
            }
        }
      , copy:{
            dist:{
                files:[{
                    src:'public/favicon.ico'
                  , dest:'../php/draft/favicon.ico'
                },{
                    src:'public/svg/buttons_.svg'
                  , dest:'../php/draft/svg/buttons.svg'
                },{
                    src:'public/svg/obj/*.svg'
                  , dest:'../php/draft/svg/obj/'
                  , flatten:true
                  , expand:true
                },{
                    src:'bower_components/leaflet/dist/images/*.png'
                  , dest:'../php/draft/images'
                  , expand:true
                  , flatten:true
                },{
                    src:'bower_components/leaflet/dist/leaflet.js'
                  , dest:'../php/draft/js/leaflet.min.js'
                },{
                    src:'bower_components/jquery/dist/jquery.min.js'
                  , dest:'../php/draft/js/jquery.min.js'
                },{
                    src:'bower_components/d3/d3.min.js'
                  , dest:'../php/draft/js/d3.min.js'
                },{
                    src:'php/rest/*.php'
                  , dest:'../php/draft/rest/'
                  , expand:true
                  , flatten:true
                },{
                    src:'php/rest/draw/*.php'
                  , dest:'../php/draft/rest/draw/'
                  , expand:true
                  , flatten:true
                }]
            }
        }
      , chmod:{
            options:{
                mode:'777'
            }
          , data:{
                src:['../php/draft/data','../php/draft/data/*']
            }
        }
    });

    grunt.registerTask('serve',[
        'clean:devel'
      , 'concurrent:devel'
      , 'connect:livereload'
      , 'watch'
    ]);

    grunt.registerTask('build',[
        'clean'
      , 'concurrent:dist'
      , 'concat'
      , 'uglify'
      , 'cssmin'
      , 'htmlmin'
      , 'copy'
      , 'chmod'
    ]);
};

