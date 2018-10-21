<?php

class Windows {
    public function window1($xml,$params){
        $el = $xml->addChild('g');
        $ex = explode(' ',$params);

        $x1 = floatval($ex[1]);
        $y1 = floatval($ex[2]);
        $x2 = floatval($ex[4]);
        $y2 = floatval($ex[5]);

        $m = array($x1-$x2,$y1-$y2);
        $d = sqrt(pow($m[0],2)+pow($m[1],2));
        $a = array((M_PI/2)-asin($m[1]/$d),(M_PI/2)-acos($m[0]/$d));
        $n = array(
                 array(4*cos($a[0]),4*sin($a[0])),
                 array(4*cos($a[1]),4*sin($a[1])),
                 array(4*cos(-$a[1]),4*sin(-$a[1]))
             );
        $i = ($m[0]<0)? 0 : ($m[1]<0)? 1 : 2;

        $p1 = $el->addChild('path');
        $p1->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$x2,$y2)));
        foreach($this->styles['window1'][0] as $key => $value) {
            $p1->addAttribute($key,$value);
        }

        $p2 = $el->addChild('path');
        $p2->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$x2,$y2)));
        foreach($this->styles['window1'][1] as $key => $value) {
            $p2->addAttribute($key,$value);
        }

        $p3 = $el->addChild('path');
        $p3->addAttribute('d',implode(' ',array('M',$x1+$n[$i][0],$y1+$n[$i][1],'L',$x2+$n[$i][0],$y2+$n[$i][1])));
        foreach($this->styles['window1'][2] as $key => $value) {
            $p3->addAttribute($key,$value);
        }

        $p4 = $el->addChild('path');
        $p4->addAttribute('d',implode(' ',array('M',$x1-$n[$i][0],$y1-$n[$i][1],'L',$x2-$n[$i][0],$y2-$n[$i][1])));
        foreach($this->styles['window1'][3] as $key => $value) {
            $p4->addAttribute($key,$value);
        }
    }
}

