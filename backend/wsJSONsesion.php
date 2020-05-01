<?PHP
    $hostname_localhost="localhost";
    $database_localhost="inventario";
    $username_localhost="root";
    $password_localhost="";

    $json=array();
        if (isset($_GET["username"]) && isset($_GET["password"])){
            $username=$_GET['username'];
            $password=$_GET['password'];

            $conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

            $consulta="SELECT username, password FROM users WHERE username= '{$username}' AND password='{$password}'";
            $resultado=mysqli_query($conexion,$consulta);

            if($consulta){

                if($reg=mysqli_fetch_array($resultado)){
                    $json['users'][]=$reg;
                    
                }
                mysqli_close($conexion);
                echo json_encode($json);
                
            }
            else{
                $results["username"]='';
                $results["password"]='';
                $json['users'][]=$results;
                echo json_encode($json);
            }
        }
        else {
            $results["username"]='';
            $results["password"]='';
            $json['users'][]=$results;
            echo json_encode($json);
        }

?>