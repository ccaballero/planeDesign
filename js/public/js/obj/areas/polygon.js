'use strict';

blueprint.obj.polygon={
    group:false
};

blueprint.obj.polygon.start=blueprint.abs.multiple.start;
blueprint.obj.polygon.prev=blueprint.abs.multiple.prev;
blueprint.obj.polygon.next=blueprint.abs.multiple.next;
blueprint.obj.polygon.cancel=blueprint.abs.multiple.cancel;

blueprint.obj.polygon.end=function(){
    blueprint.selected.attr('d',blueprint.selected.attr('d')+' Z');
    blueprint.abs.multiple.end();
};

blueprint.obj.polygon.add=blueprint.abs.multiple.add;
blueprint.obj.polygon.select=blueprint.abs.simple.select;

blueprint.obj.polygon1={
    group:false
};
blueprint.obj.polygon1.start=blueprint.obj.polygon.start;
blueprint.obj.polygon1.prev=blueprint.obj.polygon.prev;
blueprint.obj.polygon1.next=blueprint.obj.polygon.next;
blueprint.obj.polygon1.cancel=blueprint.obj.polygon.cancel;
blueprint.obj.polygon1.end=blueprint.obj.polygon.end;
blueprint.obj.polygon1.add=blueprint.obj.polygon.add;
blueprint.obj.polygon1.select=blueprint.obj.polygon.select;

blueprint.obj.polygon2={
    group:false
};
blueprint.obj.polygon2.start=blueprint.obj.polygon.start;
blueprint.obj.polygon2.prev=blueprint.obj.polygon.prev;
blueprint.obj.polygon2.next=blueprint.obj.polygon.next;
blueprint.obj.polygon2.cancel=blueprint.obj.polygon.cancel;
blueprint.obj.polygon2.end=blueprint.obj.polygon.end;
blueprint.obj.polygon2.add=blueprint.obj.polygon.add;
blueprint.obj.polygon2.select=blueprint.obj.polygon.select;

