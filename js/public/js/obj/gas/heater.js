'use strict';

blueprint.obj.heater={
    group:true
  , custom:true
};

blueprint.obj.heater.translate=function(t){};
blueprint.obj.heater.rotate=function(t,r){};

blueprint.obj.heater.draw=function(x1,y1,x2,y2){
    blueprint.group[0].attr('d',['M',x1,y1,'L',x2,y2].join(' '));
    blueprint.group[1]
        .attr('cx',x1)
        .attr('cy',y1)
        .attr('r',8);
    blueprint.group[2]
        .attr('d',['M',x1-5,y1+1
            ,'L',x1-1,y1+1
            ,'L',x1-1,y1+1
            ,'L',x1-1,y1+5
            ,'L',x1+1,y1+5
            ,'L',x1+1,y1+1
            ,'L',x1+5,y1+1
            ,'L',x1+5,y1-1
            ,'L',x1+1,y1-1
            ,'L',x1+1,y1-5
            ,'L',x1-1,y1-5
            ,'L',x1-1,y1-1
            ,'L',x1-3,y1-1
            ,'Z'].join(' ')
        );
    blueprint.group[3]
        .attr('d',['M',x2-25,y2-20,'L',x2-25,y2+40
            ,'L',x2+50,y2+40,'L',x2+50,y2-20,'Z'].join(' ')
        );
    blueprint.group[4]
        .attr('x',x2-16)
        .attr('y',y2);
    blueprint.group[5]
        .attr('x',x2-16)
        .attr('y',y2+15);
    blueprint.group[6]
        .attr('x',x2-8)
        .attr('y',y2+30);
};

blueprint.obj.heater.start=function(x,y,c){
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
            .text('PREVISTO')
      , blueprint.selected
            .append('svg:text')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
            .text('CALEFON')
      , blueprint.selected
            .append('svg:text')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
            .text('15 [kW]')
    ];
};

blueprint.obj.heater.prev=function(x,y){
    blueprint.obj.heater.draw(blueprint.stack[0],blueprint.stack[1],x,y);
};

blueprint.obj.heater.next=blueprint.abs.simple.next;
blueprint.obj.heater.end=blueprint.abs.simple.next;
blueprint.obj.heater.cancel=blueprint.abs.simple.cancel;

blueprint.obj.heater.add=function(c,d){
    blueprint.obj.heater.start(+d[1],+d[2],c);
    blueprint.obj.heater.draw(+d[1],+d[2],+d[4],+d[5]);
    blueprint.obj.heater.next();
};

blueprint.obj.heater.select=blueprint.abs.install.select;

