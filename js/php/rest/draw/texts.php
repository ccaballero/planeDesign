<?php

class Texts {
    public function __basic($xml,$prop,$params){
        $ex = explode(' ',$params);
        $x = $ex[0];
        $y = $ex[1];

        array_splice($ex,0,2);

        $el = $xml->addChild('text',implode(' ',$ex));
        $el->addAttribute('x',$x);
        $el->addAttribute('y',$y);

        foreach($this->styles[$prop][0] as $key => $value){
            $el->addAttribute($key,$value);
        }
    }

    public function text1($xml,$params){ $this->__basic($xml,'text1',$params); }
    public function text2($xml,$params){ $this->__basic($xml,'text2',$params); }
    public function text3($xml,$params){ $this->__basic($xml,'text3',$params); }
    public function text4($xml,$params){ $this->__basic($xml,'text4',$params); }
    public function text5($xml,$params){ $this->__basic($xml,'text5',$params); }
}

