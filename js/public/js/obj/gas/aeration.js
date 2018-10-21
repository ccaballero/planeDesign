'use strict';

blueprint.obj.aeration={
    group:true
  , custom:true
};

blueprint.obj.aeration.translate=function(t){};
blueprint.obj.aeration.rotate=function(t,r){};

blueprint.obj.aeration.draw=function(x1,y1,x2,y2){
    var v1=[x1-x2,y1-y2]
      , d1=Math.sqrt(Math.pow(v1[0],2)+Math.pow(v1[1],2))
      , u1=[60*(v1[0]/d1),60*(v1[1]/d1)]
      , i=(v1[0]<0)?0:(v1[1]<0)?1:2
      , b=[(Math.PI/2)-Math.asin(v1[1]/d1),(Math.PI/2)-Math.acos(v1[0]/d1)]
      , n1=[[4*Math.cos(b[0]),4*Math.sin(b[0])],
            [4*Math.cos(b[1]),4*Math.sin(b[1])],
            [4*Math.cos(-b[1]),4*Math.sin(-b[1])]]
      , n2=[[10*Math.cos(b[0]),10*Math.sin(b[0])],
            [10*Math.cos(b[1]),10*Math.sin(b[1])],
            [10*Math.cos(-b[1]),10*Math.sin(-b[1])]]
      , v2=[x1-n1[i][0],y1-n1[i][1],x2-n1[i][0],y2-n1[i][1]]
      , v3=[x1-n2[i][0],y1-n2[i][1],x2-n2[i][0],y2-n2[i][1]]
      , m1=[v2[0]-((v2[0]-v2[2])/2),v2[1]-((v2[1]-v2[3])/2)]
      , m2=[v3[0]-((v3[0]-v3[2])/2),v3[1]-((v3[1]-v3[3])/2)]
      , w1=[m2[0]-m1[0],m2[1]-m1[1]]
      , d2=Math.sqrt(Math.pow(w1[0],2)+Math.pow(w1[1],2))
      , u2=[60*(w1[0]/d2),60*(w1[1]/d2)]
      , z1=[m2[0]+u1[0]+u2[0],m2[1]+u1[1]+u2[1]]

    blueprint.group[0].attr('d',['M',x1,y1,'L',x2,y2].join(' '));
    blueprint.group[1].attr('d',['M',v2[0],v2[1],'L',v2[2],v2[3]].join(' '));
    blueprint.group[2]
        .attr('d',['M',m2[0],m2[1],'L',z1[0],z1[1]].join(' '))
        .attr('marker-start','url(#head)');

    blueprint.group[3]
        .attr('x',z1[0]+20)
        .attr('y',z1[1]-20);
    blueprint.group[4]
        .attr('x',z1[0]+25)
        .attr('y',z1[1]-4);
}

blueprint.obj.aeration.start=function(x,y,c){
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
            .append('svg:text')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
            .text('Aireación Rapida')
      , blueprint.selected
            .append('svg:text')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
            .text('≥ 0.40 m²')
    ];
};

blueprint.obj.aeration.prev=function(x,y){
    blueprint.obj.aeration.draw(blueprint.stack[0],blueprint.stack[1],x,y);
};

blueprint.obj.aeration.next=blueprint.abs.simple.next;
blueprint.obj.aeration.end=blueprint.abs.simple.next;
blueprint.obj.aeration.cancel=blueprint.abs.simple.cancel;

blueprint.obj.aeration.add=function(c,d){
    blueprint.obj.aeration.start(+d[1],+d[2],c);
    blueprint.obj.aeration.draw(+d[1],+d[2],+d[4],+d[5]);
    blueprint.obj.aeration.next();
};

blueprint.obj.aeration.select=blueprint.abs.install.select;

