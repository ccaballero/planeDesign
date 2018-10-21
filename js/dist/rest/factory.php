<?php

include 'draw/styles.php';
include 'draw/basic.php';
include 'draw/doors.php';
include 'draw/windows.php';
include 'draw/texts.php';
include 'draw/rooms.php';
include 'draw/graphs.php';
include 'draw/gas.php';

class Factory {
    public static function generateXML($components, $type='xml'){
        $factory = new Factory();

        $xml = new SimpleXMLElement('<svg/>');

        if ($type == 'svg' || $type == 'png') {
            $xml->addAttribute('xmlns','http://www.w3.org/2000/svg');
            $xml->addAttribute('xlink:nothing','','http://www.w3.org/1999/xlink');
            unset($xml->attributes('xlink', true)['nothing']);
        }

        $defs = $xml->addChild('defs');

        $head = $defs->addChild('marker');
        $head->addAttribute('id','head');
        $head->addAttribute('orient','auto');
        $head->addAttribute('markerWidth','13');
        $head->addAttribute('markerHeight','13');
        $head->addAttribute('refX','-10');
        $head->addAttribute('refY','6');
        $p1 = $head->addChild('path');
        $p1->addAttribute('d','M 2 6 L 8 10 L 8 2 Z');
        $p1->addAttribute('fill','#909090');

        $tail = $defs->addChild('marker');
        $tail->addAttribute('id','tail');
        $tail->addAttribute('orient','auto');
        $tail->addAttribute('markerWidth','13');
        $tail->addAttribute('markerHeight','13');
        $tail->addAttribute('refX','-10');
        $tail->addAttribute('refY','6');
        $p2 = $tail->addChild('path');
        $p2->addAttribute('d','M 2 2 L 2 10 L 9 6 Z');
        $p2->addAttribute('fill','#909090');

        $size = array(0,0,0,0);

        foreach($components as $item) {
            $list = explode(' :: ',$item);
            switch(count($list)){
                case 2:
                    $prop = $list[0];
                    $params = $list[1];
                    $img = null;
                    break;
                case 3:
                    $prop = $list[0];
                    $params = $list[1];
                    $img = $list[2];
            }

            if(method_exists($factory,$prop)){
                $factory->$prop($xml,$params,$img,$type);
                $bounds = Factory::getBounds(explode(' ',$params));
                $size[0] = min($size[0],$bounds[0]);
                $size[1] = min($size[1],$bounds[1]);
                $size[2] = max($size[2],$bounds[2]);
                $size[3] = max($size[3],$bounds[3]);
            }else{
                $notfound = $xml->addChild('g');
                $notfound->addAttribute('id',$prop);
            }
        }

        $size[2] += 150;
        $size[3] += 80;

        $xml->addAttribute('viewBox',implode(' ',$size));
        $xml->addAttribute('width',$size[2]-$size[0]);
        $xml->addAttribute('height',$size[3]-$size[1]);

        return $xml->asXML();
    }

    public static function getBounds($d){
        $b = array(0,0,0,0);
        for($i = 0; $i < count($d); $i++) {
            if($i % 3 == 1) {
                $b[0] = min($b[0],intval($d[$i]));
                $b[2] = max($b[2],intval($d[$i]));
            }else if($i % 3 == 2) {
                $b[1] = min($b[1],intval($d[$i]));
                $b[3] = max($b[3],intval($d[$i]));
            }
        }
        return $b;
    }

    public static function generateSVG($components){
        header('Content-Type: image/svg+xml');
        return Factory::generateXML($components,'svg');
    }

    public static function generatePNG($components){
        $im = new Imagick();
        $im->readImageBlob(Factory::generateXML($components,'png'));
        $im->setImageFormat('png24');

        header('Content-Type: image/png');
        return $im->getImageBlob();
    }

    public function __construct(){
        $styles = new Styles();

        $this->basic = new Basic();
        $this->door = new Doors();
        $this->window = new Windows();
        $this->text = new Texts();
        $this->room = new Rooms();
        $this->graph = new Graphs();
        $this->gas = new Gas();

        $this->basic->styles = $styles->styles;
        $this->door->styles = $styles->styles;
        $this->window->styles = $styles->styles;
        $this->text->styles = $styles->styles;
        $this->room->styles = $styles->styles;
        $this->graph->styles = $styles->styles;
        $this->gas->styles = $styles->styles;
    }

