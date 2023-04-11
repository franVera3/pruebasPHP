<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Validar formulario</title>
	<style>
		body{
            background-color: #264673; 
            box-sizing:border-box; 
             font-family: Arial;
            }

		form{
			background-color: white;
			padding: 10px;
			margin: 100px auto;
			width: 400px;
		}

		input[type=text], input[type=password]{
			padding: 10px;
			width: 380px;
		}
		input[type="submit"]{
			border: 0;
			background-color: #ED8824;
			padding: 10px 20px;
		}

		.error{
			background-color: #FF9185;
			font-size: 12px;
			padding: 10px;
		}
		.correcto{
			background-color: #A0DEA7;
			font-size: 12px;
			padding: 10px;
		}
	</style>
</head>
<body>
	<form action="formulario.php" method="POST">
        
		<?php
/*------------------Datos a completar--------------------*/
			$nombre="";
			$password="";
			$email="";
			$pais="";
			$nivel="";
			$lenguajes=array();

			if(isset($_POST['nombre'])){
				$nombre = $_POST['nombre'];
				$password = $_POST['password'];
				$email = $_POST['email'];
				$pais=$_POST['pais'];
				
				/*Verifica si existe*/
				if(isset($_POST['nivel'])){
					$nivel=$_POST['nivel'];
				}else{
					$nivel="";
				}

				if(isset($_POST['lenguajes'])){
					$lenguajes=$_POST['lenguajes'];
				}else{
					$lenguajes=[];
				}
/*------------------Captura de campos vacios-------------*/
				$campos = array();


/*-------------------Verificacion de Datos---------------*/
				if($nombre == ""){
					array_push($campos, "El campo Nombre no pude estar vacío");
				}

				if($password == "" || strlen($password) < 6){
					array_push($campos, "El campo Password no puede estar vacío, ni tener menos de 6 caracteres.");
				}

				if($email == "" || strpos($email, "@") === false){
					array_push($campos, "Ingresa un correo electrónico válido.");
				}

				if($pais==""){
					array_push($campos, "Selecciona un pais");
				}
				if($nivel==""){
					array_push($campos, "Debe seleccionar un nivel");
				}

				if($lenguajes=="" || count($lenguajes)<2){
					array_push($campos, "Selecciona al menos 2 lenguajes");
				}
/*----------------Muestar de error-----------------------*/
				if(count($campos) > 0){
					echo "<div class='error'>";
					for($i = 0; $i < count($campos); $i++){
						echo "<li>".$campos[$i]."</i>";
					}
				}else{
					echo "<div class='correcto'>
							Datos correctos";
				}
				echo "</div>";
			}
		?>
		<p>
		Nombre:<br/>
		<input type="text" name="nombre" value="<?php echo $nombre;?>">
		</p>

		<p>
		Password:<br/>
		<input type="password" name="password" value="<?php echo $password;?>">
		</p>

		<p>
		correo electrónico:<br/>
		<input type="text" name="email" value="<?php echo $email;?>">
		</p>

		<!--los if dentro de las etiquetas de radio y option hacen que no se pierda la info cuadno se envia la info-->
		<p>
			Pais de origen: <br>
			<select name="pais" id="">
				<option value="">Selecciona un pais</option>
				<option value="ar" <?php if($pais=="ar")echo "selected"?>>Argentina</option>
				<option value="fr" <?php if($pais=="fr")echo "selected"?>>Francia</option>
				<option value="eu" <?php if($pais=="eu")echo "selected"?>>Estados Unidos</option>
				<option value="mx" <?php if($pais=="mx")echo "selected"?>>Mexico</option>
				<option value="ch" <?php if($pais=="ch")echo "selected"?>>Chile</option>
			</select>
		</p>

		<p>
			Nivel de Desarrollo: <br>
			<input type="radio" name="nivel" value="principiante" <?php if($nivel=="principiante") echo "checked"?>>Principiante
			<input type="radio" name="nivel" value="intermedio" <?php if($nivel=="intermedio") echo "checked"?>>Intermedio
			<input type="radio" name="nivel" value="avanzado" <?php if($nivel=="avanzado") echo "checked"?>>Avanzado
		</p>
<!--Verifica si algun elemento del arreglo se selecciono-->
		<p>
			Lengujaes de Programacion: <br>
			<input type="checkbox" name="lenguajes[]" value="php" <?php if(in_array("php",$lenguajes)) echo "checked"?>>PHP
			<br>
			<input type="checkbox" name="lenguajes[]" value="js" <?php if(in_array("js",$lenguajes))echo "checked"?>>JavaScript
			<br>
			<input type="checkbox" name="lenguajes[]" value="java" <?php if(in_array("java",$lenguajes))echo "checked"?>>Java
			<br>
			<input type="checkbox" name="lenguajes[]" value="swift" <?php if(in_array("swift",$lenguajes))echo "checked"?>>Swift
			<br>
			<input type="checkbox" name="lenguajes[]" value="py" <?php if(in_array("py",$lenguajes))echo "checked"?>>Python

		</p>

		<p><input type="submit" value="enviar datos"></p> 
	</form>
</body>
</html>