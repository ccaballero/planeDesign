<!DOCTYPE html><html lang=en><head><title>Nuevo Plano</title><meta charset=utf-8><meta name=viewport content="width=device-width,initial-scale=1,maximum-scale=1"><link rel=stylesheet href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300&amp;subset=latin,latin-ext"><link rel=stylesheet href=leaflet.css><script src=js/leaflet.min.js></script><link rel=stylesheet href=style.css></head><body><div id=wrapper><div id=menu><div class=section><h1>Archivo</h1><button title="Abrir plano" class="files open"></button><button title="Cerrar plano" class="files close"></button><button title="Guardar plano" class="files save"></button><button title="Ver plano vectorial" class="files svg"></button><button title="Ver plano como imagen" class="files png"></button></div><div class=section><h1>Selección</h1><button title="Activar modo selección (F1)" class="selector picked"></button><button title="Eliminar componente seleccionado (Supr)" class=remove></button></div><div class=section><h1>Localización</h1><button title="Mostrar/Ocultar Mapa" class=map></button><button title="Mostrar/Ocultar Controles de Mapa" class=controls></button></div><div class=section><h1>Ordenar</h1><button title="Traer al frente (Inicio)" class="order first"></button><button title="Elevar (Re Pág)" class="order up"></button><button title="Bajar (Av Pág)" class="order down"></button><button title="Bajar al fondo (Fin)" class="order last"></button></div><div class=section><h1>Etiquetas</h1><button title="Etiqueta 1 (t)" class="draw text1"></button><button title="Etiqueta 2" class="draw text2"></button><button title="Etiqueta 3" class="draw text3"></button><button title="Etiqueta 4" class="draw text4"></button><button title="Etiqueta 5" class="draw text5"></button></div><div class=section><h1>Muros</h1><button title="Trazo lineal (l)" class="draw line1"></button><button title="Trazo polilineal (L)" class="draw polyline1"></button><button title="Trazo discontinuo" class="draw line2"></button><button title="Trazo polilineal discontinuo" class="draw polyline2"></button></div><div class=section><h1>Superficies</h1><button title="Superficie rectangular (r)" class="draw rect1"></button><button title="Superficie poligonal (p)" class="draw polygon1"></button><button title="Arco de 90° (a)" class="draw arc1"></button><button title="Superficie rectangular con delimitador" class="draw rect2"></button><button title="Superficie poligonal con delimitador" class="draw polygon2"></button><button title="Arco de 90° con delimitador" class="draw arc2"></button></div><div class=section><h1>Habitaciones</h1><button title=Dormitorio class="draw room1"></button><button title=Cocina class="draw room2"></button><button title=Baño class="draw room3"></button><button title=Tienda class="draw room4"></button><button title=Patio class="draw room5"></button></div><div class=section><h1>Puertas</h1><button title="Puerta derecha" class="draw door1"></button><button title="Puerta izquierda" class="draw door2"></button><button title="Puerta vaivén derecha" class="draw door3"></button><button title="Puerta vaivén izquierda" class="draw door4"></button><button title="Puerta corrediza" class="draw door5"></button><button title="Puerta principal" class="draw door7"></button></div><div class=section><h1>Ventanas</h1><button title="Ventana baja" class="draw window1"></button></div><div class=section><h1>Comedor</h1><button title="Mesa cuadrada" class="draw table1"></button><button title="Mesa cuadrada grande" class="draw table2"></button><button title="Mesa circular" class="draw table3"></button><button title="Mesa circular grande" class="draw table4"></button></div><div class=section><h1>Sala</h1><button title=Silla class="draw chair1"></button><button title=Taburete class="draw stool1"></button><button title="Sofa Simple" class="draw couch1"></button><button title="Sofa Doble" class="draw couch2"></button><button title="Sofa Triple" class="draw couch3"></button><button title=Librero class="draw bookcase1"></button><button title=Escritorio class="draw desktop1"></button></div><div class=section><h1>Dormitorio</h1><button title="Cama Simple" class="draw bed1"></button><button title="Cama Doble" class="draw bed2"></button><button title="Mesa de Noche" class="draw stand1"></button></div><div class=section><h1>Baño</h1><button title="Lavamanos Rectangular" class="draw sink1"></button><button title="Lavamanos Circular" class="draw sink2"></button><button title=Retrete class="draw toilet1"></button><button title="Tina Rectangular" class="draw bathtub1"></button><button title="Tina Ovalada" class="draw bathtub2"></button><button title="Tina Redondeada" class="draw bathtub3"></button><button title="Ducha simple" class="draw shower1"></button><button title="Ducha redonda" class="draw shower2"></button><button title="Ducha esquinada" class="draw shower3"></button></div><div class=section><h1>Cocina</h1><button title="Lavaplatos Simple" class="draw basin1"></button><button title="Lavaplatos Doble" class="draw basin2"></button><button title="Estufa de 4 Hornillas" class="draw cooker1"></button><button title="Estufa de 2 Hornillas" class="draw cooker2"></button><button title="Refrigerador Ovalado" class="draw fridge1"></button><button title="Refrigerador Rectangular" class="draw fridge2"></button><button title=Mesón class="draw counter1"></button></div><div class=section><h1>Instalaciones</h1><button title="Medidor de Gas" class="draw meter"></button><button title="Cocina-Horno Horizontal" class="draw piston1"></button><button title="Cocina-Horno Vertical" class="draw piston2"></button><button title="Entrada de aire" class="draw input"></button><button title="Salida de gases de combustión" class="draw output"></button><button title="Aireación Rapida" class="draw aeration"></button><button title="Previsto calefón" class="draw heater"></button><button title="Tuberia de Gas" class="draw gasline1"></button><button title="Tuberia de Gas enterrada" class="draw gasline2"></button></div></div><div id=files><div class=section><h1>Archivos</h1><ul class=list></ul><a title=Cancelar class=cancel>Cerrar</a><div class=clearfix></div></div></div><div id=map></div><div id=canvas class=nogrid></div><div id=controls style="display: none"><div class=section><button title=Ampliar class=zoomin></button><button title=Reducir class=zoomout></button><button title="Mover hacia Arriba" class=north></button><button title="Mover hacia Abajo" class=south></button><button title="Mover hacia la Izquierda" class=west></button><button title="Mover hacia la Derecha" class=east></button></div></div></div><script src=js/jquery.min.js></script><script src=js/d3.min.js></script><script src=js/blueprint.js></script></body></html>