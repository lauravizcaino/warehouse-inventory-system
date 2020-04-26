<?php
  $page_title = 'Añadir grupo';
  require_once('includes/load.php');
  // Comprobar qué nivel de usuario tiene permiso para ver esta página
   page_require_level(1);
?>
<?php
  if(isset($_POST['add'])){

   $req_fields = array('group-name','group-level');
   validate_fields($req_fields);  // Comprobar qué nivel de usuario tiene permiso para ver esta página


   if(find_by_groupName($_POST['group-name']) === false ){
     $session->msg('d','El nombre del grupo ingresado ya está en la base de datos!');
     redirect('add_group.php', false);
   }elseif(find_by_groupLevel($_POST['group-level']) === false) {
     $session->msg('d','El nivel del grupo ingresado ya está en la base de datos!');
     redirect('add_group.php', false);
   }
   if(empty($errors)){
           $name = remove_junk($db->escape($_POST['group-name']));
          $level = remove_junk($db->escape($_POST['group-level']));
         $status = remove_junk($db->escape($_POST['status']));

        $query  = "INSERT INTO user_groups (";
        $query .="group_name,group_level,group_status";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$level}','{$status}'";
        $query .=")";
        if($db->query($query)){          
          $session->msg('s',"El grupo ha sido creado ");
          redirect('add_group.php', false);
        } else {         
          $session->msg('d',' No se pudo crear el grupo.');
          redirect('add_group.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_group.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
    <div class="text-center">
       <h3>Añadir nuevo grupo</h3>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="add_group.php" class="clearfix">
        <div class="form-group">
              <label for="name" class="control-label">Nombre de grupo</label>
              <input type="name" class="form-control" name="group-name">
        </div>
        <div class="form-group">
              <label for="level" class="control-label">Nivel</label>
              <input type="number" class="form-control" name="group-level">
        </div>
        <div class="form-group">
          <label for="status">Estado</label>
            <select class="form-control" name="status">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
        </div>
        <div class="form-group clearfix">
                <button type="submit" name="add" class="btn btn-info">Actualizar</button>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>
