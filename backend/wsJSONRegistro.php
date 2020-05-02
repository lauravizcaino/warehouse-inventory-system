<?PHP

	$hostname_localhost="localhost";
	$database_localhost="inventario";
	$username_localhost="laura";
	$password_localhost="flor.123";

	$json=array();

		if(isset($_GET["name"]) && isset($_GET["codigo_nfc"]) && isset($_GET["serial"]) && isset($_GET["fecha_garantia"]) && isset($_GET["codigo_inventario"]) && isset($_GET["custodio"]) && isset($_GET["fecha_ingreso"]) && isset($_GET["ubicacion"]) && isset($_GET["fecha_ultimo_mantenimiento"]) && isset($_GET["fecha_compra"]) && isset($_GET["marca"]) && isset($_GET["procesador"]) && isset($_GET["estado"]) && isset($_GET["caracteristicas"]) && isset($_GET["tipo"])){ 
	
			$name=$_GET['name'];
			$codigo_nfc=$_GET['codigo_nfc'];
			$serial=$_GET['serial'];
			$fecha_garantia=$_GET['fecha_garantia'];
			$codigo_inventario=$_GET['codigo_inventario'];
			$custodio=$_GET['custodio'];
			$fecha_ingreso=$_GET['fecha_ingreso'];
			$ubicacion=$_GET['ubicacion'];
			$fecha_ultimo_mantenimiento=$_GET['fecha_ultimo_mantenimiento'];
			$fecha_compra=$_GET['fecha_compra'];
			$marca=$_GET['marca'];
			$procesador=$_GET['procesador'];
			$estado=$_GET['estado'];
			$caracteristica=$_GET['caracteristica'];
			$tipo=$_GET['tipo'];			

			$conexion=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
			
			$insert="INSERT INTO products(name, codigo_nfc, serial, fecha_garantia, codigo_inventario, custodio, fecha_ingreso, ubicacion,fecha_ultimo_mantenimiento,fecha_compra, marca , procesador, estado, caracteristica,tipo) VALUES ('{$name}',{$codigo_nfc},'{$serial}','{$fecha_garantia}','{$codigo_inventario}','{$custodio}','{$fecha_ingreso}','{$ubicacion}','{$fecha_ultimo_mantenimiento}','{$fecha_compra}','{$marca}','{$procesador}','{$estado}','{$caracteristica}','{$tipo}') ON DUPLICATE KEY UPDATE codigo_nfc={$codigo_nfc}";
	
			if($conexion->query($insert)===TRUE){
			
				$resultado = $conexion->query("SELECT * FROM products WHERE codigo_nfc = {$codigo_nfc}");
				
				if($registro=mysqli_fetch_array($resultado)){
					$json['products'][]=$registro;
				}
				mysqli_close($conexion);
				echo json_encode($json);
			}
			else{
				echo "El error es : ".mysqli_error($conexion);
				$resulta["codigo_nfc"]=0;
				$resulta["name"]='No Registra';		
				$json['products'][]=$resulta;
				echo json_encode($json);
			}
			
		}
		else{
				$resulta["codigo_nfc"]=0;
				$resulta["name"]='Servidor no devuelve';				
				$json['products'][]=$resulta;
				echo json_encode($json);
			}

?>

