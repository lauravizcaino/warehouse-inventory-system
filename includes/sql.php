<?php
  require_once('includes/load.php');

/*--------------------------------------------------------------*/
/* Función para buscar todas las filas de las tabla de la base de datos por el nombre de la tabla
/*--------------------------------------------------------------*/
function find_all($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table));
   }
}
/*--------------------------------------------------------------*/
/* Función para realizar consultas
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}
/*--------------------------------------------------------------*/
/* Función para buscar información de una tabla por su id
/*--------------------------------------------------------------*/
function find_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
/* Función para buscar información de una tabla por su nombre
/*--------------------------------------------------------------*/

/*function find_custodio_by_name($custodio){
     global $db;
     $p_name = remove_junk($db->escape($custodio));
     $sql = "SELECT custodio FROM custodios WHERE nombre like '%$p_name%'";
     $result = find_by_sql($sql);
     return $result;
   }
}*/
/*--------------------------------------------------------------*/
/* Función para borrar información de una tabla por id
/*--------------------------------------------------------------*/
function delete_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
/*--------------------------------------------------------------*/
/* Función para contar id por el nombre de la tabla
/*--------------------------------------------------------------*/

function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determinar si la tabla existe
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }
 /*--------------------------------------------------------------*/
 /* Iniciar sesión con los datos proporcionados en $ _POST,
 /* provenientes del formulario de inicio de sesión.
/*--------------------------------------------------------------*/
  function authenticate($username='', $password='') {
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = sha1($password);
      if($password_request === $user['password'] ){
        return $user['id'];
      }
    }
   return false;
  }
  /*--------------------------------------------------------------*/
  /* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
 /*--------------------------------------------------------------*/
   function authenticate_v2($username='', $password='') {
     global $db;
     $username = $db->escape($username);
     $password = $db->escape($password);
     $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
     $result = $db->query($sql);
     if($db->num_rows($result)){
       $user = $db->fetch_assoc($result);
       $password_request = sha1($password);
       if($password_request === $user['password'] ){
         return $user;
       }
     }
    return false;
   }


  /*--------------------------------------------------------------*/
  /*Encuentra el registro actual en user por id de session
  /*--------------------------------------------------------------*/
  function current_user(){
      static $current_user;
      global $db;
      if(!$current_user){
         if(isset($_SESSION['user_id'])):
             $user_id = intval($_SESSION['user_id']);
             $current_user = find_by_id('users',$user_id);
        endif;
      }
    return $current_user;
  }
  /*--------------------------------------------------------------*/
  /* Buscar todos los usuarios 
  /* uniendo la tabla de usuarios y la tabla de grupos de usuarios
  /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,";
      $sql .="g.group_name ";
      $sql .="FROM users u ";
      $sql .="LEFT JOIN user_groups g ";
      $sql .="ON g.group_level=u.user_level ORDER BY u.name ASC";
      $result = find_by_sql($sql);
      return $result;
  }
  /*--------------------------------------------------------------*/
  /* Function to update the last log in of a user
  /*--------------------------------------------------------------*/

 function updateLastLogIn($user_id)
	{
		global $db;
    $date = make_date();
    $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
	}

  /*--------------------------------------------------------------*/
  /* Encontrar todos los nombres del grupo
  /*--------------------------------------------------------------*/
  function find_by_groupName($val)
  {
    global $db;
    $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Encontar el nivel de grupo
  /*--------------------------------------------------------------*/
  function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Función para verificar qué nivel de usuario tiene acceso a la página
  /*--------------------------------------------------------------*/
   function page_require_level($require_level){
     global $session;
     $current_user = current_user();
     $login_level = find_by_groupLevel($current_user['user_level']);
     //Si el usuario no está logeado
     if (!$session->isUserLoggedIn(true)):
            $session->msg('d','Por favor ingrese...');
            redirect('index.php', false);
      //Si el estado es inactivo
     elseif($login_level['group_status'] === '0'):
           $session->msg('d','¡Este nivel de usuario ha sido prohibido!!');
           redirect('home.php',false);
      //cheackin log in User level and Require level is Less than or equal to
     elseif($current_user['user_level'] <= (int)$require_level):
              return true;
      else:
            $session->msg("d", "No tiene permiso para mirar esta página");
            redirect('home.php', false);
        endif;

     }
   /*--------------------------------------------------------------*/
   /* Función para encontrar todos los nombres de la tabla products
   /*--------------------------------------------------------------*/
  function join_product_table(){
     global $db;
     $sql  =" SELECT p.`id`,
     p.`name`,    
     p.`date`,
     p.`codigo_nfc`,
     p.`serial`,
     p.`codigo_inventario`,
     p.`custodio`,
     p.`fecha_ingreso`,
     p.`fecha_compra`,
     p.`ubicacion`,
     p.`fecha_ultimo_mantenimiento`,
     p.`fecha_garantia`,
     p.`marca`,
     p.`procesador`,
     p.`estado`,
     p.`caracteristica`,
     p.`tipo`,
     p.`estado`,
     p.`caracteristica`";
    
    $sql  .=" FROM products p";   
    $sql  .=" ORDER BY p.id ASC";
    return find_by_sql($sql);

   }

   /*--------------------------------------------------------------*/
   /* Función para encontrar todos los nombres de la tabla custodios
   /*--------------------------------------------------------------*/
  function join_custodios_table(){
     global $db;
     /*$sql  =" SELECT c.`id`,
     c.`nombre`,    
     c.`codigoNFC`,
     c.`custodio`";*/
     //$p_name = remove_junk($db->escape($product_name));
     $sql = "SELECT nombre, custodio FROM custodios WHERE nombre like '%$p_name%'";
    
    //$sql  .=" FROM custodios c";   
    //$sql  .=" ORDER BY c.id ASC";
    return find_by_sql($sql);

   }
  /*--------------------------------------------------------------*/
  /* Función para encontrar tdos los nombres de productos
  /*  Solicitud proveniente de ajax.php para sugerencia automática
  /*--------------------------------------------------------------*/

   function find_product_by_title($product_name){
     global $db;
     $p_name = remove_junk($db->escape($product_name));
     $sql = "SELECT name FROM products WHERE name like '%$p_name%' LIMIT 5";
     $result = find_by_sql($sql);
     return $result;
   }

  /*--------------------------------------------------------------*/
  /* Función para encontrar toda la información de los productos por su nombre
  /* Solicitud proveniente de ajax.php
  /*--------------------------------------------------------------*/
  function find_all_product_info_by_title($title){
    global $db;
    $sql  = "SELECT * FROM products ";
    $sql .= " WHERE name ='{$title}'";
    $sql .=" LIMIT 1";
    return find_by_sql($sql);
  }

  
  /*--------------------------------------------------------------*/
  /* Función para mostrar añadidos recientemente
  /*--------------------------------------------------------------*/
 function find_recent_product_added($limit){
   global $db;   
   $sql   = " SELECT p.`id`,p.`name`";
   $sql  .= "FROM products p";
   $sql  .= " ORDER BY p.id DESC LIMIT ".$db->escape((int)$limit);
   return find_by_sql($sql);
 }

?>
