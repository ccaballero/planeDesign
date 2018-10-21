'use strict';

blueprint.drag.translate=d3.drag()
    .on('start',function(){
        blueprint.origin=d3.mouse(this);
        d3.event.sourceEvent.stopPropagation();
    })
    .on('drag',function(){
        var t=[d3.event.x-blueprint.origin[0],
            d3.event.y-blueprint.origin[1]]
          , transform='translate('+t[0]+','+t[1]+')'

        blueprint.selected.attr('transform',transform);
        d3.selectAll('.handle').attr('transform',transform);
    })
    .on('end',function(){
        var match=/translate\((.+),(.+)\)/.exec(
                blueprint.selected.attr('transform'))
          , t=[+match[1],+match[2]]

        if(blueprint.def.group){
            blueprint.selected.selectAll('path').each(function(e,i){
                var s=d3.select(this)
                  , d=s.attr('d').split(' ')

                s.attr('d',blueprint.translate(d,t).join(' '));
            });
            if(blueprint.def.custom){
                blueprint.def.translate(t);
            }

            blueprint.selected.attr('transform',undefined);
        }else{
            switch(blueprint.selected._groups[0][0].tagName){
                case 'text':
                    var x=blueprint.selected.attr('x')
                      , y=blueprint.selected.attr('y')

                    blueprint.selected
                        .attr('x',+x+t[0])
                        .attr('y',+y+t[1])
                        .attr('transform',undefined);
                    break;
                case 'path':
                    var d=blueprint.selected.attr('d').split(' ')

                    blueprint.selected
                        .attr('d',blueprint.translate(d,t).join(' '))
                        .attr('transform',undefined);
                    break;
            }
        }

        blueprint.def.select(blueprint.selected);
        blueprint.origin=undefined;
    });

blueprint.drag.rotate=d3.drag()
    .on('start',function(){
        blueprint.origin=d3.mouse(this);
        d3.event.sourceEvent.stopPropagation();
    })
    .on('drag',function(){
        var centre=d3.select('#centre')
          , o=[+centre.attr('cx'),+centre.attr('cy')]
          , a=[d3.event.x-o[0],d3.event.y-o[1]]
          , b=[blueprint.origin[0]-o[0],blueprint.origin[1]-o[1]]
          , ma=Math.sqrt(Math.pow(a[0],2)+Math.pow(a[1],2))
          , mb=Math.sqrt(Math.pow(b[0],2)+Math.pow(b[1],2))
          , t=(Math.acos((a[0]*b[0]+a[1]*b[1])/(ma*mb))*180)/Math.PI
          , m=b[1]/b[0]
          , s=(d3.event.y-m*d3.event.x+m*o[0]-o[1]>0)?-1:1
          , transform='rotate('+(t*s)+','+o[0]+','+o[1]+')'

        blueprint.selected.attr('transform',transform);
        d3.selectAll('.handle').attr('transform',transform);
    })
    .on('end',function(){
        var match=/rotate\((.+),(.+),(.+)\)/.exec(
                blueprint.selected.attr('transform'))
          , t=[(+match[1]*Math.PI)/180,+match[2],+match[3]]
          , r=[Math.cos(t[0]),Math.sin(t[0])]

        if(blueprint.def.group){
            blueprint.selected.selectAll('path').each(function(e,i){
                var s=d3.select(this)
                  , d=s.attr('d').split(' ')

                s.attr('d',blueprint.rotate(d,t,r).join(' '));
            });
            if(blueprint.def.custom){
                blueprint.def.rotate(t,r);
            }

            blueprint.selected.attr('transform',undefined);
        }else{
            switch(blueprint.selected._groups[0][0].tagName){
                case 'text':
                    var x=blueprint.selected.attr('x')
                      , y=blueprint.selected.attr('y')

                    blueprint.selected
                        .attr('x',t[1]+(x-t[1])*r[0]-(y-t[2])*r[1])
                        .attr('y',t[2]+(x-t[1])*r[1]+(y-t[2])*r[0])
                        .attr('transform',undefined);
                    break;
                case 'path':
                    var d=blueprint.selected.attr('d').split(' ')

                    blueprint.selected
                        .attr('d',blueprint.rotate(d,t,r).join(' '))
                        .attr('transform',undefined);
                    break;
            }
        }

        blueprint.def.select(blueprint.selected);
        blueprint.origin=undefined;
    });

blueprint.drag.centre=d3.drag()
    .on('start',function(){
        blueprint.origin=d3.mouse(this);
        d3.event.sourceEvent.stopPropagation();
    })
    .on('drag',function(){
        d3.select('#axis')
            .attr('x1',d3.event.x)
            .attr('y1',d3.event.y);
        d3.select(this)
            .attr('cx',d3.event.x)
            .attr('cy',d3.event.y);
    });

