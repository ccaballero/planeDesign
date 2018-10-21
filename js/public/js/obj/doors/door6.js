'use strict';

blueprint.obj.door6={
    group:true
};

blueprint.obj.door6.draw=function(x1,y1,x2,y2){
    blueprint.group[0].attr('d',['M',x1,y1,'L',x2,y2].join(' '));
};

blueprint.obj.door6.start=function(x,y,c){
    blueprint.abs.compose2.start(x,y,c,3);
};

blueprint.obj.door6.prev=function(x,y){
    blueprint.obj.door6.draw(blueprint.stack[0],blueprint.stack[1],x,y);
};

blueprint.obj.door6.next=blueprint.abs.simple.next;
blueprint.obj.door6.end=blueprint.abs.simple.next;
blueprint.obj.door6.cancel=blueprint.abs.simple.cancel;

blueprint.obj.door6.add=function(c,d){
    blueprint.abs.compose2.start(+d[1],+d[2],c,3);
    blueprint.obj.door6.draw(+d[1],+d[2],+d[4],+d[5]);
    blueprint.abs.simple.next();
};

blueprint.obj.door6.select=blueprint.abs.compose2.select;

