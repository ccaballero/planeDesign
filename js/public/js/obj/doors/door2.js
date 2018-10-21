'use strict';

blueprint.obj.door2={
    group:true
};

blueprint.obj.door2.draw=function(x1,y1,x2,y2){
    var v=[x1-x2,y1-y2]
      , m=[x2-v[1],y2+v[0]]
      , d=Math.sqrt(Math.pow(v[0],2)+Math.pow(v[1],2))

    blueprint.group[0].attr('d',['M',x1,y1,'L',x2,y2].join(' '));
    blueprint.group[1].attr('d',['M',x2,y2,'L',m[0],m[1]].join(' '));
    blueprint.group[2].attr('d',['M',x1,y1,'A',d,d,0,0,1,m[0],m[1]].join(' '));
};

blueprint.obj.door2.start=function(x,y,c){
    blueprint.abs.compose2.start(x,y,c,3);
};

blueprint.obj.door2.prev=function(x,y){
    blueprint.obj.door2.draw(blueprint.stack[0],blueprint.stack[1],x,y);
}

blueprint.obj.door2.next=blueprint.abs.simple.next;
blueprint.obj.door2.end=blueprint.abs.simple.next;
blueprint.obj.door2.cancel=blueprint.abs.simple.cancel;

blueprint.obj.door2.add=function(c,d){
    blueprint.abs.compose2.start(+d[1],+d[2],c,3);
    blueprint.obj.door2.draw(+d[1],+d[2],+d[4],+d[5]);
    blueprint.abs.simple.next();
};

blueprint.obj.door2.select=blueprint.abs.compose2.select;

