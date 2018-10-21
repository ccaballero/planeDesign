'use strict';

blueprint.abs.install={};

blueprint.abs.install.select=function(target){
    blueprint.group=[];

    target.selectAll('path,circle,text').each(function(d,i){
        blueprint.group.push(d3.select(this));
    });

    var pivot=blueprint.group[0]
      , stack=pivot.attr('d').split(' ').filter(function(e,i){
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

    blueprint.layers[1].append('svg:circle')
        .attr('id','handle1')
        .attr('cx',stack[0])
        .attr('cy',stack[1])
        .attr('r',4)
        .attr('class','handle vertex')
        .call(blueprint.drag.install);
    blueprint.layers[1].append('svg:circle')
        .attr('id','handle2')
        .attr('cx',stack[2])
        .attr('cy',stack[3])
        .attr('r',4)
        .attr('class','handle vertex')
        .call(blueprint.drag.install);
};

