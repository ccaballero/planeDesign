'use strict';

var set_view=false
  , show_map=false
  , show_controls=false
  , pane_marker=undefined
  , pane_map=undefined
  , zoomLat=[
        0.01
      , 0.005
      , 0.0025
      , 0.00125
      , 0.000625
      , 0.0003125
      , 0.00015625
      , 0.000078125
    ]
  , zoomLng=[
        0.01
      , 0.005
      , 0.0025
      , 0.00125
      , 0.000625
      , 0.0003125
      , 0.00015625
      , 0.000078125
    ]
  , map=L.map('map',{
        zoomControl:true
    })
  , marker=L.marker().addTo(map)
  , zoom=16
  , rest={
        list:   'rest/list.php'
      , get:    'rest/get.php'
      , check:  'rest/check.php'
      , create: 'rest/create.php'
      , update: 'rest/update.php'
      , svg:    'rest/svg.php'
      , png:    'rest/png.php'
    }

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?'
    +'access_token={accessToken}',{
    attribution:'Map data &copy; <a href="https://www.openstreetmap.org/">'
        +'OpenStreetMap</a> contributors, '
        +'<a href="https://creativecommons.org/licenses/by-sa/2.0/">'
        +'CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>'
  , minZoom:16
  , maxZoom:23
  , id:'mapbox.streets'
  , accessToken:'pk.eyJ1IjoiamFjb2JpYW4iLCJhIjoiQWFfMjJxYyJ9.'
        +'O50MgJ-QqbTAQjn6bIstfg'
}).addTo(map);
map.doubleClickZoom.disable();

