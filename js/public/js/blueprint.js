'use strict';

var blueprint=new(function(){
    this.version='0.0.1';

    this.mode='selector';   // selector - draw
    this.component=undefined;

    this.base=undefined;
    this.layers=[];

    this.count=0;
    this.abs={};
    this.obj={};
    this.drag={};

    this.zoom=1;

    this.selected=undefined;
    this.def=undefined;
    this.stack=undefined;
    this.group=undefined;
    this.origin=undefined;

    this.init=function(container){
        this.base=d3.select(container)
            .append('svg:svg')
            .attr('width','100%')
            .attr('height','100%')
            .attr('preserveAspectRatio','xMidYMid meet')
            .attr('pointer-events','all')
            .attr('transform','matrix(1 0 0 1 0 0)');

        var defs=this.base.append('svg:defs')

        defs.append('svg:marker')
            .attr('id','head')
            .attr('orient','auto')
            .attr('markerWidth','13')
            .attr('markerHeight','13')
            .attr('refX','-10')
            .attr('refY','6')
            .append('svg:path')
            .attr('d','M 2 6 L 8 10 L 8 2 Z')
            .attr('fill','#909090');

        defs.append('svg:marker')
            .attr('id','tail')
            .attr('orient','auto')
            .attr('markerWidth','13')
            .attr('markerHeight','13')
            .attr('refX','-10')
            .attr('refY','6')
            .append('svg:path')
            .attr('d','M 2 2 L 2 10 L 9 6 Z')
            .attr('fill','#909090');

        this.layers.push(this.base.append('svg:rect')
            .attr('x',0)
            .attr('y',0)
            .attr('width','100%')
            .attr('height','100%')
            .attr('class','base')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
            .on('click',blueprint.click)
            .on('dblclick',blueprint.dblclick)
        );

        this.layers.push(this.base.append('svg:g')
            .attr('id','main')
        );
    };

    this.setmode=function(mode,component){
        blueprint.mode=mode;
        blueprint.component=component;
        blueprint.deselect();
    };

    this.getid=function(){
        return 'obj'+(++this.count);
    };

    this.remove=function(){
        if(blueprint.selected){
            var target=blueprint.selected

            blueprint.deselect();
            target.remove();
        }
    };

    this.mousedown=function(){
        if(blueprint.mode=='selector'){
            return;
        }

        if(blueprint.component in blueprint.obj){
            if(!blueprint.selected){
                blueprint.obj[blueprint.component].start(
                    d3.mouse(this)[0],d3.mouse(this)[1],[blueprint.component]);
            }else{
                blueprint.obj[blueprint.component].next(
                    d3.mouse(this)[0],d3.mouse(this)[1]);
            }
        }

        d3.event.stopPropagation();
    };

    this.mousemove=function(){
        if(blueprint.mode=='selector'||blueprint.selected==undefined){
            return;
        }

        if(blueprint.component in blueprint.obj){
            blueprint.obj[blueprint.component].prev(
                d3.mouse(this)[0],d3.mouse(this)[1]);
        }

        d3.event.stopPropagation();
    };

    this.click=function(){
        if(blueprint.mode=='draw'){
            return;
        }

        var target=d3.select(this)
          , prop=target.attr('class').split(' ')

        if(prop=='base'){
            blueprint.deselect();
        }else{
            if(prop&&(prop.length>0)&&(prop[0] in blueprint.obj)){
                blueprint.obj[prop[0]].select(target);
            }
        }
    };

    this.deselect=function(){
        if(blueprint.selected){
            var target=d3.select(blueprint.selected)

            target.on('.drag',undefined);
            blueprint.layers[1].selectAll('.handle').remove();

            blueprint.selected=undefined;
            blueprint.def=undefined;
        }
    };

    this.keydown=function(e){
        console.log('=>',e.key);

        switch(e.key){
            case 'Escape':
                if(blueprint.mode=='draw'&&blueprint.selected&&
                    blueprint.component in blueprint.obj){
                    blueprint.obj[blueprint.component].cancel();
                    return true;
                }
                break;
            case 'Enter':
                if(blueprint.mode=='draw'&&blueprint.selected&&
                    blueprint.component in blueprint.obj){
                    blueprint.obj[blueprint.component].end();
                    return true;
                }
                break;
            case 'ArrowRight':
                blueprint.nav.right(30);
                return true;
            case 'ArrowUp':
                blueprint.nav.up(30);
                return true;
            case 'ArrowLeft':
                blueprint.nav.left(30);
                return true;
            case 'ArrowDown':
                blueprint.nav.down(30);
                return true;
            case '-':
                blueprint.nav.zoomout();
                return true;
            case '+':
                blueprint.nav.zoomin();
                return true;
        }

        return false;
    };

    this.nav={
        generic:function(d,f){
            var svg=d3.select('svg')
              , attr=svg.attr('transform')
              , regex=/matrix\((.+) (.+) (.+) (.+) (.+) (.+)\)/
              , match=regex.exec(attr)
              , e=[match[1],match[2],match[3],match[4],match[5],match[6]]

            d3.select('svg').attr('transform','matrix('+f(e,d).join(' ')+')');
        }
      , exp:function(x){
            return Math.pow(Math.E,(x-1)/6);
        }
      , left:function(d){
            blueprint.nav.generic(d,function(e,d){
                e[4]=+e[4]+d;
                d3.selectAll('.base').attr('x',-1*e[4]);
                return e;
            });
        }
      , right:function(d){
            blueprint.nav.generic(d,function(e,d){
                e[4]=+e[4]-d;
                d3.selectAll('.base').attr('x',-1*e[4]);
                return e;
            });
        }
      , up:function(d){
            blueprint.nav.generic(d,function(e,d){
                e[5]=+e[5]+d;
                d3.selectAll('.base').attr('y',-1*e[5]);
                return e;
            });
        }
      , down:function(d){
            blueprint.nav.generic(d,function(e,d){
                e[5]=+e[5]-d;
                d3.selectAll('.base').attr('y',-1*e[5]);
                return e;
            });
        }
      , zoomout:function(d){
            blueprint.nav.generic(d,function(e,d){
                blueprint.zoom--;
                e[0]=blueprint.nav.exp(blueprint.zoom);
                e[3]=blueprint.nav.exp(blueprint.zoom);
                return e;
            });
        }
      , zoomin:function(d){
            blueprint.nav.generic(d,function(e,d){
                blueprint.zoom++;
                e[0]=blueprint.nav.exp(blueprint.zoom);
                e[3]=blueprint.nav.exp(blueprint.zoom);
                return e;
            });
        }
    }

    this.translate=function(d,t){
        for(var i=0;i<d.length;i++){
            if(d[i]=='M'||d[i]=='L'){
                d[i+1]=+d[i+1]+t[0];
                d[i+2]=+d[i+2]+t[1];
                i=i+2;
            }else if(d[i]=='A'){
                d[i+6]=+d[i+6]+t[0];
                d[i+7]=+d[i+7]+t[1];
                i=i+7;
            }
        }
        return d;
    };

    this.rotate=function(d,t,r){
        var b=[]

        for(var i=0;i<d.length;i++){
            if(d[i]=='M'||d[i]=='L'){
                b=[+d[i+1],+d[i+2]];
                d[i+1]=t[1]+(b[0]-t[1])*r[0]
                        -(b[1]-t[2])*r[1];
                d[i+2]=t[2]+(b[0]-t[1])*r[1]
                        +(b[1]-t[2])*r[0];
                i=i+2;
            }else if(d[i]=='A'){
                b=[+d[i+6],+d[i+7]];
                d[i+6]=t[1]+(b[0]-t[1])*r[0]
                        -(b[1]-t[2])*r[1];
                d[i+7]=t[2]+(b[0]-t[1])*r[1]
                        +(b[1]-t[2])*r[0];
                i=i+7;
            }
        }
        return d;
    };
})();

