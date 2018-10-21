'use strict';

blueprint.abs.multiple={};

blueprint.abs.multiple.start=function(x,y,c){
    blueprint.stack=['M',x,y];
    blueprint.selected=blueprint.layers[1]
        .append('svg:path')
        .attr('class',c.join(' '))
        .on('mousedown',blueprint.mousedown)
        .on('mousemove',blueprint.mousemove)
};

blueprint.abs.multiple.prev=function(x,y){
    blueprint.selected.attr('d',blueprint.stack.concat(['L',x,y]).join(' '));
};

blueprint.abs.multiple.next=function(x,y){
    blueprint.stack=blueprint.stack.concat(['L',x,y]);
    blueprint.selected.attr('d',blueprint.stack.join(' '));
};

blueprint.abs.multiple.cancel=blueprint.abs.simple.cancel;

blueprint.abs.multiple.end=function(){
    if(blueprint.stack.length<6){
        blueprint.abs.multiple.cancel();
    }else{
        blueprint.selected
            .attr('id',blueprint.getid())
            .on('click',blueprint.click);

        blueprint.selected=undefined;
        blueprint.stack=undefined;
        blueprint.group=undefined;
    }
};

blueprint.abs.multiple.add=function(c,d){
    blueprint.layers[1]
        .append('svg:path')
        .attr('d',d.join(' '))
        .attr('class',c.join(' '))
        .attr('id',blueprint.getid());
};

