'use strict';

blueprint.obj.room1={
    group:true
  , custom:true
};

blueprint.obj.room1.draw=function(x1,y1,x2,y2){
    var text=blueprint.selected.select('text')
      , d=blueprint.selected.select('path').attr('d').split(' ')

    text.attr('x',(+d[1]+ +d[4]+ +d[7]+ +d[10])/4)
        .attr('y',(+d[2]+ +d[5]+ +d[8]+ +d[11])/4);

    var offset=text.node().getBBox()

    text.attr('x',+text.attr('x')- (+offset.width/2))
        .attr('y',+text.attr('y')- (+offset.height/2));
};

blueprint.obj.room1.render=function(x1,y1,x2,y2,x3,y3,t1,t2){
    var m=-(x1-x2)/(y1-y2)
      , d=m*(x3-x2)

    blueprint.group[0]
        .attr('d',[
            'M',x1,y1,'L',x2,y2,'L',x3,d+y2,'L',x3+(x1-x2),d+y2+(y1-y2)
        ].join(' '));

    if(t2){
        blueprint.group[1]
            .attr('x',(x1+x2+x3+(x3+(x1-x2)))/4)
            .attr('y',(y1+y2+d+y2+d+y2+(y1-y2))/4)
            .attr('class','text2')
            .text(t1)
            .append('tspan')
            .text(' '+t2);
    }else{
        blueprint.group[1]
            .attr('x',(x1+x2+x3+(x3+(x1-x2)))/4)
            .attr('y',(y1+y2+d+y2+d+y2+(y1-y2))/4)
            .attr('class','text2')
            .text(t1);
    }

    var offset=blueprint.group[1].node().getBBox()

    blueprint.group[1]
        .attr('x',+blueprint.group[1].attr('x') - (+offset.width/2))
        .attr('y',+blueprint.group[1].attr('y') - (+offset.height/2));
}

blueprint.obj.room1.start=function(x,y,c){
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
    ];
};

blueprint.obj.room1.prev=function(x,y){
    blueprint.obj.room1.prev1(x,y,blueprint.obj.room1.render,'Dormitorio');
};

blueprint.obj.room1.prev1=function(x,y,f,t1,t2){
    if(blueprint.stack.length==2){
        blueprint.group[0]
            .attr('d',[
                'M',blueprint.stack[0],blueprint.stack[1],'L',x,y].join(' ')
            );
    }else if(blueprint.stack.length==4){
        f(blueprint.stack[0],blueprint.stack[1],
            blueprint.stack[2],blueprint.stack[3],x,y,t1,t2);
    }
};

blueprint.obj.room1.next=function(x,y){
    if(blueprint.stack.length==2){
        blueprint.stack=blueprint.stack.concat([x,y]);
    }else if(blueprint.stack.length==4){
        blueprint.group[0].attr('d',blueprint.group[0].attr('d')+' Z');

        blueprint.selected
            .attr('id',blueprint.getid())
            .on('click',blueprint.click);

        blueprint.stack=undefined;
        blueprint.selected=undefined;
        blueprint.group=undefined;
    }
};

blueprint.obj.room1.end=blueprint.obj.room1.next;
blueprint.obj.room1.cancel=blueprint.abs.simple.cancel;

blueprint.obj.room1.add=function(c,d){
    blueprint.obj.room1.add1(c,d,blueprint.obj.room1.render,'Dormitorio');
};

blueprint.obj.room1.add1=function(c,d,f,t1,t2){
    blueprint.obj.room1.start(+d[1],+d[2],c);
    blueprint.obj.room1.next(+d[4],+d[5]);
    f(+d[1],+d[2],+d[4],+d[5],+d[7],+d[8],t1,t2);
    blueprint.obj.room1.next(+d[7],+d[8]);
};

