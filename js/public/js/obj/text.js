'use strict';

blueprint.obj.text1={
    group:false
};

blueprint.obj.text1.start=function(x,y,c){
    blueprint.layers[1]
        .append('svg:text')
        .attr('x',x)
        .attr('y',y)
        .attr('class',c.join(' '))
        .attr('id',blueprint.getid())
        .text('<< Doble click para editar >>')
        .on('click',blueprint.click)
        .on('dblclick',function(){
            var text=prompt('Ingrese el texto de la etiqueta')

            if(text){
                d3.select(this).html(text);
            }
        });
};

blueprint.obj.text1.next=function(){}
blueprint.obj.text1.end=function(){}
blueprint.obj.text1.cancel=function(){}

blueprint.obj.text1.add=function(c,d){
    var x=d.shift()
      , y=d.shift()

    blueprint.layers[1]
        .append('svg:text')
        .attr('x',x)
        .attr('y',y)
        .attr('class',c.join(' '))
        .attr('id',blueprint.getid())
        .text(d.join(' '));
};

blueprint.obj.text1.select=function(target){
    var x=target.attr('x')
      , y=target.attr('y')
      , d=30

    blueprint.deselect();

    blueprint.selected=target;
    blueprint.def=blueprint.obj['text1'];

    /*blueprint.layers[1].append('svg:line')
        .attr('id','axis')
        .attr('x1',x)
        .attr('y1',y)
        .attr('x2',+x+2*d)
        .attr('y2',y)
        .attr('class','handle axis');*/
    blueprint.layers[1].append('svg:circle')
        .attr('id','translate')
        .attr('cx',+x-d)
        .attr('cy',y)
        .attr('r',4)
        .attr('class','handle translate')
        .call(blueprint.drag.translate);
    /*blueprint.layers[1].append('svg:circle')
        .attr('id','rotate')
        .attr('cx',+x+2*d)
        .attr('cy',y)
        .attr('r',4)
        .attr('class','handle rotate')
        .call(blueprint.drag.rotate);*/
    /*blueprint.layers[1].append('svg:circle')
        .attr('id','centre')
        .attr('cx',x)
        .attr('cy',y)
        .attr('r',4)
        .attr('class','handle centre')
        .call(blueprint.drag.centre);*/
};

blueprint.obj.text2={
    group:false
  , start:blueprint.obj.text1.start
  , next:blueprint.obj.text1.next
  , end:blueprint.obj.text1.end
  , cancel:blueprint.obj.text1.cancel
  , add:blueprint.obj.text1.add
  , select:blueprint.obj.text1.select
}

blueprint.obj.text3={
    group:false
  , start:blueprint.obj.text1.start
  , next:blueprint.obj.text1.next
  , end:blueprint.obj.text1.end
  , cancel:blueprint.obj.text1.cancel
  , add:blueprint.obj.text1.add
  , select:blueprint.obj.text1.select
}

blueprint.obj.text4={
    group:false
  , start:blueprint.obj.text1.start
  , next:blueprint.obj.text1.next
  , end:blueprint.obj.text1.end
  , cancel:blueprint.obj.text1.cancel
  , add:blueprint.obj.text1.add
  , select:blueprint.obj.text1.select
}

blueprint.obj.text5={
    group:false
  , start:blueprint.obj.text1.start
  , next:blueprint.obj.text1.next
  , end:blueprint.obj.text1.end
  , cancel:blueprint.obj.text1.cancel
  , add:blueprint.obj.text1.add
  , select:blueprint.obj.text1.select
}
