<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fecha y Hora</title>
    <style>
		body{
			background-color: #5276af;
			height: 100%;
		}
		#container{
			background: white;
			margin: 100px auto;
			padding: 100px;
			text-align: center;
		}
	</style>
</head>
<body>
    <div id="container">
        <?php
        
        /*
        d:dia
        m:mes
        y:año(4 dig.)
        l:dia de la semana

        h:hora(1-12)
        i:minutos
        s:segundos
        a:am-pm
        

        depdendiendo de lo que devuelva el date con el argumento se puede generar un array como abajo para adaptarlo a nuestra necesidad
        ej:

        */

        /*setlocale(LC_TIME,"es_ES");
        echo strftime(" Hoy es %A %d de %B y son las %H:%M hrs");
        
        ajusta la hroa en 0-24*/


        $mes=["enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre"];


            echo "Fecha : <br> Hoy es ".date("l")." ".date("d")." de ".$mes[date("m")-1]." de ".date("y");
            echo "<br>";
            echo "Y son las ".date("h:i:sa");
        ?>
    </div>
</body>
</html>