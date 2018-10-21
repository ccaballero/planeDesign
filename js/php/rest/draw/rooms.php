<?php

class Rooms {
    private function __basic($xml,$prop,$params){
        $el = $xml->addChild('g');
        $ex = explode(' ',$params);

        $p = $el->addChild('path');
        $p->addAttribute('d',$params);
        foreach($this->styles[$prop] as $key => $value){
            $p->addAttribute($key,$value);
        }

        $x = (floatval($ex[1])+floatval($ex[4])+floatval($ex[7])+floatval($ex[10]))/4;
        $y = (floatval($ex[2])+floatval($ex[5])+floatval($ex[8])+floatval($ex[11]))/4;

        switch($prop){
            case 'room1':
                $t = $el->addChild('text','Dormitorio');
                $t->addAttribute('x',$x-30);
                $t->addAttribute('y',$y);
                break;
            case 'room2':
                $t = $el->addChild('text','Cocina (V > 8m³)');
                $t->addAttribute('x',$x-30);
                $t->addAttribute('y',$y);
                break;
            case 'room3':
                $t = $el->addChild('text','Baño');
                $t->addAttribute('x',$x-30);
                $t->addAttribute('y',$y);
                break;
            case 'room4':
                $t = $el->addChild('text','Tienda');
                $t->addAttribute('x',$x-30);
                $t->addAttribute('y',$y);
                break;
            case 'room5':
                $t = $el->addChild('text','Patio');
                $t->addAttribute('x',$x-30);
                $t->addAttribute('y',$y);
                break;
        }
    }

    public function room1($xml,$params){ $this->__basic($xml,'room1',$params); }
    public function room2($xml,$params){ $this->__basic($xml,'room2',$params); }
    public function room3($xml,$params){ $this->__basic($xml,'room3',$params); }
    public function room4($xml,$params){ $this->__basic($xml,'room4',$params); }
    public function room5($xml,$params){ $this->__basic($xml,'room5',$params); }
}

