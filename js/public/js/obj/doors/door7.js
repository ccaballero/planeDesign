'use strict';

blueprint.obj.door7={
    group:true
};

blueprint.obj.door7.draw=function(x1,y1,x2,y2){
    var v=[(x2-x1)/2,(y2-y1)/2]
      , p=[x1+v[0],y1+v[1]]
      , m1=[x1+v[1],y1-v[0]]
      , m2=[x2+v[1],y2-v[0]]
      , d=Math.sqrt(Math.pow(v[0],2)+Math.pow(v[1],2))

    blueprint.group[0].attr('d',['M',x1,y1,'L',x2,y2].join(' '));
    blueprint.group[1].attr('d',['M',x1,y1,'L',m1[0],m1[1]].join(' '));
    blueprint.group[2].attr('d',['M',x2,y2,'L',m2[0],m2[1]].join(' '));
    blueprint.group[3].attr('d',[
        'M',m1[0],m1[1],
        'A',d,d,0,0,1,p[0],p[1],
        'A',d,d,0,0,1,m2[0],m2[1]].join(' ')
    );
};

blueprint.obj.door7.start=function(x,y,c){
    blueprint.abs.compose2.start(x,y,c,4);
};

blueprint.obj.door7.prev=function(x,y){
    blueprint.obj.door7.draw(blueprint.stack[0],blueprint.stack[1],x,y);
};

blueprint.obj.door7.next=blueprint.abs.simple.next;
blueprint.obj.door7.end=blueprint.abs.simple.next;
blueprint.obj.door7.cancel=blueprint.abs.simple.cancel;

blueprint.obj.door7.add=function(c,d){
    blueprint.abs.compose2.start(+d[1],+d[2],c,4);
    blueprint.obj.door7.draw(+d[1],+d[2],+d[4],+d[5]);
    blueprint.abs.simple.next();
};

blueprint.obj.door7.select=blueprint.abs.compose2.select;

