<?PHP
$hostname_localhost ="localhost";
$database_localhost ="inventario";
$username_localhost ="laura";
$password_localhost ="flor.123";



	if(isset($_GET["codigo_nfc"])){
		$codigo_nfc=$_GET["codigo_nfc"];
				
		$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

		$consulta="select name, codigo_nfc, serial, fecha_garantia, codigo_inventario, custodio, fecha_ingreso, ubicacion,fecha_ultimo_mantenimiento,fecha_compra, marca , procesador, estado, caracteristicas, tipo from products where codigo_nfc= '{$codigo_nfc}'";
		$resultado=mysqli_query($conexion,$consulta);
			
		if($registro=mysqli_fetch_array($resultado)){
			$json['products'][]=$registro;		
		}else{
			$resultar["codigo_nfc"]=0;
			$resultar["name"]='no registra';
			$json['products'][]=$resultar;
		}
		
		mysqli_close($conexion);
		echo json_encode($json);
	}
	else{
		$resultar["success"]=0;
		$resultar["message"]='Ws no Retorna';
		$json['products'][]=$resultar;
		echo json_encode($json);
	}
?>