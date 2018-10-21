'use strict';

blueprint.obj.line={
    group:false
};

blueprint.obj.line.draw=function(x1,y1,x2,y2){
    blueprint.selected.attr('d',['M',x1,y1,'L',x2,y2].join(' '));
};

blueprint.obj.line.start=blueprint.abs.simple.start;

blueprint.obj.line.prev=function(x,y){
    blueprint.obj.line.draw(blueprint.stack[0],blueprint.stack[1],x,y);
};

blueprint.obj.line.next=blueprint.abs.simple.next;
blueprint.obj.line.end=blueprint.abs.simple.end;
blueprint.obj.line.cancel=blueprint.abs.simple.cancel;

blueprint.obj.line.add=function(c,d){
    blueprint.abs.simple.start(+d[1],+d[2],c);
    blueprint.obj.line.draw(+d[1],+d[2],+d[4],+d[5]);
    blueprint.obj.line.end();
};

blueprint.obj.line.select=blueprint.abs.simple.select;

blueprint.obj.line1={
    group:false
};
blueprint.obj.line1.draw=blueprint.obj.line.draw;
blueprint.obj.line1.start=blueprint.obj.line.start;
blueprint.obj.line1.prev=blueprint.obj.line.prev;
blueprint.obj.line1.next=blueprint.obj.line.next;
blueprint.obj.line1.end=blueprint.obj.line.end;
blueprint.obj.line1.cancel=blueprint.obj.line.cancel;
blueprint.obj.line1.add=blueprint.obj.line.add;
blueprint.obj.line1.select=blueprint.obj.line.select;

blueprint.obj.line2={
    group:false
};
blueprint.obj.line2.draw=blueprint.obj.line.draw;
blueprint.obj.line2.start=blueprint.obj.line.start;
blueprint.obj.line2.prev=blueprint.obj.line.prev;
blueprint.obj.line2.next=blueprint.obj.line.next;
blueprint.obj.line2.end=blueprint.obj.line.end;
blueprint.obj.line2.cancel=blueprint.obj.line.cancel;
blueprint.obj.line2.add=blueprint.obj.line.add;
blueprint.obj.line2.select=blueprint.obj.line.select;

