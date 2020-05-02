<?PHP
default_charset = "utf-8"
$hostname_localhost ="localhost";
$database_localhost ="inventario";
$username_localhost ="laura";
$password_localhost ="flor.123";

$json=array();
				
		$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

		$consulta="select name, codigo_nfc, serial, fecha_garantia, codigo_inventario, custodio, fecha_ingreso, ubicacion,fecha_ultimo_mantenimiento,fecha_compra, marca , procesador, estado, caracteristicas,tipo FROM products";
		$resultado=mysqli_query($conexion,$consulta);
		
		while($registro=mysqli_fetch_array($resultado)){
			$json['products'][]=$registro;
		}
		mysqli_close($conexion);
		echo json_encode($json);
?>

