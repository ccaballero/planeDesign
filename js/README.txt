
Procedimiento:

1: copiar la carpeta dist a htdocs con el nombre que quieras.

2: crea una base de datos mysql,,,y ejecuta el archivo draft.sql en la carpeta sql.

3: configura los datos de acceso a la base de datos en el archivo dist/rest/config.php

4: en el archivo dist/js/blueprint.js, busca el texto:

    http://draft.local

    y sustituyelo por el dominio en el que se ejecutará la aplicación.

5: no olvides la libreria GD.

    "normalize-less": "*",
    "d3": "~3.5.5",
    "jquery": "~2.1.4"
