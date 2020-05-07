<?php
  $page_title = 'Editar';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$product = find_by_id('products',(int)$_GET['id']);
$all_categories = find_all('categories');

if(!$product){
  $session->msg("d","Falta la identificación del produto");
  redirect('product.php');
}
?>
<?php
 if(isset($_POST['product'])){
    $req_fields = array('product-title','tipo','serial', 'codigo_inventario', 'custodio', 'ubicacion', 'fecha_ingreso', 'fecha_compra', 'fecha_ultimo_mantenimiento', 'fecha_garantia', 'marca','procesador','estado','caracteristica' );
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
       $p_est   = remove_junk($db->escape($_POST['estado']));
       $p_car   = remove_junk($db->escape($_POST['caracteristica']));

       $query   = "UPDATE products SET";     
       $query   .= " name ='{$p_name}', tipo ='{$p_tipo}',serial='{$p_ser}', codigo_inventario='{$p_cod}', custodio='{$p_cus}', ubicacion='{$p_ubi}', fecha_ingreso='{$p_ing}', fecha_compra='{$p_com}', fecha_ultimo_mantenimiento='{$p_man}', fecha_garantia='{$p_gar}', marca='{$p_mar}', procesador='{$p_pro}',estado='{$p_est}',caracteristica='{$p_car}'";
       $query  .=" WHERE id ='{$product['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Producto actualizado");
                 redirect('product.php', false);
               } else {
                 $session->msg('d',' No se pudo actualizar!');
                 redirect('edit_product.php?id='.$product['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_product.php?id='.$product['id'], false);
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
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Editar</span>            
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" value="<?php echo remove_junk($product['name']);?>">
               </div>
              </div>
            
              <div class="form-group">
               <div class="row row-cols-2">
                 <!--<div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Código NFC</label>
                      <div class="input-group">
                        <input type="number" class="form-control" name="codigo_nfc" value="<?/*php echo remove_junk($product['codigo_nfc']); */?>">
                      </div>
                    </div>
                 </div>-->
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Tipo de bien</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="tipo" value="<?php echo remove_junk($product['tipo']); ?>">
                      </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Serial</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="serial" value="<?php echo remove_junk($product['serial']); ?>">
                      </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Código de Inventario</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="codigo_inventario" value="<?php echo remove_junk($product['codigo_inventario']); ?>">
                      </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Nombre del Custodio</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="custodio" value="<?php echo remove_junk($product['custodio']); ?>">
                      </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Fecha de ingreso</label>
                      <div class="input-group">
                        <input type="date" class="form-control" name="fecha_ingreso" value="<?php echo remove_junk($product['fecha_ingreso']); ?>">
                      </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Fecha de la compra</label>
                      <div class="input-group">
                        <input type="date" class="form-control" name="fecha_compra" value="<?php echo remove_junk($product['fecha_compra']); ?>">
                      </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Ubicación</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="ubicacion" value="<?php echo remove_junk($product['ubicacion']); ?>">
                      </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Fecha del último mantenimiento</label>
                      <div class="input-group">
                        <input type="date" class="form-control" name="fecha_ultimo_mantenimiento" value="<?php echo remove_junk($product['fecha_ultimo_mantenimiento']); ?>">
                      </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Fecha de la garantía</label>
                      <div class="input-group">
                        <input type="date" class="form-control" name="fecha_garantia" value="<?php echo remove_junk($product['fecha_garantia']); ?>">
                      </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Marca</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="marca" value="<?php echo remove_junk($product['marca']); ?>">
                      </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Procesador</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="procesador" value="<?php echo remove_junk($product['procesador']); ?>">
                      </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Estado</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="estado" value="<?php echo remove_junk($product['estado']); ?>">
                      </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Características</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="caracteristica" value="<?php echo remove_junk($product['caracteristica']); ?>">
                      </div>
                    </div>
                 </div>
                </div>
              </div>
              <button type="submit" name="product" class="btn btn-danger">Actualizar</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
