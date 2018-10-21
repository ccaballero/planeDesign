'use strict';

blueprint.obj.input={
    group:true
  , custom:true
};

blueprint.obj.input.translate=function(t){};
blueprint.obj.input.rotate=function(t,r){};

blueprint.obj.input.draw=function(x1,y1,x2,y2){
    blueprint.group[0]
        .attr('d',['M',x1,y1,'L',x2,y2].join(' '))
        .attr('marker-start','url(#head)');
    blueprint.group[1]
        .attr('cx',x1)
        .attr('cy',y1)
        .attr('r',8);
    blueprint.group[2]
        .attr('d',['M',x1-6,y1-3,'L',x1-6,y1+3
            ,'L',x1+6,y1+3,'L',x1+6,y1-3,'Z'].join(' ')
        );
    blueprint.group[3]
        .attr('d',['M',x2-25,y2-20,'L',x2-25,y2+40
            ,'L',x2+110,y2+40,'L',x2+110,y2-20,'Z'].join(' ')
        );
    blueprint.group[4]
        .attr('x',x2-16)
        .attr('y',y2);
    blueprint.group[5]
        .attr('x',x2-8)
        .attr('y',y2+15);
    blueprint.group[6]
        .attr('x',x2-8)
        .attr('y',y2+30);
}

blueprint.obj.input.start=function(x,y,c){
    blueprint.stack=[x,y];
    blueprint.selected=blueprint.layers[1]
        .append('svg:g')
        .attr('class',c.join(' '))
        .on('mousedown',blueprint.mousedown)
        .on('mousemove',blueprint.mousemove);
    blueprint.group=[
        blueprint.selected
            .append('svg:path')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
      , blueprint.selected
            .append('svg:circle')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
      , blueprint.selected
            .append('svg:path')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
      , blueprint.selected
            .append('svg:path')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
      , blueprint.selected
            .append('svg:text')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
            .text('Entrada de Aire')
      , blueprint.selected
            .append('svg:text')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
            .text('h = 0.30 m')
      , blueprint.selected
            .append('svg:text')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
            .text('s = 100 cm²')
    ];
};

blueprint.obj.input.prev=function(x,y){
    blueprint.obj.input.draw(blueprint.stack[0],blueprint.stack[1],x,y);
};

blueprint.obj.input.next=blueprint.abs.simple.next;
blueprint.obj.input.end=blueprint.abs.simple.next;
blueprint.obj.input.cancel=blueprint.abs.simple.cancel;

blueprint.obj.input.add=function(c,d){
    blueprint.obj.input.start(+d[1],+d[2],c);
    blueprint.obj.input.draw(+d[1],+d[2],+d[4],+d[5]);
    blueprint.obj.input.next();
};

blueprint.obj.input.select=blueprint.abs.install.select;

