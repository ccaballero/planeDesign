'use strict';

blueprint.obj.output={
    group:true
  , custom:true
};

blueprint.obj.output.translate=function(t){};
blueprint.obj.output.rotate=function(t,r){};

blueprint.obj.output.draw=function(x1,y1,x2,y2){
    blueprint.group[0]
        .attr('d',['M',x1,y1,'L',x2,y2].join(' '))
        .attr('marker-start','url(#tail)');
    blueprint.group[1]
        .attr('cx',x1)
        .attr('cy',y1)
        .attr('r',8);
    blueprint.group[2]
        .attr('d',['M',x1-6,y1-3,'L',x1-6,y1+3
            ,'L',x1+6,y1+3,'L',x1+6,y1-3,'Z'].join(' ')
        );
    blueprint.group[3]
        .attr('d',['M',x2-25,y2-20,'L',x2-25,y2+61
            ,'L',x2+110,y2+61,'L',x2+110,y2-20,'Z'].join(' ')
        );
    blueprint.group[4]
        .attr('x',x2-16)
        .attr('y',y2);
    blueprint.group[5]
        .attr('x',x2-16)
        .attr('y',y2+18);
    blueprint.group[6]
        .attr('x',x2-8)
        .attr('y',y2+36);
    blueprint.group[7]
        .attr('x',x2-8)
        .attr('y',y2+51);
}

blueprint.obj.output.start=function(x,y,c){
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
            .text('Salida de Gases')
      , blueprint.selected
            .append('svg:text')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
            .text('de Combustión')
      , blueprint.selected
            .append('svg:text')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
            .text('h = 1.80 m')
      , blueprint.selected
            .append('svg:text')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
            .text('s = 100 cm²')
    ];
};

blueprint.obj.output.prev=function(x,y){
    blueprint.obj.output.draw(blueprint.stack[0],blueprint.stack[1],x,y);
};

blueprint.obj.output.next=blueprint.abs.simple.next;
blueprint.obj.output.end=blueprint.abs.simple.next;
blueprint.obj.output.cancel=blueprint.abs.simple.cancel;

blueprint.obj.output.add=function(c,d){
    blueprint.obj.output.start(+d[1],+d[2],c);
    blueprint.obj.output.draw(+d[1],+d[2],+d[4],+d[5]);
    blueprint.obj.input.next();
};

blueprint.obj.output.select=blueprint.abs.install.select;

