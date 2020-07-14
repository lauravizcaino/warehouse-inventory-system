<?PHP
$hostname_localhost ="localhost";
$database_localhost ="inventario";
$username_localhost ="laura";
$password_localhost ="flor.123";

$json=array();

	if(isset($_GET["nombre"])){
		$nombre=$_GET["nombre"];
				
		$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

		$consulta="SELECT custodio FROM custodios WHERE nombre like '%$nombre%'";
        $resultado=mysqli_query($conexion,$consulta);

        while($registro=mysqli_fetch_array($resultado)){
			$json['products'][]=$registro;
		}
			
		/*if($registro=mysqli_fetch_array($resultado)){
			$json['custodios'][]=$registro;		
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
	}*/
?>