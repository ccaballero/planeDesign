'use strict';

blueprint.abs.graph2={};

blueprint.abs.graph2.translate=function(t){
    var i=blueprint.selected.select('image')
      , d=blueprint.selected.select('path').attr('d').split(' ')
      , match=/rotate\((.+),(.+),(.+)\)/.exec(i.attr('transform'))
      , X=(+d[1]+ +d[4]+ +d[7]+ +d[10])/4
      , x=X-(+i.attr('width')/2)
      , Y=(+d[2]+ +d[5]+ +d[8]+ +d[11])/4
      , y=Y-(+i.attr('height')/2)

    i.attr('x',x)
     .attr('y',y)
     .attr('transform','rotate('+match[1]+','+X+','+Y+')');
};

blueprint.abs.graph2.rotate=function(t,r){
    var i=blueprint.selected.select('image')
      , d=blueprint.selected.select('path').attr('d').split(' ')
      , match=/rotate\((.+),(.+),(.+)\)/.exec(i.attr('transform'))
      , X=(+d[1]+ +d[4]+ +d[7]+ +d[10])/4
      , x=X-(+i.attr('width')/2)
      , Y=(+d[2]+ +d[5]+ +d[8]+ +d[11])/4
      , y=Y-(+i.attr('height')/2)
      , r=(t[0]*180)/Math.PI

    i.attr('x',x)
     .attr('y',y)
     .attr('transform','rotate('+(+match[1]+r)+','+X+','+Y+')');
};

blueprint.abs.graph2.draw=function(x1,y1,x2,y2,img){
    var x=x1<x2?x1:x2
      , y=y1<y2?y1:y2
      , X=x1<x2?x2:x1
      , Y=y1<y2?y2:y1
      , cx=x+((X-x)/2)
      , cy=y+((Y-y)/2)

    if(blueprint.group.length==2){
        blueprint.group[0].attr(
            'd',['M',x,y,'L',x,Y,'L',X,Y,'L',X,y].join(' '));
        blueprint.group[1]
            .attr('x',x)
            .attr('y',y)
            .attr('width',X-x)
            .attr('height',Y-y)
            .attr('transform','rotate(0,'+cx+','+cy+')')
            .attr('xlink:href','svg/obj/'+img+'.svg');
    }else{
        blueprint.selected.select('image')
            .attr('x',x)
            .attr('y',y)
            .attr('width',X-x)
            .attr('height',Y-y)
            .attr('transform','rotate(0,'+cx+','+cy+')')
            .attr('xlink:href','svg/obj/'+img+'.svg');
    }
};

blueprint.abs.graph2.start=function(x,y,c){
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
            .append('svg:image')
            .on('mousedown',blueprint.mousedown)
            .on('mousemove',blueprint.mousemove)
    ];
};

blueprint.abs.graph2.add=function(c,d,e){
    blueprint.abs.graph2.start(+d[1],+d[2],c);
    blueprint.group[0].attr('d',d.join(' '));
    blueprint.group[1]
        .attr('x',e[0])
        .attr('y',e[1])
        .attr('width',e[2])
        .attr('height',e[3])
        .attr('transform',e[4])
        .attr('xlink:href','svg/obj/'+c[0]+'.svg');
    blueprint.abs.simple.next();
};
blueprint.abs.graph2.select=function(target){
    blueprint.group=[];

    target.selectAll('path').each(function(d,i){
        blueprint.group.push(d3.select(this));
    });

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

