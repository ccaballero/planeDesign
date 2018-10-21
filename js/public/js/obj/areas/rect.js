'use strict';

blueprint.obj.rect={
    group:false
};

blueprint.obj.rect.start=blueprint.abs.multiple.start;

blueprint.obj.rect.prev=function(x,y){
    if(blueprint.stack.length==3){
        blueprint.selected
            .attr('d',blueprint.stack.concat(['L',x,y]).join(' '));
    }else if(blueprint.stack.length==6){
        var m=-(blueprint.stack[1]-blueprint.stack[4])/
                (blueprint.stack[2]-blueprint.stack[5])
          , d=m*(x-blueprint.stack[4])

        blueprint.selected
            .attr('d',blueprint.stack.concat(['L',x,d+blueprint.stack[5],'L'
                ,x+(blueprint.stack[1]-blueprint.stack[4])
                ,d+blueprint.stack[5]+(blueprint.stack[2]-blueprint.stack[5])
            ]).join(' ')
        );
    }
};

blueprint.obj.rect.next=function(x,y){
    if(blueprint.stack.length==3){
        blueprint.stack=blueprint.stack.concat(['L',x,y]);
        blueprint.selected.attr('d',blueprint.stack.join(' '));
    }else if(blueprint.stack.length==6){
        blueprint.selected
            .attr('d',blueprint.selected.attr('d')+' Z')
            .attr('id',blueprint.getid())
            .on('click',blueprint.click);

        blueprint.stack=undefined;
        blueprint.selected=undefined;
        blueprint.group=undefined;
    }
};

blueprint.obj.rect.cancel=blueprint.abs.multiple.cancel;
blueprint.obj.rect.end=blueprint.obj.rect.next;

blueprint.obj.rect.add=blueprint.abs.multiple.add;

blueprint.obj.rect.select=function(target){
    var stack=target.attr('d').split(' ').filter(function(e,i){
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

    var j=1;
    for(var i=0;i<stack.length;i+=2){
        blueprint.layers[1].append('svg:circle')
            .attr('id','handle'+(j++))
            .attr('cx',stack[i])
            .attr('cy',stack[i+1])
            .attr('r',4)
            .attr('class','handle vertex')
            .call(blueprint.drag.rect);
    }
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

blueprint.obj.rect1={
    group:false
};
blueprint.obj.rect1.start=blueprint.obj.rect.start;
blueprint.obj.rect1.prev=blueprint.obj.rect.prev;
blueprint.obj.rect1.next=blueprint.obj.rect.next;
blueprint.obj.rect1.cancel=blueprint.obj.rect.cancel;
blueprint.obj.rect1.end=blueprint.obj.rect.end;
blueprint.obj.rect1.add=blueprint.obj.rect.add;
blueprint.obj.rect1.select=blueprint.obj.rect.select;

blueprint.obj.rect2={
    group:false
};
blueprint.obj.rect2.start=blueprint.obj.rect.start;
blueprint.obj.rect2.prev=blueprint.obj.rect.prev;
blueprint.obj.rect2.next=blueprint.obj.rect.next;
blueprint.obj.rect2.cancel=blueprint.obj.rect.cancel;
blueprint.obj.rect2.end=blueprint.obj.rect.end;
blueprint.obj.rect2.add=blueprint.obj.rect.add;
blueprint.obj.rect2.select=blueprint.obj.rect.select;

