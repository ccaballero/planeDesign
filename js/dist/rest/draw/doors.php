<?php

class Doors {
    public function door1($xml,$params) {
        $el = $xml->addChild('g');
        $ex = explode(' ',$params);

        $x1 = floatval($ex[1]);
        $y1 = floatval($ex[2]);
        $x2 = floatval($ex[4]);
        $y2 = floatval($ex[5]);

        $v = array($x2-$x1,$y2-$y1);
        $m = array($x1+$v[1],$y1-$v[0]);
        $d = sqrt(pow($v[0],2)+pow($v[1],2));

        $p1 = $el->addChild('path');
        $p1->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$x2,$y2)));
        foreach($this->styles['door1'][0] as $key => $value) {
            $p1->addAttribute($key,$value);
        }

        $p2 = $el->addChild('path');
        $p2->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$m[0],$m[1])));
        foreach($this->styles['door1'][1] as $key => $value) {
            $p2->addAttribute($key,$value);
        }

        $p3 = $el->addChild('path');
        $p3->addAttribute('d',implode(' ',array('M',$x2,$y2,'A',$d,$d,0,0,0,$m[0],$m[1])));
        foreach($this->styles['door1'][2] as $key => $value) {
            $p3->addAttribute($key,$value);
        }
    }

    public function door2($xml,$params) {
        $el = $xml->addChild('g');
        $ex = explode(' ',$params);

        $x1 = floatval($ex[1]);
        $y1 = floatval($ex[2]);
        $x2 = floatval($ex[4]);
        $y2 = floatval($ex[5]);

        $v = array($x1-$x2,$y1-$y2);
        $m = array($x2-$v[1],$y2+$v[0]);
        $d = sqrt(pow($v[0],2)+pow($v[1],2));

        $p1 = $el->addChild('path');
        $p1->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$x2,$y2)));
        foreach($this->styles['door2'][0] as $key => $value) {
            $p1->addAttribute($key,$value);
        }

        $p2 = $el->addChild('path');
        $p2->addAttribute('d',implode(' ',array('M',$x2,$y2,'L',$m[0],$m[1])));
        foreach($this->styles['door2'][1] as $key => $value) {
            $p2->addAttribute($key,$value);
        }

        $p3 = $el->addChild('path');
        $p3->addAttribute('d',implode(' ',array('M',$x1,$y1,'A',$d,$d,0,0,1,$m[0],$m[1])));
        foreach($this->styles['door2'][2] as $key => $value) {
            $p3->addAttribute($key,$value);
        }
    }

    public function door3($xml,$params) {
        $el = $xml->addChild('g');
        $ex = explode(' ',$params);

        $x1 = floatval($ex[1]);
        $y1 = floatval($ex[2]);
        $x2 = floatval($ex[4]);
        $y2 = floatval($ex[5]);

        $v = array($x2-$x1,$y2-$y1);
        $m = array($x1+$v[1],$y1-$v[0]);
        $n = array($x1-$v[1],$y1-$v[0]);
        $d = sqrt(pow($v[0],2)+pow($v[1],2));

        $p1 = $el->addChild('path');
        $p1->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$x2,$y2)));
        foreach($this->styles['door3'][0] as $key => $value) {
            $p1->addAttribute($key,$value);
        }

        $p2 = $el->addChild('path');
        $p2->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$m[0],$m[1])));
        foreach($this->styles['door3'][1] as $key => $value) {
            $p2->addAttribute($key,$value);
        }

        $p3 = $el->addChild('path');
        $p3->addAttribute('d',implode(' ',array('M',$n[0],$n[1],'A',$d,$d,0,0,0,$m[0],$m[1])));
        foreach($this->styles['door3'][2] as $key => $value) {
            $p3->addAttribute($key,$value);
        }
    }

    public function door4($xml,$params) {
        $el = $xml->addChild('g');
        $ex = explode(' ',$params);

        $x1 = floatval($ex[1]);
        $y1 = floatval($ex[2]);
        $x2 = floatval($ex[4]);
        $y2 = floatval($ex[5]);

        $v = array($x1-$x2,$y1-$y2);
        $m = array($x2-$v[1],$y2+$v[0]);
        $n = array($x2+$v[1],$y2-$v[0]);
        $d = sqrt(pow($v[0],2)+pow($v[1],2));

        $p1 = $el->addChild('path');
        $p1->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$x2,$y2)));
        foreach($this->styles['door4'][0] as $key => $value) {
            $p1->addAttribute($key,$value);
        }

        $p2 = $el->addChild('path');
        $p2->addAttribute('d',implode(' ',array('M',$x2,$y2,'L',$m[0],$m[1])));
        foreach($this->styles['door4'][1] as $key => $value) {
            $p2->addAttribute($key,$value);
        }

        $p3 = $el->addChild('path');
        $p3->addAttribute('d',implode(' ',array('M',$n[0],$n[1],'A',$d,$d,0,0,0,$m[0],$m[1])));
        foreach($this->styles['door4'][2] as $key => $value) {
            $p3->addAttribute($key,$value);
        }
    }

    public function door5($xml,$params){
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
                 array(2*cos($a[0]),2*sin($a[0])),
                 array(2*cos($a[1]),2*sin($a[1])),
                 array(2*cos(-$a[1]),2*sin(-$a[1])),
             );
        $i = ($m[0]<0)? 0 : ($m[1]<0)? 1 : 2;
        $p = array($x1-($m[0]/1.8),$y1-($m[1]/1.8));
        $q = array($x1-($m[0]/2.2),$y1-($m[1]/2.2));

        $p1 = $el->addChild('path');
        $p1->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$x2,$y2)));
        foreach($this->styles['door5'][0] as $key => $value) {
            $p1->addAttribute($key,$value);
        }

        $p2 = $el->addChild('path');
        $p2->addAttribute('d',implode(' ',array('M',$x1+$n[$i][0],$y1+$n[$i][1],'L',$p[0]+$n[$i][0],$p[1]+$n[$i][1])));
        foreach($this->styles['door5'][1] as $key => $value) {
            $p2->addAttribute($key,$value);
        }

        $p3 = $el->addChild('path');
        $p3->addAttribute('d',implode(' ',array('M',$q[0]-$n[$i][0],$q[1]-$n[$i][1],'L',$x2-$n[$i][0],$y2-$n[$i][1])));
        foreach($this->styles['door5'][2] as $key => $value) {
            $p3->addAttribute($key,$value);
        }
    }

    public function door6($xml,$params){
        $el = $xml->addChild('g');
        $ex = explode(' ',$params);

        $x1 = floatval($ex[1]);
        $y1 = floatval($ex[2]);
        $x2 = floatval($ex[4]);
        $y2 = floatval($ex[5]);

        $p1 = $el->addChild('path');
        $p1->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$x2,$y2)));
        foreach($this->styles['door6'][0] as $key => $value) {
            $p1->addAttribute($key,$value);
        }
    }

    public function door7($xml,$params){
        $el = $xml->addChild('g');
        $ex = explode(' ',$params);

        $x1 = floatval($ex[1]);
        $y1 = floatval($ex[2]);
        $x2 = floatval($ex[4]);
        $y2 = floatval($ex[5]);

        $v = array(($x2-$x1)/2,($y2-$y1)/2);
        $p = array($x1+$v[0],$y1+$v[1]);
        $m1 = array($x1+$v[1],$y1-$v[0]);
        $m2 = array($x2+$v[1],$y2-$v[0]);
        $d = sqrt(pow($v[0],2)+pow($v[1],2));

        $p1 = $el->addChild('path');
        $p1->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$x2,$y2)));
        foreach($this->styles['door7'][0] as $key => $value) {
            $p1->addAttribute($key,$value);
        }

        $p2 = $el->addChild('path');
        $p2->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$m1[0],$m1[1])));
        foreach($this->styles['door7'][1] as $key => $value) {
            $p2->addAttribute($key,$value);
        }

        $p3 = $el->addChild('path');
        $p3->addAttribute('d',implode(' ',array('M',$x2,$y2,'L',$m2[0],$m2[1])));
        foreach($this->styles['door7'][2] as $key => $value) {
            $p3->addAttribute($key,$value);
        }

        $p4 = $el->addChild('path');
        $p4->addAttribute('d',implode(' ',array('M',$m1[0],$m1[1],'A',$d,$d,0,0,1,$p[0],$p[1],'A',$d,$d,0,0,1,$m2[0],$m2[1])));
        foreach($this->styles['door7'][3] as $key => $value) {
            $p4->addAttribute($key,$value);
        }
    }
}

