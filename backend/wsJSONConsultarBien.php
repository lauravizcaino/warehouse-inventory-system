<?PHP
$hostname_localhost ="localhost";
$database_localhost ="inventario";
$username_localhost ="root";
$password_localhost ="";

$json=array();

	if(isset($_GET["codigo_nfc"])){
		$codigo_nfc=$_GET["codigo_nfc"];
				
		$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

		$consulta="select name, codigo_nfc, serial, fecha_garantia, codigo_inventario, custodio, fecha_ingreso, ubicacion,fecha_ultimo_mantenimiento,fecha_compra, marca , procesador, estado, caracteristicas, tipo from products where codigo_nfc= '{$codigo_nfc}'";
		$resultado=mysqli_query($conexion,$consulta);
			
		if($registro=mysqli_fetch_array($resultado)){
			$json['products'][]=$registro;
		//	echo $registro['id'].' - '.$registro['nombre'].' - '.$registro['profesion'].'<br/>';
		}else{
			$resultar["documento"]=0;
			$resultar["nombre"]='no registra';
			$json['usuario'][]=$resultar;
		}
		
		mysqli_close($conexion);
		echo json_encode($json);
	}
	else{
		$resultar["success"]=0;
		$resultar["message"]='Ws no Retorna';
		$json['usuario'][]=$resultar;
		echo json_encode($json);
	}
?>