<?php

class Basic {
    private function __basic($xml,$prop,$params){
        $el = $xml->addChild('path');
        $el->addAttribute('d',$params);
        foreach($this->styles[$prop] as $key => $value){
            $el->addAttribute($key,$value);
        }
    }

    public function line1($xml,$params){ $this->__basic($xml,'line1',$params); }
    public function line2($xml,$params){ $this->__basic($xml,'line2',$params); }
    public function polyline1($xml,$params){ $this->__basic($xml,'polyline1',$params); }
    public function polyline2($xml,$params){ $this->__basic($xml,'polyline2',$params); }
    public function rect1($xml,$params){ $this->__basic($xml,'rect1',$params); }
    public function rect2($xml,$params){ $this->__basic($xml,'rect2',$params); }
    public function polygon1($xml,$params){ $this->__basic($xml,'polygon1',$params); }
    public function polygon2($xml,$params){ $this->__basic($xml,'polygon2',$params); }
    public function arc1($xml,$params){ $this->__basic($xml,'arc1',$params); }
    public function arc2($xml,$params){ $this->__basic($xml,'arc2',$params); }
}

