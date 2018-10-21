'use strict';

blueprint.abs.simple={};

blueprint.abs.simple.start=function(x,y,c){
    blueprint.stack=[x,y];
    blueprint.selected=blueprint.layers[1]
        .append('svg:path')
        .attr('class',c.join(' '))
        .on('mousedown',blueprint.mousedown)
        .on('mousemove',blueprint.mousemove);
};

blueprint.abs.simple.next=function(){
    blueprint.selected
        .attr('id',blueprint.getid())
        .on('click',blueprint.click);

    blueprint.selected=undefined;
    blueprint.stack=undefined;
    blueprint.group=undefined;
};

blueprint.abs.simple.end=blueprint.abs.simple.next;

blueprint.abs.simple.cancel=function(){
    blueprint.selected.remove();

    blueprint.selected=undefined;
    blueprint.stack=undefined;
    blueprint.group=undefined;
};

blueprint.abs.simple.select=function(target){
    var stack=target.attr('d').split(' ').filter(function(e,i){
            return i%3!=0;
        }).map(function(e){
            return +e;
        })
      , a=Math.atan((stack[3]-stack[1])/(stack[2]-stack[0]))
      , d=30
      , p=[stack[0]+(stack[2]-stack[0])/2,stack[1]+(stack[3]-stack[1])/2]

    blueprint.deselect();

    blueprint.selected=target;
    blueprint.def=blueprint.obj[target.attr('class').split(' ')[0]];

    var j=1;
    for(var i=0;i<stack.length;i+=2){
        blueprint.layers[1].append('svg:circle')
            .attr('id','handle'+(j++))
            .attr('cx',stack[i])
            .attr('cy',stack[i+1])
            .attr('r',4)
            .attr('class','handle vertex')
            .call(blueprint.drag.handle);
    }
    blueprint.layers[1].append('svg:line')
        .attr('id','axis')
        .attr('x1',p[0])
        .attr('y1',p[1])
        .attr('x2',p[0]+3*d*Math.sin(-a))
        .attr('y2',p[1]+3*d*Math.cos(-a))
        .attr('class','handle axis');
    blueprint.layers[1].append('svg:circle')
        .attr('id','translate')
        .attr('cx',p[0]-d*Math.sin(-a))
        .attr('cy',p[1]-d*Math.cos(-a))
        .attr('r',4)
        .attr('class','handle translate')
        .call(blueprint.drag.translate);
    blueprint.layers[1].append('svg:circle')
        .attr('id','rotate')
        .attr('cx',p[0]+3*d*Math.sin(-a))
        .attr('cy',p[1]+3*d*Math.cos(-a))
        .attr('r',4)
        .attr('class','handle rotate')
        .call(blueprint.drag.rotate);
    blueprint.layers[1].append('svg:circle')
        .attr('id','centre')
        .attr('cx',p[0])
        .attr('cy',p[1])
        .attr('r',4)
        .attr('class','handle centre')
        .call(blueprint.drag.centre);
};

