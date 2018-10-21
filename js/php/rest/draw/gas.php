<?php

class Gas {
    public function meter($xml,$params){
        $el = $xml->addChild('g');
        $ex = explode(' ', $params);
        $x = (intval($ex[1])+intval($ex[4])+intval($ex[7])+intval($ex[10]))/4;
        $y = (intval($ex[2])+intval($ex[5])+intval($ex[8])+intval($ex[11]))/4;

        $p = $el->addChild('path');
        $p->addAttribute('d',$params);
        foreach($this->styles['meter'][0] as $key => $value){
            $p->addAttribute($key,$value);
        }

        $t = $el->addChild('text','M');
        $t->addAttribute('x',$x-6);
        $t->addAttribute('y',$y+5);
        foreach($this->styles['meter'][1] as $key => $value){
            $t->addAttribute($key,$value);
        }
    }

    public function piston1($xml,$params){
        $el = $xml->addChild('g');
        $ex = explode(' ', $params);

        $x1 = intval($ex[1]);
        $y1 = intval($ex[2]);
        $x2 = intval($ex[4]);
        $y2 = intval($ex[5]);

        $d1 = $el->addChild('path');
        $d1->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$x2,$y2)));
        foreach($this->styles['piston1'][0] as $key => $value){
            $d1->addAttribute($key,$value);
        }

        $d2 = $el->addChild('path');
        $d2->addAttribute('d',implode(' ',array('M',$x1-8,$y1-4,'L',$x1-8,$y1+4,'L',$x1+8,$y1+4,'L',$x1+8,$y1-4,'Z')));
        foreach($this->styles['piston1'][1] as $key => $value){
            $d2->addAttribute($key,$value);
        }

        $d3 = $el->addChild('path');
        $d3->addAttribute('d',implode(' ',array('M',$x1-8,$y1-4,'L',$x1-8,$y1+4,'L',$x1+8,$y1-4,'L',$x1+8,$y1+4,'Z')));
        foreach($this->styles['piston1'][2] as $key => $value){
            $d3->addAttribute($key,$value);
        }

        $d4 = $el->addChild('path');
        $d4->addAttribute('d',implode(' ',array('M',$x2-25,$y2-20,'L',$x2-25,$y2+22,'L',$x2+70,$y2+22,'L',$x2+70,$y2-20,'Z')));
        foreach($this->styles['piston1'][3] as $key => $value){
            $d4->addAttribute($key,$value);
        }

        $t1 = $el->addChild('text','COC-HOR');
        $t1->addAttribute('x',$x2-16);
        $t1->addAttribute('y',$y2);
        foreach($this->styles['piston1'][4] as $key => $value){
            $t1->addAttribute($key,$value);
        }

        $t2 = $el->addChild('text','P = 10 KW');
        $t2->addAttribute('x',$x2-8);
        $t2->addAttribute('y',$y2+15);
        foreach($this->styles['piston1'][4] as $key => $value){
            $t2->addAttribute($key,$value);
        }
    }

    public function piston2($xml,$params){
        $el = $xml->addChild('g');
        $ex = explode(' ', $params);

        $x1 = intval($ex[1]);
        $y1 = intval($ex[2]);
        $x2 = intval($ex[4]);
        $y2 = intval($ex[5]);

        $d1 = $el->addChild('path');
        $d1->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$x2,$y2)));
        foreach($this->styles['piston2'][0] as $key => $value){
            $d1->addAttribute($key,$value);
        }

        $d2 = $el->addChild('path');
        $d2->addAttribute('d',implode(' ',array('M',$x1-4,$y1-8,'L',$x1-4,$y1+8,'L',$x1+4,$y1+8,'L',$x1+4,$y1-8,'Z')));
        foreach($this->styles['piston2'][1] as $key => $value){
            $d2->addAttribute($key,$value);
        }

        $d3 = $el->addChild('path');
        $d3->addAttribute('d',implode(' ',array('M',$x1-4,$y1-8,'L',$x1+4,$y1+8,'L',$x1-4,$y1+8,'L',$x1+4,$y1-8,'Z')));
        foreach($this->styles['piston2'][2] as $key => $value){
            $d3->addAttribute($key,$value);
        }

        $d4 = $el->addChild('path');
        $d4->addAttribute('d',implode(' ',array('M',$x2-25,$y2-20,'L',$x2-25,$y2+22,'L',$x2+70,$y2+22,'L',$x2+70,$y2-20,'Z')));
        foreach($this->styles['piston2'][3] as $key => $value){
            $d4->addAttribute($key,$value);
        }

        $t1 = $el->addChild('text','COC-HOR');
        $t1->addAttribute('x',$x2-16);
        $t1->addAttribute('y',$y2);
        foreach($this->styles['piston2'][4] as $key => $value){
            $t1->addAttribute($key,$value);
        }

        $t2 = $el->addChild('text','P = 10 KW');
        $t2->addAttribute('x',$x2-8);
        $t2->addAttribute('y',$y2+15);
        foreach($this->styles['piston2'][4] as $key => $value){
            $t2->addAttribute($key,$value);
        }
    }

    public function input($xml,$params){
        $el = $xml->addChild('g');
        $ex = explode(' ', $params);

        $x1 = intval($ex[1]);
        $y1 = intval($ex[2]);
        $x2 = intval($ex[4]);
        $y2 = intval($ex[5]);

        $d1 = $el->addChild('path');
        $d1->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$x2,$y2)));
        $d1->addAttribute('marker-start','url(#head)');
        foreach($this->styles['input'][0] as $key => $value){
            $d1->addAttribute($key,$value);
        }

        $d2 = $el->addChild('circle');
        $d2->addAttribute('cx',$x1);
        $d2->addAttribute('cy',$y1);
        $d2->addAttribute('r',8);
        foreach($this->styles['input'][1] as $key => $value){
            $d2->addAttribute($key,$value);
        }

        $d3 = $el->addChild('path');
        $d3->addAttribute('d',implode(' ',array('M',$x1-6,$y1-3,'L',$x1-6,$y1+3,'L',$x1+6,$y1+3,'L',$x1+6,$y1-3,'Z')));

        $d4 = $el->addChild('path');
        $d4->addAttribute('d',implode(' ',array('M',$x2-25,$y2-20,'L',$x2-25,$y2+40,'L',$x2+110,$y2+40,'L',$x2+110,$y2-20,'Z')));
        foreach($this->styles['input'][2] as $key => $value){
            $d4->addAttribute($key,$value);
        }

        $d5 = $el->addChild('text','Entrada de Aire');
        $d5->addAttribute('x',$x2-16);
        $d5->addAttribute('y',$y2);
        foreach($this->styles['input'][3] as $key => $value){
            $d5->addAttribute($key,$value);
        }

        $d6 = $el->addChild('text','h = 0.30 m');
        $d6->addAttribute('x',$x2-8);
        $d6->addAttribute('y',$y2+15);
        foreach($this->styles['input'][3] as $key => $value){
            $d6->addAttribute($key,$value);
        }

        $d7 = $el->addChild('text','s = 100 cm²');
        $d7->addAttribute('x',$x2-8);
        $d7->addAttribute('y',$y2+30);
        foreach($this->styles['input'][3] as $key => $value){
            $d7->addAttribute($key,$value);
        }
    }

    public function output($xml,$params){
        $el = $xml->addChild('g');
        $ex = explode(' ', $params);

        $x1 = intval($ex[1]);
        $y1 = intval($ex[2]);
        $x2 = intval($ex[4]);
        $y2 = intval($ex[5]);

        $d1 = $el->addChild('path');
        $d1->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$x2,$y2)));
        $d1->addAttribute('marker-start','url(#tail)');
        foreach($this->styles['output'][0] as $key => $value){
            $d1->addAttribute($key,$value);
        }

        $d2 = $el->addChild('circle');
        $d2->addAttribute('cx',$x1);
        $d2->addAttribute('cy',$y1);
        $d2->addAttribute('r',8);
        foreach($this->styles['output'][1] as $key => $value){
            $d2->addAttribute($key,$value);
        }

        $d3 = $el->addChild('path');
        $d3->addAttribute('d',implode(' ',array('M',$x1-6,$y1-3,'L',$x1-6,$y1+3,'L',$x1+6,$y1+3,'L',$x1+6,$y1-3,'Z')));

        $d4 = $el->addChild('path');
        $d4->addAttribute('d',implode(' ',array('M',$x2-25,$y2-20,'L',$x2-25,$y2+61,'L',$x2+110,$y2+61,'L',$x2+110,$y2-20,'Z')));
        foreach($this->styles['output'][2] as $key => $value){
            $d4->addAttribute($key,$value);
        }

        $d5 = $el->addChild('text','Salida de Gases');
        $d5->addAttribute('x',$x2-16);
        $d5->addAttribute('y',$y2);
        foreach($this->styles['output'][3] as $key => $value){
            $d5->addAttribute($key,$value);
        }

        $d6 = $el->addChild('text','de Combustión');
        $d6->addAttribute('x',$x2-16);
        $d6->addAttribute('y',$y2+18);
        foreach($this->styles['output'][3] as $key => $value){
            $d6->addAttribute($key,$value);
        }

        $d7 = $el->addChild('text','h = 1.80 m');
        $d7->addAttribute('x',$x2-8);
        $d7->addAttribute('y',$y2+36);
        foreach($this->styles['output'][3] as $key => $value){
            $d7->addAttribute($key,$value);
        }

        $d8 = $el->addChild('text','s = 100 cm²');
        $d8->addAttribute('x',$x2-8);
        $d8->addAttribute('y',$y2+51);
        foreach($this->styles['output'][3] as $key => $value){
            $d8->addAttribute($key,$value);
        }
    }

    public function aeration($xml,$params){
        $el = $xml->addChild('g');
        $ex = explode(' ', $params);

        $x1 = intval($ex[1]);
        $y1 = intval($ex[2]);
        $x2 = intval($ex[4]);
        $y2 = intval($ex[5]);
        $v1 = array($x1-$x2,$y1-$y2);
        $d1 = sqrt(pow($v1[0],2)+pow($v1[1],2));
        $u1 = array(60*($v1[0]/$d1),60*($v1[1]/$d1));
        $i = ($v1[0]<0)?0:($v1[1]<0)?1:2;
        $b = array((M_PI/2)-asin($v1[1]/$d1),(M_PI/2)-acos($v1[0]/$d1));
        $n1 = array(
                array(4*cos($b[0]),4*sin($b[0])),
                array(4*cos($b[1]),4*sin($b[1])),
                array(4*cos(-$b[1]),4*sin(-$b[1])));
        $n2 = array(
                array(10*cos($b[0]),10*sin($b[0])),
                array(10*cos($b[1]),10*sin($b[1])),
                array(10*cos(-$b[1]),10*sin(-$b[1])));
        $v2 = array($x1-$n1[$i][0],$y1-$n1[$i][1],$x2-$n1[$i][0],$y2-$n1[$i][1]);
        $v3 = array($x1-$n2[$i][0],$y1-$n2[$i][1],$x2-$n2[$i][0],$y2-$n2[$i][1]);
        $m1 = array($v2[0]-(($v2[0]-$v2[2])/2),$v2[1]-(($v2[1]-$v2[3])/2));
        $m2 = array($v3[0]-(($v3[0]-$v3[2])/2),$v3[1]-(($v3[1]-$v3[3])/2));
        $w1 = array($m2[0]-$m1[0],$m2[1]-$m1[1]);
        $d2 = sqrt(pow($w1[0],2)+pow($w1[1],2));
        $u2 = array(60*($w1[0]/$d2),60*($w1[1]/$d2));
        $z1 = array($m2[0]+$u1[0]+$u2[0],$m2[1]+$u1[1]+$u2[1]);

        $p1 = $el->addChild('path');
        $p1->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$x2,$y2)));
        foreach($this->styles['aeration'][0] as $key => $value){
            $p1->addAttribute($key,$value);
        }

        $p2 = $el->addChild('path');
        $p2->addAttribute('d',implode(' ',array('M',$v2[0],$v2[1],'L',$v2[2],$v2[3])));
        foreach($this->styles['aeration'][1] as $key => $value){
            $p2->addAttribute($key,$value);
        }

        $p3 = $el->addChild('path');
        $p3->addAttribute('d',implode(' ',array('M',$m2[0],$m2[1],'L',$z1[0],$z1[1])));
        $p3->addAttribute('marker-start','url(#head)');
        foreach($this->styles['aeration'][2] as $key => $value){
            $p3->addAttribute($key,$value);
        }

        $t1 = $el->addChild('text','Aireación Rapida');
        $t1->addAttribute('x',$z1[0]+20);
        $t1->addAttribute('y',$z1[1]-20);
        foreach($this->styles['aeration'][3] as $key => $value){
            $t1->addAttribute($key,$value);
        }

        $t2 = $el->addChild('text','≥ 0.40 m²');
        $t2->addAttribute('x',$z1[0]+25);
        $t2->addAttribute('y',$z1[1]-4);
        foreach($this->styles['aeration'][3] as $key => $value){
            $t2->addAttribute($key,$value);
        }
    }

    public function heater($xml,$params){
        $el = $xml->addChild('g');
        $ex = explode(' ', $params);

        $x1 = intval($ex[1]);
        $y1 = intval($ex[2]);
        $x2 = intval($ex[4]);
        $y2 = intval($ex[5]);

        $d1 = $el->addChild('path');
        $d1->addAttribute('d',implode(' ',array('M',$x1,$y1,'L',$x2,$y2)));
        foreach($this->styles['heater'][0] as $key => $value){
            $d1->addAttribute($key,$value);
        }

        $d2 = $el->addChild('circle');
        $d2->addAttribute('cx',$x1);
        $d2->addAttribute('cy',$y1);
        $d2->addAttribute('r',8);
        foreach($this->styles['heater'][1] as $key => $value){
            $d2->addAttribute($key,$value);
        }

        $d3 = $el->addChild('path');
        $d3->addAttribute('d',implode(' ',array('M',$x1-5,$y1+1,'L',$x1-1,$y1+1,'L',$x1-1,$y1+1,'L',$x1-1,$y1+5,'L',$x1+1,$y1+5,'L',$x1+1,$y1+1,'L',$x1+5,$y1+1,'L',$x1+5,$y1-1,'L',$x1+1,$y1-1,'L',$x1+1,$y1-5,'L',$x1-1,$y1-5,'L',$x1-1,$y1-1,'L',$x1-3,$y1-1,'Z')));

        $d4 = $el->addChild('path');
        $d4->addAttribute('d',implode(' ',array('M',$x2-25,$y2-20,'L',$x2-25,$y2+40,'L',$x2+60,$y2+40,'L',$x2+60,$y2-20,'Z')));
        foreach($this->styles['heater'][2] as $key => $value){
            $d4->addAttribute($key,$value);
        }

        $d5 = $el->addChild('text','PREVISTO');
        $d5->addAttribute('x',$x2-16);
        $d5->addAttribute('y',$y2);
        foreach($this->styles['heater'][3] as $key => $value){
            $d5->addAttribute($key,$value);
        }

        $d6 = $el->addChild('text','CALEFON');
        $d6->addAttribute('x',$x2-16);
        $d6->addAttribute('y',$y2+15);
        foreach($this->styles['heater'][3] as $key => $value){
            $d6->addAttribute($key,$value);
        }

        $d7 = $el->addChild('text','15 [kW]');
        $d7->addAttribute('x',$x2-8);
        $d7->addAttribute('y',$y2+30);
        foreach($this->styles['heater'][3] as $key => $value){
            $d7->addAttribute($key,$value);
        }
    }

    public function gasline1($xml,$params){
        $el = $xml->addChild('path');
        $el->addAttribute('d',$params);
        foreach($this->styles['gasline1'] as $key => $value){
            $el->addAttribute($key,$value);
        }
    }

    public function gasline2($xml,$params){
        $el = $xml->addChild('path');
        $el->addAttribute('d',$params);
        foreach($this->styles['gasline2'] as $key => $value){
            $el->addAttribute($key,$value);
        }
    }
}