blueprint.obj.room1.select=function(target){
    blueprint.group=[
        target.select('path')
      , target.select('text')
    ];

    var pivot=blueprint.group[0]
      , stack=pivot.attr('d').split(' ').filter(function(e,i){
            return i%3!=0;
        }).map(function(e){
            return +e;
        })
      , a=Math.atan((stack[3]-stack[1])/(stack[2]-stack[0]))
      , d=30
      , p=[stack[0]+(stack[2]-stack[0])/2,stack[1]+(stack[3]-stack[1])/2]

    blueprint.deselect();

    blueprint.selected=target;
    blueprint.def=blueprint.obj[target.attr('class').split(' ')[0]];

    blueprint.layers[1].append('svg:circle')
        .attr('id','handle1')
        .attr('cx',stack[0])
        .attr('cy',stack[1])
        .attr('r',4)
        .attr('class','handle vertex')
        .call(blueprint.drag.rect);
    blueprint.layers[1].append('svg:circle')
        .attr('id','handle2')
        .attr('cx',stack[2])
        .attr('cy',stack[3])
        .attr('r',4)
        .attr('class','handle vertex')
        .call(blueprint.drag.rect);
    blueprint.layers[1].append('svg:circle')
        .attr('id','handle3')
        .attr('cx',stack[4])
        .attr('cy',stack[5])
        .attr('r',4)
        .attr('class','handle vertex')
        .call(blueprint.drag.rect);
    blueprint.layers[1].append('svg:circle')
        .attr('id','handle4')
        .attr('cx',stack[6])
        .attr('cy',stack[7])
        .attr('r',4)
        .attr('class','handle vertex')
        .call(blueprint.drag.rect);
    blueprint.layers[1].append('svg:line')
        .attr('id','axis')
        .attr('x1',p[0])
        .attr('y1',p[1])
        .attr('x2',p[0]+3*d*Math.sin(-a))
        .attr('y2',p[1]+3*d*Math.cos(-a))
        .attr('class','handle axis');
    blueprint.layers[1].append('svg:circle')
        .attr('id','translate')
        .attr('cx',p[0]-d*Math.sin(-a))
        .attr('cy',p[1]-d*Math.cos(-a))
        .attr('r',4)
        .attr('class','handle translate')
        .call(blueprint.drag.translate);
    blueprint.layers[1].append('svg:circle')
        .attr('id','rotate')
        .attr('cx',p[0]+3*d*Math.sin(-a))
        .attr('cy',p[1]+3*d*Math.cos(-a))
        .attr('r',4)
        .attr('class','handle rotate')
        .call(blueprint.drag.rotate);
    blueprint.layers[1].append('svg:circle')
        .attr('id','centre')
        .attr('cx',p[0])
        .attr('cy',p[1])
        .attr('r',4)
        .attr('class','handle centre')
        .call(blueprint.drag.centre);
};

blueprint.obj.room1.translate=function(t){
    var text=blueprint.selected.select('text')
      , x=+text.attr('x')
      , y=+text.attr('y')

    text.attr('x',x+t[0])
        .attr('y',y+t[1]);
};

blueprint.obj.room1.rotate=function(t,r){
    var text=blueprint.selected.select('text')
      , d=blueprint.selected.select('path').attr('d').split(' ')

    text.attr('x',(+d[1]+ +d[4]+ +d[7]+ +d[10])/4)
        .attr('y',(+d[2]+ +d[5]+ +d[8]+ +d[11])/4);

    var offset=text.node().getBBox()

    text.attr('x',+text.attr('x')- (+offset.width/2))
        .attr('y',+text.attr('y')- (+offset.height/2));
};

blueprint.obj.room2={
    group:true
  , custom:true
  , draw:blueprint.obj.room1.draw
  , start:blueprint.obj.room1.start
  , prev:function(x,y){
        blueprint.obj.room1.prev1(x,y,blueprint.obj.room1.render,'Cocina','(V > 8m³)');
    }
  , next:blueprint.obj.room1.next
  , end:blueprint.obj.room1.end
  , cancel:blueprint.obj.room1.cancel
  , add:function(c,d){
        blueprint.obj.room1.add1(c,d,blueprint.obj.room1.render,'Cocina','(V > 8m³)');
    }
  , select:blueprint.obj.room1.select
  , translate:blueprint.obj.room1.translate
  , rotate:blueprint.obj.room1.rotate
};

blueprint.obj.room3={
    group:true
  , custom:true
  , draw:blueprint.obj.room1.draw
  , start:blueprint.obj.room1.start
  , prev:function(x,y){
        blueprint.obj.room1.prev1(x,y,blueprint.obj.room1.render,'Baño');
    }
  , next:blueprint.obj.room1.next
  , end:blueprint.obj.room1.end
  , cancel:blueprint.obj.room1.cancel
  , add:function(c,d){
        blueprint.obj.room1.add1(c,d,blueprint.obj.room1.render,'Baño');
    }
  , select:blueprint.obj.room1.select
  , translate:blueprint.obj.room1.translate
  , rotate:blueprint.obj.room1.rotate
};

blueprint.obj.room4={
    group:true
  , custom:true
  , draw:blueprint.obj.room1.draw
  , start:blueprint.obj.room1.start
  , prev:function(x,y){
        blueprint.obj.room1.prev1(x,y,blueprint.obj.room1.render,'Tienda');
    }
  , next:blueprint.obj.room1.next
  , end:blueprint.obj.room1.end
  , cancel:blueprint.obj.room1.cancel
  , add:function(c,d){
        blueprint.obj.room1.add1(c,d,blueprint.obj.room1.render,'Tienda');
    }
  , select:blueprint.obj.room1.select
  , translate:blueprint.obj.room1.translate
  , rotate:blueprint.obj.room1.rotate
};

blueprint.obj.room5={
    group:true
  , custom:true
  , draw:blueprint.obj.room1.draw
  , start:blueprint.obj.room1.start
  , prev:function(x,y){
        blueprint.obj.room1.prev1(x,y,blueprint.obj.room1.render,'Patio');
    }
  , next:blueprint.obj.room1.next
  , end:blueprint.obj.room1.end
  , cancel:blueprint.obj.room1.cancel
  , add:function(c,d){
        blueprint.obj.room1.add1(c,d,blueprint.obj.room1.render,'Patio');
    }
  , select:blueprint.obj.room1.select
  , translate:blueprint.obj.room1.translate
  , rotate:blueprint.obj.room1.rotate
};

