<?php

////////////////////////////////////////////////////////
// -----------------------------------------------------  
//     ____    ______  __  __             __     
//    /\  _`\ /\  _  \/\ \/\ \          /'__`\   
//    \ \,\L\_\ \ \L\ \ \ \ \ \  __  __/\_\L\ \  
//     \/_\__ \\ \  __ \ \ \ \ \/\ \/\ \/_/_\_<_ 
//       /\ \L\ \ \ \/\ \ \ \_\ \ \ \_/ |/\ \L\ \
//       \ `\____\ \_\ \_\ \_____\ \___/ \ \____/
//        \/_____/\/_/\/_/\/_____/\/__/   \/___/                                            
// -----------------------------------------------------      
//  SAU v3  Hecho por Jose de Jesus Herrera Mata
//  http://www.jhcodes.com/ - jesuxherrerajhcodes.com                                  
// -----------------------------------------------------       
////////////////////////////////////////////////////////

// Datos del Hosting para la conexion a la base de datos
define('HOST', 'localhost');
define('DBUSER', 'root');
define('DBPASSWORD', '');
define('DBNAME', 'sau3');


// Nota: Debes de cambiar estos dos, ya que con estos dos generas
// contraseñas mas fuertes, la practica de usar varios tipos de
// hash solo hace lento el funcionamiento del script y es innecesario
// puedes crear mas de este tipo usando cualquier generador alfanumerico
// pero recomiendo este sitio http://randomkeygen.com/

// Complementos para contraseñas
define('SALT', 'd68y1860IauOJJuF48y95T4I0V0HxI1P');
define('PEPER', '3OW1liX0mnue6dA4n9R6a871wJVPU07b');

// Complementos para la verficacion del email, en este caso solo debes de usar uno
// puedes utilizar el mismo sitio de http://randomkeygen.com/ pero puede ser como
// tu quieras.

define('TOKENMAIL', 'eLNN439K14o4f6I7Gd8Ni9kdFR4zZYiU');


// Finalmente el nombre del sistema, para no tener que estarlo editando siempre
// por que algunas personas me dicen, es que son muchas paginas y no puedo editar
// todas, me lleva tiempo bla bla bla, asi que pues ya de una vez no jajaja :D
define('SITETITLE', 'GAS DOMICILIARIO');


// Idioma que se va a querer usar para el SAU 3, solo he puesto 3 idiomas y eso
// por que creo que seria genial tener 3 idiomas, pero para que sea mas sencillo
// solo se tiene que elegir el numero que es referente a cada idioma.
//
//  Español -> 1
//  English -> 2
//  
define('SAULANGDEF','1');


// Para finalizar el Estilo por defecto del sitio, quise ponerlo en la administracion
// pero no quise hacerlo tan tedioso asi que simplemente vamos a dejarlo aqui.
//
// 1 = SAU Default
// 2 = SAU Blue
// 3 = SAU Black
// 4 = SAU Gray
// 5 = SAU Red
define('SAUSTYLE','1');