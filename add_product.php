<?php
  $page_title = 'Añadir bien';
  require_once('includes/load.php');
  // Comprobar qué nivel de usuario tiene permiso para ver esta página
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_users=find_all('users');
?>
<?php
 if(isset($_POST['add_product'])){
   
   $req_fields = array('product-title','tipo','serial', 'codigo_inventario', 'custodio', 'ubicacion', 'fecha_ingreso', 'fecha_compra', 'fecha_ultimo_mantenimiento', 'fecha_garantia', 'marca','procesador' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['product-title']));
     $p_tipo   = remove_junk($db->escape($_POST['tipo']));
     //$p_nfc   = remove_junk($db->escape($_POST['codigo_nfc']));
     $p_ser   = remove_junk($db->escape($_POST['serial']));
     $p_cod   = remove_junk($db->escape($_POST['codigo_inventario']));
     $p_cus   = remove_junk($db->escape($_POST['custodio']));
     $p_ubi   = remove_junk($db->escape($_POST['ubicacion']));
     $p_ing   = remove_junk($db->escape($_POST['fecha_ingreso']));
     $p_com   = remove_junk($db->escape($_POST['fecha_compra']));
     $p_man   = remove_junk($db->escape($_POST['fecha_ultimo_mantenimiento']));
     $p_gar   = remove_junk($db->escape($_POST['fecha_garantia']));
     $p_mar   = remove_junk($db->escape($_POST['marca']));
     $p_pro   = remove_junk($db->escape($_POST['procesador']));
     
     $date    = make_date();
     $query  = "INSERT INTO products (";     
     $query .=" name,tipo,serial,codigo_inventario,custodio,ubicacion,fecha_ingreso,fecha_compra,fecha_ultimo_mantenimiento,fecha_garantia,marca,procesador";
     $query .=") VALUES (";
     $query .=" '{$p_name}', '{$p_tipo}',  '{$p_ser}', '{$p_cod}', '{$p_cus}', '{$p_ubi}','{$p_ing}','{$p_com}', '{$p_man}', '{$p_gar}', '{$p_mar}','{$p_pro}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Añadido");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' No se pudo agregar!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Añadir nuevo bien</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
            <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="Nombre">
               </div>
              </div>
             
              <div class="form-group">
               <div class="row row-cols-2">                
                  <!--<div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Código NFC</label>
                      <div class="input-group ">
                       <input type="number" class="form-control" name="codigo_nfc" placeholder="Código NFC" id="qty">                      
                      </div>
                    </div>
                  </div>-->

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Tipo de bien</label>
                      <div class="input-group ">
                       <input type="text" class="form-control" name="tipo" placeholder="Tipo de bien" id="qty">                      
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Serial</label>
                      <div class="input-group">                     
                        <input type="number" class="form-control" name="serial" placeholder="Número de serial">                      
                      </div>
                    </div>
                  </div>
                                        
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Código de Inventario</label>
                      <div class="input-group">                      
                        <input type="number" class="form-control" name="codigo_inventario" placeholder="Codigo de inventario">                      
                      </div>
                    </div>  
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Nombre del Custodio</label>
                      <div class="input-group">                      
                        <input type="text" class="form-control" name="custodio" placeholder="Nombre del custodio">                      
                      </div>          
                    </div>
                  </div>               
                   
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Ubicación</label>
                      <div class="input-group">
                          <input type="text" class="form-control" name="ubicacion" placeholder="Ubicación del bien">                      
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Fecha de ingreso</label>
                      <div class="input-group">
                        <input type="date" class="form-control" name="fecha_ingreso" placeholder="Fecha de ingreso">                      
                      </div>
                    </div>
                  </div>
                   
                
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Fecha de la compra</label>
                      <div class="input-group">                     
                        <input type="date" class="form-control" name="fecha_compra" placeholder="Fecha de la compra">                      
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Fecha del último mantenimiento</label>
                      <div class="input-group">                      
                        <input type="date" class="form-control" name="fecha_ultimo_mantenimiento" placeholder="Fecha del último mantenimiento">                      
                      </div>
                    </div>
                  </div>
                                   
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Fecha de la garantía</label>
                      <div class="input-group">                      
                        <input type="date" class="form-control" name="fecha_garantia" placeholder="Fecha de la garantía">                      
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Marca</label>
                      <div class="input-group">                      
                        <input type="text" class="form-control" name="marca" placeholder="Marca">                      
                      </div>
                    </div>
                  </div>
                   
                
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Procesador</label>
                      <div class="input-group">                      
                        <input type="text" class="form-control" name="procesador" placeholder="Procesador">                      
                      </div>
                    </div>
                  </div>
                </div>
               
              </div>
              <button type="submit" name="add_product" class="btn btn-danger">Añadir</button>
            </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
