'use strict';

blueprint.obj.door5={
    group:true
};

blueprint.obj.door5.draw=function(x1,y1,x2,y2){
    var m=[x1-x2,y1-y2]
      , d=Math.sqrt(Math.pow(m[0],2)+Math.pow(m[1],2))
      , a=[(Math.PI/2)-Math.asin(m[1]/d),(Math.PI/2)-Math.acos(m[0]/d)]
      , n=[[2*Math.cos(a[0]),2*Math.sin(a[0])],
            [2*Math.cos(a[1]),2*Math.sin(a[1])],
            [2*Math.cos(-a[1]),2*Math.sin(-a[1])]]
      , i=(m[0]<0)?0:(m[1]<0)?1:2
      , p=[x1-m[0]/1.8,y1-m[1]/1.8]
      , q=[x1-m[0]/2.2,y1-m[1]/2.2]

    blueprint.group[0].attr('d',['M',x1,y1,'L',x2,y2].join(' '));
    blueprint.group[1]
        .attr('d',[
            'M',x1+n[i][0],y1+n[i][1],'L',p[0]+n[i][0],p[1]+n[i][1]].join(' '));
    blueprint.group[2]
        .attr('d',[
            'M',q[0]-n[i][0],q[1]-n[i][1],'L',x2-n[i][0],y2-n[i][1]].join(' '));
};

blueprint.obj.door5.start=function(x,y,c){
    blueprint.abs.compose2.start(x,y,c,3);
};

blueprint.obj.door5.prev=function(x,y){
    blueprint.obj.door5.draw(blueprint.stack[0],blueprint.stack[1],x,y);
};

blueprint.obj.door5.next=blueprint.abs.simple.next;
blueprint.obj.door5.end=blueprint.abs.simple.next;
blueprint.obj.door5.cancel=blueprint.abs.simple.cancel;

blueprint.obj.door5.add=function(c,d){
    blueprint.abs.compose2.start(+d[1],+d[2],c,3);
    blueprint.obj.door5.draw(+d[1],+d[2],+d[4],+d[5]);
    blueprint.abs.simple.next();
};

blueprint.obj.door5.select=blueprint.abs.compose2.select;