$(function(){
    var file=null
      , modified=false

    blueprint.init('#canvas');
    blueprint.setmode('selector');

    $('#files').hide();

    $('.open').click(function(){
        if(show_controls){
            $('.controls').trigger('click');
        }

        $.get(rest.list,function(data){
            $('#files').toggle();

            $('.list').empty();
            data.forEach(function(item){
                var a=$('<a></a>',{
                        'text':item
                    })
                  , li=$('<li></li>',{
                        'class':'file'
                      , 'click':function(){
                            var text=$(this).children().first().text()

                            $.get(rest.get+'?file='+text,function(data){
                                file=text
                                document.title=text;

                                $('#main').empty();
                                blueprint.counter=0;

                                data.forEach(function(e){
                                    if(/^.*::.*$/.test(e)){
                                        var l=e.split('::')
                                          , c=l[0].trim().split(/ +/)
                                          , d=l[1].trim().split(/ +/)
                                          , e=l[2]?l[2].trim().split(/ +/):null

                                        if(c[0] in blueprint.obj
                                            && 'add' in blueprint.obj[c[0]]){
                                            blueprint.obj[c[0]].add(c,d,e);
                                        }else if(c[0]=='map'){
                                            pane_marker=[+d[0],+d[1]];
                                            pane_map=[+d[2],+d[3]];
                                            zoom=+d[4];

                                            $('.map').trigger('click');
                                        }
                                    }
                                });

                                d3.selectAll('#main>path,#main>text,#main>g')
                                    .on('click',blueprint.click)
                                    .on('dblclick',blueprint.dblclick)
                                    .on('mousedown',blueprint.mousedown)
                                    .on('mousemove',blueprint.mousemove)
                            });
                        }
                    })

                li.append(a);
                $('.list').append(li);
            });
        });
    });

    $('.close').click(function(){
        document.title='Nuevo Plano';
        $('#main').empty();
        file=null;
        modified=false;
        blueprint.counter=0;

        pane_marker=undefined;
        pane_map=undefined;
        zoom=16;
        set_view=false;

        if(show_map){
            $('.map').trigger('click');
        }
    });

    $('.save').click(function(){
        blueprint.deselect();
        var recover=function(){
                var contents=[]

                $('#main').children().each(function(){
                    var line=$(this)[0].attributes['class'].value.trim()+' :: '

                    switch($(this)[0].tagName){
                        case 'g':
                            var d=$(this)[0].firstChild
                                    .attributes['d'].value.trim()
                              , img=$(this).children('image')[0]

                            if(!img){
                                contents.push(line+d);
                            }else{
                                contents.push(line+d+' :: '+
                                    img.attributes['x'].value.trim()+' '+
                                    img.attributes['y'].value.trim()+' '+
                                    img.attributes['width'].value.trim()+' '+
                                    img.attributes['height'].value.trim()+' '+
                                    img.attributes['transform'].value.trim()
                                );
                            }

                            break;
                        case 'path':
                            contents.push(line
                                +$(this)[0].attributes['d'].value.trim());
                            break;
                        case 'text':
                            contents.push(line+
                                $(this)[0].attributes['x'].value.trim()+' '+
                                $(this)[0].attributes['y'].value.trim()+' '+
                                $(this)[0].textContent);
                            break;
                    }
                })

                if(set_view){
                    contents.push('map :: '+
                        marker.getLatLng().lat+' '+
                        marker.getLatLng().lng+' '+
                        map.getCenter().lat+' '+
                        map.getCenter().lng+' '+
                        map.getZoom()
                    );
                }

                return contents;
            }
          , save=function(file,is_new){
                if(is_new){
                    $.post(rest.create,{
                        'file':file
                      , 'content':recover()
                    }).done(function(){});
                }else{
                    $.post(rest.update,{
                        'file':file
                      , 'content':recover()
                    }).done(function(){});
                }
            }

        if(!file){
            var text=prompt('Ingrese el nombre del archivo')

            if(text){
                $.get(rest.check+'?file='+text,function(data){
                    if(data==true){
                        alert('El nombre de archivo no puede ser usado.');
                    }else{
                        file=text;
                        document.title=text;

                        save(text,true);
                    }
                });
            }
        }else{
            save(file,false);
        }
    });

    $('.cancel').click(function(){
        $('#files').hide();
    });

    $('.svg').click(function(){
        window.open(rest.svg+'?file='+file,'_blank');
    });

    $('.png').click(function(){
        window.open(rest.png+'?file='+file,'_blank');
    });

    $('.selector').click(function(){
        $(this).addClass('picked');
        $('.draw').removeClass('picked');
        blueprint.setmode('selector');
    });

    $('.remove').click(function(){
        blueprint.remove();
    });

    $('.draw').click(function(){
        $('.selector').removeClass('picked');
        $('.draw').removeClass('picked');
        $(this).addClass('picked');

        var regex=/^.* (.*) .*$/
          , type=regex.exec($(this).attr('class'))[1]
        blueprint.setmode('draw',type);
    });

    $('.order').click(function(){
        if(blueprint.selected){
            var id=blueprint.selected._groups[0][0].id
              , action=/^.* (.*)$/.exec($(this).attr('class'))[1]
              , current=$('#'+id)

            switch(action){
                case 'first':
                    current.parent().append(current);
                    blueprint.def.select(blueprint.selected);
                    break;
                case 'up':
                    if(current.not(':last-child')){
                        current.next().after(current);
                        blueprint.def.select(blueprint.selected);
                    }
                    break;
                case 'down':
                    if(current.not(':first-child')){
                        current.prev().before(current);
                    }
                    break;
                case 'last':
                    current.parent().prepend(current);
                    break;
            }
        }
        return false;
    });

    $(window).on('keypress',function(e){
        var stop=function(){
                e.preventDefault();
                e.stopPropagation();
            }
          , list={
                'F1':'button.selector'
              , 'Home':'button.order.first'
              , 'End':'button.order.last'
              , 'PageDown':'button.order.down'
              , 'PageUp':'button.order.up'
              , 't':'button.draw.text1'
              , 'l':'button.draw.line1'
              , 'L':'button.draw.polyline1'
              , 'r':'button.draw.rect1'
              , 'p':'button.draw.polygon1'
              , 'a':'button.draw.arc1'
              , 'Delete':'button.remove'
            }

        console.log('~>',e.key);
        if(e.key in list){
            $(list[e.key]).trigger('click');
            stop();
        }else{
            var res=blueprint.keydown(e);
            if(res){
                stop();
            }else{
                console.log(e.key);
            }
        }
    });

    $('.map').click(function(){
        if(!show_map){
            $(this).addClass('picked');
            if(!set_view){
                if(!pane_map){
                    navigator.geolocation.getCurrentPosition(function(position){
                        marker.setLatLng([
                            position.coords.latitude
                          , position.coords.longitude
                        ]);
                        map.setView([
                            position.coords.latitude
                          , position.coords.longitude
                        ],zoom);

                        map.on('dblclick',function(e){
                            marker.setLatLng(e.latlng);
                        });
                    });
                }else{
                    marker.setLatLng([pane_marker[0],pane_marker[1]]);
                    map.setView([pane_map[0],pane_map[1]],zoom);

                    map.on('dblclick',function(e){
                        marker.setLatLng(e.latlng);
                    });
                }

                set_view=true;
            }
            $('#map').show();
            show_map=true;
        }else{
            $(this).removeClass('picked');
            $('#map').hide();
            show_map=false;

            $('.controls').removeClass('picked');
            $('#map').css('z-index','-1');
            show_controls=false;
        }
    });

    $('.controls').click(function(){
        if(show_map){
            if(!show_controls){
                $(this).addClass('picked');
                $('#map').css('z-index','1');
                show_controls=true;
            }else{
                $(this).removeClass('picked');
                $('#map').css('z-index','-1');
                show_controls=false;
            }
        }
    });

    $('.zoomin').click(function(){
        map.setZoom(map.getZoom()+1)
    });

    $('.zoomout').click(function(){
        map.setZoom(map.getZoom()-1)
    });

    $('.north').click(function(){
        var pane=map.getCenter();
        pane.lat+=zoomLat[map.getZoom()-16];
        map.setView([pane.lat,pane.lng]);
    });
    $('.south').click(function(){
        var pane=map.getCenter();
        pane.lat-=zoomLat[map.getZoom()-16];
        map.setView([pane.lat,pane.lng]);
    });
    $('.west').click(function(){
        var pane=map.getCenter();
        pane.lng+=zoomLng[map.getZoom()-16];
        map.setView([pane.lat,pane.lng]);
    });
    $('.east').click(function(){
        var pane=map.getCenter();
        pane.lng-=zoomLng[map.getZoom()-16];
        map.setView([pane.lat,pane.lng]);
    });
});