    public function line1($xml,$params){ $this->basic->line1($xml,$params); }
    public function line2($xml,$params){ $this->basic->line2($xml,$params); }

    public function polyline1($xml,$params){ $this->basic->polyline1($xml,$params); }
    public function polyline2($xml,$params){ $this->basic->polyline2($xml,$params); }

    public function rect1($xml,$params){ $this->basic->rect1($xml,$params); }
    public function rect2($xml,$params){ $this->basic->rect2($xml,$params); }

    public function polygon1($xml,$params){ $this->basic->polygon1($xml,$params); }
    public function polygon2($xml,$params){ $this->basic->polygon2($xml,$params); }

    public function arc1($xml,$params){ $this->basic->arc1($xml,$params); }
    public function arc2($xml,$params){ $this->basic->arc2($xml,$params); }

    public function door1($xml,$params){ $this->door->door1($xml,$params); }
    public function door2($xml,$params){ $this->door->door2($xml,$params); }
    public function door3($xml,$params){ $this->door->door3($xml,$params); }
    public function door4($xml,$params){ $this->door->door4($xml,$params); }
    public function door5($xml,$params){ $this->door->door5($xml,$params); }
    public function door6($xml,$params){ $this->door->door6($xml,$params); }
    public function door7($xml,$params){ $this->door->door7($xml,$params); }

    public function window1($xml,$params){ $this->window->window1($xml,$params); }

    public function text1($xml,$params){ $this->text->text1($xml,$params); }
    public function text2($xml,$params){ $this->text->text2($xml,$params); }
    public function text3($xml,$params){ $this->text->text3($xml,$params); }
    public function text4($xml,$params){ $this->text->text4($xml,$params); }
    public function text5($xml,$params){ $this->text->text5($xml,$params); }

    public function room1($xml,$params){ $this->room->room1($xml,$params); }
    public function room2($xml,$params){ $this->room->room2($xml,$params); }
    public function room3($xml,$params){ $this->room->room3($xml,$params); }
    public function room4($xml,$params){ $this->room->room4($xml,$params); }
    public function room5($xml,$params){ $this->room->room5($xml,$params); }

    public function table1    ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'table1'    ); }
    public function table2    ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'table2'    ); }
    public function table3    ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'table3'    ); }
    public function table4    ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'table4'    ); }
    public function chair1    ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'chair1'    ); }
    public function stool1    ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'stool1'    ); }
    public function couch1    ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'couch1'    ); }
    public function couch2    ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'couch2'    ); }
    public function couch3    ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'couch3'    ); }
    public function bookcase1 ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'bookcase1' ); }
    public function desktop1  ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'desktop1'  ); }
    public function bed1      ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'bed1'      ); }
    public function bed2      ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'bed2'      ); }
    public function stand1    ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'stand1'    ); }
    public function sink1     ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'sink1'     ); }
    public function sink2     ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'sink2'     ); }
    public function toilet1   ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'toilet1'   ); }
    public function bathtub1  ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'bathtub1'  ); }
    public function bathtub2  ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'bathtub2'  ); }
    public function bathtub3  ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'bathtub3'  ); }
    public function shower1   ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'shower1'   ); }
    public function shower2   ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'shower2'   ); }
    public function shower3   ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'shower3'   ); }
    public function basin1    ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'basin1'    ); }
    public function basin2    ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'basin2'    ); }
    public function cooker1   ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'cooker1'   ); }
    public function cooker2   ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'cooker2'   ); }
    public function fridge1   ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'fridge1'   ); }
    public function fridge2   ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'fridge2'   ); }
    public function counter1  ($xml,$params,$img,$type){ $this->graph->obj($xml,$params,$img,$type,'counter1'  ); }

    public function meter   ($xml,$params){ $this->gas->meter($xml,$params); }
    public function piston1 ($xml,$params){ $this->gas->piston1($xml,$params); }
    public function piston2 ($xml,$params){ $this->gas->piston2($xml,$params); }
    public function input   ($xml,$params){ $this->gas->input($xml,$params); }
    public function output  ($xml,$params){ $this->gas->output($xml,$params); }
    public function aeration($xml,$params){ $this->gas->aeration($xml,$params); }
    public function heater  ($xml,$params){ $this->gas->heater($xml,$params); }
    public function gasline1($xml,$params){ $this->gas->gasline1($xml,$params); }
    public function gasline2($xml,$params){ $this->gas->gasline2($xml,$params); }
}

