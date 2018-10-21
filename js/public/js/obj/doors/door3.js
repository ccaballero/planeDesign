'use strict';

blueprint.obj.door3={
    group:true
};

blueprint.obj.door3.draw=function(x1,y1,x2,y2){
    var v=[x2-x1,y2-y1]
      , m=[x1+v[1],y1-v[0]]
      , n=[x1-v[1],y1+v[0]]
      , d=Math.sqrt(Math.pow(v[0],2)+Math.pow(v[1],2))

    blueprint.group[0].attr('d',['M',x1,y1,'L',x2,y2].join(' '));
    blueprint.group[1].attr('d',['M',x1,y1,'L',m[0],m[1]].join(' '));
    blueprint.group[2]
        .attr('d',['M',n[0],n[1],'A',d,d,0,0,0,m[0],m[1]].join(' '));
};

blueprint.obj.door3.start=function(x,y,c){
    blueprint.abs.compose2.start(x,y,c,3);
};

blueprint.obj.door3.prev=function(x,y){
    blueprint.obj.door3.draw(blueprint.stack[0],blueprint.stack[1],x,y);
};

blueprint.obj.door3.next=blueprint.abs.simple.next;
blueprint.obj.door3.end=blueprint.abs.simple.next;
blueprint.obj.door3.cancel=blueprint.abs.simple.cancel;

blueprint.obj.door3.add=function(c,d){
    blueprint.abs.compose2.start(+d[1],+d[2],c,3);
    blueprint.obj.door3.draw(+d[1],+d[2],+d[4],+d[5]);
    blueprint.abs.simple.next();
};

blueprint.obj.door3.select=blueprint.abs.compose2.select;