blueprint.drag.handle=d3.drag()
    .on('start',function(){
        blueprint.origin=d3.mouse(this);
        d3.event.sourceEvent.stopPropagation();
        d3.selectAll('#axis,#translate,#rotate,#centre')
            .remove();
    })
    .on('drag',function(){
        if(blueprint.def.group){
            var d=blueprint.selected.select('path').attr('d').split(' ')

            switch(this.id){
                case 'handle1':
                    blueprint.def.draw(d3.event.x,d3.event.y,+d[4],+d[5]);
                    break;
                case 'handle2':
                    blueprint.def.draw(+d[1],+d[2],d3.event.x,d3.event.y);
                    break;
            }
        }else{
            var d=blueprint.selected.attr('d').split(' ')
              , i=((+this.id.substring(6)-1)*3)+1

            d[i]=d3.event.x;
            d[i+1]=d3.event.y;

            blueprint.selected.attr('d',d.join(' '));
        }

        d3.select(this)
            .attr('cx',d3.event.x)
            .attr('cy',d3.event.y);
    })
    .on('end',function(){
        blueprint.def.select(blueprint.selected);
        blueprint.origin=undefined;
    });

blueprint.drag.rect=d3.drag()
    .on('start',function(){
        blueprint.origin=d3.mouse(this);
        d3.event.sourceEvent.stopPropagation();
        d3.selectAll('#axis,#translate,#rotate,#centre')
            .remove();
    })
    .on('drag',function(){
        if(blueprint.def.group){
            var target=blueprint.selected.select('path')
        }else{
            var target=blueprint.selected
        }

        var stack=target.attr('d').split(' ')
          , i=+this.id.substring(6)-1
          , j=function(a,b,c,d,C){
                var vp=[C[0]-a[0],C[1]-a[1]]
                  , vq=[b[0]-a[0],b[1]-a[1]]
                  , vr=[d[0]-a[0],d[1]-a[1]]
                  , mq=Math.sqrt(vq[0]*vq[0]+vq[1]*vq[1])
                  , mr=Math.sqrt(vr[0]*vr[0]+vr[1]*vr[1])
                  , Q=(vp[0]*vq[0]+vp[1]*vq[1])/(mq*mq)
                  , R=(vp[0]*vr[0]+vp[1]*vr[1])/(mr*mr)

                return [
                    a[0]+Q*vq[0]
                  , a[1]+Q*vq[1]
                  , a[0]+R*vr[0]
                  , a[1]+R*vr[1]
                ];
            }

        switch(i){
            case 0:
                var d=j([+stack[ 7],+stack[ 8]]
                      , [+stack[10],+stack[11]]
                      , [+stack[ 1],+stack[ 2]]
                      , [+stack[ 4],+stack[ 5]]
                      , [d3.event.x,d3.event.y])

                target.attr('d',[
                    'M',d3.event.x,d3.event.y
                  , 'L',d[2],d[3]
                  , 'L',+stack[7],+stack[8]
                  , 'L',d[0],d[1],'Z'].join(' '));

                if(blueprint.def.custom){
                    blueprint.def.draw(
                        d3.event.x,d3.event.y,+stack[7],+stack[8]);
                }
                break;
            case 1:
                var d=j([+stack[10],+stack[11]]
                      , [+stack[ 1],+stack[ 2]]
                      , [+stack[ 4],+stack[ 5]]
                      , [+stack[ 7],+stack[ 8]]
                      , [d3.event.x,d3.event.y])

                target.attr('d',[
                    'M',d[0],d[1]
                  , 'L',d3.event.x,d3.event.y
                  , 'L',d[2],d[3]
                  , 'L',+stack[10],+stack[11],'Z'].join(' '));

                if(blueprint.def.custom){
                    blueprint.def.draw(d[0],d[1],d[2],d[3]);
                }
                break;
            case 2:
                var d=j([+stack[ 1],+stack[ 2]]
                      , [+stack[ 4],+stack[ 5]]
                      , [+stack[ 7],+stack[ 8]]
                      , [+stack[10],+stack[11]]
                      , [d3.event.x,d3.event.y])

                target.attr('d',[
                    'M',+stack[1],+stack[2]
                  , 'L',d[0],d[1]
                  , 'L',d3.event.x,d3.event.y
                  , 'L',d[2],d[3],'Z'].join(' '));

                if(blueprint.def.custom){
                    blueprint.def.draw(
                        +stack[1],+stack[2],d3.event.x,d3.event.y);
                }
                break;
            case 3:
                var d=j([+stack[ 4],+stack[ 5]]
                      , [+stack[ 7],+stack[ 8]]
                      , [+stack[10],+stack[11]]
                      , [+stack[ 1],+stack[ 2]]
                      , [d3.event.x,d3.event.y])

                target.attr('d',[
                    'M',d[2],d[3]
                  , 'L',+stack[4],+stack[5]
                  , 'L',d[0],d[1]
                  , 'L',d3.event.x,d3.event.y,'Z'].join(' '));
                
                if(blueprint.def.custom){
                    blueprint.def.draw(d[2],d[3],d[0],d[1]);
                }
                break;
        }

        d3.select(this)
            .attr('cx',d3.event.x)
            .attr('cy',d3.event.y);
    })
    .on('end',function(){
        blueprint.def.select(blueprint.selected);
        blueprint.origin=undefined;
    });

