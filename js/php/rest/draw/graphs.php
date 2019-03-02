<?php

class Graphs {
    public function obj($xml,$params,$img,$type,$obj){
        $el = $xml->addChild('g');
 
        $p = $el->addChild('path');
        $p->addAttribute('d',$params);
        foreach($this->styles[$obj] as $key => $value){
            $p->addAttribute($key,$value);
        }

        $g = $el->addChild('image');
        $list = explode (' ',$img);
        $g->addAttribute('x',$list[0]);
        $g->addAttribute('y',$list[1]);
        $g->addAttribute('width',$list[2]);
        $g->addAttribute('height',$list[3]);
        $g->addAttribute('transform',$list[4]);

        $base = realpath(dirname(__FILE__).'/../../svg/obj/'.$obj.'.svg');

        if($type=='png'){
            $g->addAttribute('xlink:href',$base,'http://www.w3.org/1999/xlink');
        }else{
            $g->addAttribute('xlink:href','../svg/obj/' . $obj . '.svg','http://www.w3.org/1999/xlink');
        }
    }
}

