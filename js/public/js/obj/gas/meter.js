'use strict';

blueprint.obj.meter={
    group:true
  , custom:true
};

blueprint.obj.meter.translate=function(t){
    var i=blueprint.selected.select('text')
      , offset=i.node().getBBox()
      , d=blueprint.selected.select('path').attr('d').split(' ')
      , match=/rotate\((.+),(.+),(.+)\)/.exec(i.attr('transform'))
      , X=(+d[1]+ +d[4]+ +d[7]+ +d[10])/4
      , x=X- (+offset.width/2)+2
      , Y=(+d[2]+ +d[5]+ +d[8]+ +d[11])/4
      , y=Y+ (+offset.height/2)-4

    i.attr('x',x)
     .attr('y',y)
     .attr('transform','rotate('+match[1]+','+X+','+Y+')');
};

blueprint.obj.meter.rotate=function(t,r){
    var i=blueprint.selected.select('text')
      , offset=i.node().getBBox()
      , d=blueprint.selected.select('path').attr('d').split(' ')
      , match=/rotate\((.+),(.+),(.+)\)/.exec(i.attr('transform'))
      , X=(+d[1]+ +d[4]+ +d[7]+ +d[10])/4
      , x=X- (+offset.width/2)+2
      , Y=(+d[2]+ +d[5]+ +d[8]+ +d[11])/4
      , y=Y+ (+offset.height/2)-4
      , r=(t[0]*180)/Math.PI

    i.attr('x',x)
     .attr('y',y)
     .attr('transform','rotate('+(+match[1]+r)+','+X+','+Y+')');
};

blueprint.obj.meter.draw=function(x1,y1,x2,y2){
    var x=x1<x2?x1:x2
      , y=y1<y2?y1:y2
      , X=x1<x2?x2:x1
      , Y=y1<y2?y2:y1
      , path=blueprint.selected.select('path')
      , text=blueprint.selected.select('text')
      , offset=text.node().getBBox()
      , cx=x+((X-x)/2)
      , cy=y+((Y-y)/2)

    path.attr('d',['M',x,y,'L',x,Y,'L',X,Y,'L',X,y,'Z'].join(' '));
    text.attr('x',cx- (+offset.width/2)+2)
        .attr('y',cy+ (+offset.height/2)-4)
        .attr('transform','rotate(0,'+cx+','+cy+')');
};

blueprint.obj.meter.start=function(x,y,c){
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
            .append('svg:text')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
            .text('M')
    ];
};

blueprint.obj.meter.prev=function(x,y){
    blueprint.obj.meter.draw(blueprint.stack[0],blueprint.stack[1],x,y);
};

blueprint.obj.meter.next=blueprint.abs.simple.next;
blueprint.obj.meter.end=blueprint.abs.simple.next;
blueprint.obj.meter.cancel=blueprint.abs.simple.cancel;

blueprint.obj.meter.add=function(c,d){
    blueprint.obj.meter.start(+d[1],+d[2],c);
    blueprint.obj.meter.draw(+d[1],+d[2],+d[7],+d[8]);
    blueprint.obj.meter.next();
};

blueprint.obj.meter.select=blueprint.abs.graph2.select;