blueprint.drag.arc=d3.drag()
    .on('start',function(){
        blueprint.origin=d3.mouse(this);
        d3.event.sourceEvent.stopPropagation();
        d3.selectAll('#axis,#translate,#rotate,#centre')
            .remove();
    })
    .on('drag',function(){
        if(blueprint.def.group){
            var target=blueprint.selected.select('path')
        }else{
            var target=blueprint.selected
        }

        var stack=target.attr('d').split(' ')
          , i=+this.id.substring(6)-1
          , j=function(a,b,c,d,C){
                var vp=[C[0]-a[0],C[1]-a[1]]
                  , vq=[b[0]-a[0],b[1]-a[1]]
                  , vr=[d[0]-a[0],d[1]-a[1]]
                  , mq=Math.sqrt(vq[0]*vq[0]+vq[1]*vq[1])
                  , mr=Math.sqrt(vr[0]*vr[0]+vr[1]*vr[1])
                  , Q=(vp[0]*vq[0]+vp[1]*vq[1])/(mq*mq)
                  , R=(vp[0]*vr[0]+vp[1]*vr[1])/(mr*mr)

                return [
                    a[0]+Q*vq[0]
                  , a[1]+Q*vq[1]
                  , a[0]+R*vr[0]
                  , a[1]+R*vr[1]
                ];
            }

        switch(i){
            case 0:
                var d=j([+stack[ 7],+stack[ 8]]
                      , [+stack[10],+stack[11]]
                      , [+stack[ 1],+stack[ 2]]
                      , [+stack[ 4],+stack[ 5]]
                      , [d3.event.x,d3.event.y])
                  , trans=blueprint.obj.arc.render(
                        d3.event.x,d3.event.y
                      , d[2],d[3]
                      , +stack[7],+stack[8]
                    ).concat('Z')

                target.attr('d',trans.join(' '));
                break;
            case 1:
                var d=j([+stack[1]+(+stack[7]- +stack[4])
                      , +stack[2]+(+stack[8]- +stack[5])]
                      , [+stack[ 1],+stack[ 2]]
                      , [+stack[ 4],+stack[ 5]]
                      , [+stack[ 7],+stack[ 8]]
                      , [d3.event.x,d3.event.y])
                  , trans=blueprint.obj.arc.render(
                        d[0],d[1]
                      , d3.event.x,d3.event.y
                      , d[2],d[3]
                    ).concat('Z')

                target.attr('d',trans.join(' '));
                break;
            case 2:
                var d=j([+stack[ 1],+stack[ 2]]
                      , [+stack[ 4],+stack[ 5]]
                      , [+stack[ 7],+stack[ 8]]
                      , [+stack[10],+stack[11]]
                      , [d3.event.x,d3.event.y])
                  , trans=blueprint.obj.arc.render(
                        +stack[1],+stack[2]
                      , d[0],d[1]
                      , d3.event.x,d3.event.y
                    ).concat('Z')

                target.attr('d',trans.join(' '));
                break;
            case 3:
                break;
        }

        d3.select(this)
            .attr('cx',d3.event.x)
            .attr('cy',d3.event.y);
    })
    .on('end',function(){
        blueprint.def.select(blueprint.selected);
        blueprint.origin=undefined;
    });

blueprint.drag.install=d3.drag()
    .on('start',function(){
        blueprint.origin=d3.mouse(this);
        d3.event.sourceEvent.stopPropagation();
        d3.selectAll('#axis,#translate,#rotate,#centre')
            .remove();
    })
    .on('drag',function(){
        var target=blueprint.selected.select('path')
          , stack=target.attr('d').split(' ')
          , i=+this.id.substring(6)-1

        switch(i){
            case 0:
                blueprint.def.draw(d3.event.x,d3.event.y,+stack[4],+stack[5]);
                break;
            case 1:
                blueprint.def.draw(+stack[1],+stack[2],d3.event.x,d3.event.y);
                break;
        }

        d3.select(this)
            .attr('cx',d3.event.x)
            .attr('cy',d3.event.y);
    })
    .on('end',function(){
        blueprint.def.select(blueprint.selected);
        blueprint.origin=undefined;
    });

