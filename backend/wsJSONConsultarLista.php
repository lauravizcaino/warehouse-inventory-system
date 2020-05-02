<?PHP

$hostname_localhost ="localhost";
$database_localhost ="inventario";
$username_localhost ="laura";
$password_localhost ="flor.123";

$json=array();
				
		$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

		$consulta="select name, codigo_nfc, serial, fecha_garantia, codigo_inventario, custodio, fecha_ingreso, ubicacion,fecha_ultimo_mantenimiento,fecha_compra, marca , procesador, estado, caracteristica,tipo FROM products";
		$resultado=mysqli_query($conexion,$consulta);
		
		while($registro=mysqli_fetch_array($resultado)){
			$json['products'][]=$registro;
		}
		mysqli_close($conexion);
<<<<<<< HEAD
		echo json_encode($json,JSON_UNESCAPED_UNICODE);
=======

		echo json_encode($json/*,JSON_UNESCAPED_UNICODE*/);
>>>>>>> f6f20e72ba97e2c1b0ebd36b5ad1b73e0ce1ea8d
		//echo ($json);
?>

