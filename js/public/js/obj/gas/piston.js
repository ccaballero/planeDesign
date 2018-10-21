'use strict';

blueprint.obj.piston1={
    group:true
  , custom:true
};

blueprint.obj.piston1.translate=function(t){};
blueprint.obj.piston1.rotate=function(t,r){};

blueprint.obj.piston1.draw=function(x1,y1,x2,y2){
    blueprint.group[0].attr('d',['M',x1,y1,'L',x2,y2].join(' '));
    blueprint.group[1]
        .attr('d',['M',x1-8,y1-4,'L',x1-8,y1+4
            ,'L',x1+8,y1+4,'L',x1+8,y1-4,'Z'].join(' ')
        );
    blueprint.group[2]
        .attr('d',['M',x1-8,y1-4,'L',x1-8,y1+4
            ,'L',x1+8,y1-4,'L',x1+8,y1+4,'Z'].join(' ')
        );
    blueprint.group[3]
        .attr('d',['M',x2-25,y2-20,'L',x2-25,y2+22
            ,'L',x2+70,y2+22,'L',x2+70,y2-20,'Z'].join(' ')
        );
    blueprint.group[4]
        .attr('x',x2-16)
        .attr('y',y2);
    blueprint.group[5]
        .attr('x',x2-8)
        .attr('y',y2+15);
};

blueprint.obj.piston1.start=function(x,y,c){
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
            .append('svg:path')
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
            .text('COC-HOR')
      , blueprint.selected
            .append('svg:text')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
            .text('P = 10 KW')
    ];
};

blueprint.obj.piston1.prev=function(x,y){
    blueprint.obj.piston1.draw(blueprint.stack[0],blueprint.stack[1],x,y);
};

blueprint.obj.piston1.next=blueprint.abs.simple.next;
blueprint.obj.piston1.end=blueprint.abs.simple.next;
blueprint.obj.piston1.cancel=blueprint.abs.simple.cancel;

blueprint.obj.piston1.add=function(c,d){
    blueprint.obj.piston1.start(+d[1],+d[2],c);
    blueprint.obj.piston1.draw(+d[1],+d[2],+d[4],+d[5]);
    blueprint.obj.piston1.next();
};

blueprint.obj.piston1.select=blueprint.abs.install.select;

blueprint.obj.piston2={
    group:true
  , custom:true
};

blueprint.obj.piston2.translate=function(t){};
blueprint.obj.piston2.rotate=function(t,r){};

blueprint.obj.piston2.draw=function(x1,y1,x2,y2){
    blueprint.group[0].attr('d',['M',x1,y1,'L',x2,y2].join(' '));
    blueprint.group[1]
        .attr('d',['M',x1-4,y1-8,'L',x1-4,y1+8
            ,'L',x1+4,y1+8,'L',x1+4,y1-8,'Z'].join(' ')
        );
    blueprint.group[2]
        .attr('d',['M',x1-4,y1-8,'L',x1+4,y1+8
            ,'L',x1-4,y1+8,'L',x1+4,y1-8,'Z'].join(' ')
        );
    blueprint.group[3]
        .attr('d',['M',x2-25,y2-20,'L',x2-25,y2+22
            ,'L',x2+70,y2+22,'L',x2+70,y2-20,'Z'].join(' ')
        );
    blueprint.group[4]
        .attr('x',x2-16)
        .attr('y',y2);
    blueprint.group[5]
        .attr('x',x2-8)
        .attr('y',y2+15);
};

blueprint.obj.piston2.start=function(x,y,c){
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
            .append('svg:path')
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
            .text('COC-HOR')
      , blueprint.selected
            .append('svg:text')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
            .text('P = 10 KW')
    ];
};

blueprint.obj.piston2.prev=function(x,y){
    blueprint.obj.piston2.draw(blueprint.stack[0],blueprint.stack[1],x,y);
};

blueprint.obj.piston2.next=blueprint.abs.simple.next;
blueprint.obj.piston2.end=blueprint.abs.simple.next;
blueprint.obj.piston2.cancel=blueprint.abs.simple.cancel;

blueprint.obj.piston2.add=function(c,d){
    blueprint.obj.piston2.start(+d[1],+d[2],c);
    blueprint.obj.piston2.draw(+d[1],+d[2],+d[4],+d[5]);
    blueprint.obj.piston2.next();
};

blueprint.obj.piston2.select=blueprint.abs.install.select;

