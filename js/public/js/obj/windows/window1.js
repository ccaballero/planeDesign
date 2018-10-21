'use strict';

blueprint.obj.window1={
    group:true
};

blueprint.obj.window1.draw=function(x1,y1,x2,y2){
    var m=[x1-x2,y1-y2]
      , d=Math.sqrt(Math.pow(m[0],2)+Math.pow(m[1],2))
      , a=[(Math.PI/2)-Math.asin(m[1]/d),(Math.PI/2)-Math.acos(m[0]/d)]
      , n=[[4*Math.cos(a[0]),4*Math.sin(a[0])],
            [4*Math.cos(a[1]),4*Math.sin(a[1])],
            [4*Math.cos(-a[1]),4*Math.sin(-a[1])]]
      , i=(m[0]<0)?0:(m[1]<0)?1:2

    blueprint.group[0].attr('d',['M',x1,y1,'L',x2,y2].join(' '));
    blueprint.group[1].attr('d',['M',x1,y1,'L',x2,y2].join(' '));
    blueprint.group[2]
        .attr('d',[
            'M',x1+n[i][0],y1+n[i][1],'L',x2+n[i][0],y2+n[i][1]].join(' '));
    blueprint.group[3]
        .attr('d',[
            'M',x1-n[i][0],y1-n[i][1],'L',x2-n[i][0],y2-n[i][1]].join(' '));
};

blueprint.obj.window1.start=function(x,y,c){
    blueprint.abs.compose2.start(x,y,c,4);
};

blueprint.obj.window1.prev=function(x,y){
    blueprint.obj.window1.draw(blueprint.stack[0],blueprint.stack[1],x,y);
};

blueprint.obj.window1.next=blueprint.abs.simple.next;
blueprint.obj.window1.end=blueprint.abs.simple.next;
blueprint.obj.window1.cancel=blueprint.abs.simple.cancel;

blueprint.obj.window1.add=function(c,d){
    blueprint.abs.compose2.start(+d[1],+d[2],c,4);
    blueprint.obj.window1.draw(+d[1],+d[2],+d[4],+d[5]);
    blueprint.abs.simple.next();
};

blueprint.obj.window1.select=blueprint.abs.compose2.select;


