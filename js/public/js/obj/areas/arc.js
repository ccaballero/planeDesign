'use strict';

blueprint.obj.arc={
    group:false
};

blueprint.obj.arc.render=function(x1,y1,x2,y2,x3,y3){
    var d1=Math.sqrt(
            Math.pow(x1-x2,2)+
            Math.pow(y1-y2,2))
      , d2=Math.sqrt(
            Math.pow(x2-x3,2)+
            Math.pow(y2-y3,2))
      , u=[(x1-x2)/d1,(y1-y2)/d1]
      , r=Math.min(d1/2,d2/2)

    if(d1<d2){
        var x4=x3+((d1/2)*u[0])
          , y4=y3+((d1/2)*u[1])
          , x5=x1+((d2-(d1/2))*-u[1])
          , y5=y1+((d2-(d1/2))*u[0])
    }else{
        var x4=x3+((d1-(d2/2))*u[0])
          , y4=y3+((d1-(d2/2))*u[1])
          , x5=x1+((d2/2)*-u[1])
          , y5=y1+((d2/2)*u[0])
    }

    return [
        'M',x1,y1
      , 'L',x2,y2
      , 'L',x3,y3
      , 'L',x4,y4
      , 'A',r,r,0,0,0,x5,y5
    ];
}

blueprint.obj.arc.start=blueprint.abs.multiple.start;

blueprint.obj.arc.prev=function(x,y){
    if(blueprint.stack.length==3){
        blueprint.selected
            .attr('d',blueprint.stack.concat(['L',x,y]).join(' '));
    }else if(blueprint.stack.length==6){
        var res=[
                blueprint.stack[1]
              , blueprint.stack[2]
              , blueprint.stack[4]
              , blueprint.stack[5]
            ]
          , d=Math.sqrt(
                Math.pow(x-res[2],2)+
                Math.pow(y-res[3],2))
          , d1=Math.sqrt(
                Math.pow(res[0]-res[2],2)+
                Math.pow(res[1]-res[3],2))
          , u=[(res[0]-res[2])/d1,
                (res[1]-res[3])/d1]

        res.push(res[2]+(d*-u[1]));
        res.push(res[3]+(d*u[0]));

        blueprint.selected
            .attr('d',blueprint.obj.arc.render(
                res[0],res[1],res[2],res[3],res[4],res[5]).join(' '));
    }
};

blueprint.obj.arc.next=function(x,y){
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

blueprint.obj.arc.cancel=blueprint.abs.multiple.cancel;
blueprint.obj.arc.end=blueprint.obj.arc.next;

blueprint.obj.arc.add=blueprint.abs.multiple.add;

blueprint.obj.arc.select=function(target){
    var _s=target.attr('d').split(' ')
      , v=[+_s[7]- +_s[4],+_s[8]- +_s[5]]
      , vd=Math.sqrt(v[0]*v[0]+v[1]*v[1])
      , stack=[
            +_s[1],+_s[2]
          , +_s[4],+_s[5]
          , +_s[7],+_s[8]
          , +_s[10]-(+_s[13]*v[0]/vd),+_s[11]-(+_s[14]*v[1]/vd)
        ]
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
            .call(blueprint.drag.arc);
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

blueprint.obj.arc1={
    group:false
};
blueprint.obj.arc1.start=blueprint.obj.arc.start;
blueprint.obj.arc1.prev=blueprint.obj.arc.prev;
blueprint.obj.arc1.next=blueprint.obj.arc.next;
blueprint.obj.arc1.cancel=blueprint.obj.arc.cancel;
blueprint.obj.arc1.end=blueprint.obj.arc.end;
blueprint.obj.arc1.add=blueprint.obj.arc.add;
blueprint.obj.arc1.select=blueprint.obj.arc.select;

blueprint.obj.arc2={
    group:false
};
blueprint.obj.arc2.start=blueprint.obj.arc.start;
blueprint.obj.arc2.prev=blueprint.obj.arc.prev;
blueprint.obj.arc2.next=blueprint.obj.arc.next;
blueprint.obj.arc2.cancel=blueprint.obj.arc.cancel;
blueprint.obj.arc2.end=blueprint.obj.arc.end;
blueprint.obj.arc2.add=blueprint.obj.arc.add;
blueprint.obj.arc2.select=blueprint.obj.arc.select;

