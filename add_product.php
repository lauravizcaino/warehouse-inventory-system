<?php
  $page_title = 'Añadir bien';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
  $all_users=find_all('users');
?>
<?php
 if(isset($_POST['add_product'])){
   /*$req_fields = array('product-title','product-categorie','product-quantity','buying-price', 'saleing-price' );*/
   $req_fields = array('product-title','product-categorie','codigo_nfc','serial', 'codigo_inventario', 'custodio', 'ubicacion', 'fecha_ingreso', 'fecha_compra', 'fecha_ultimo_mantenimiento', 'fecha_garantia', 'marca','procesador' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['product-title']));
     $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
     /*$p_qty   = remove_junk($db->escape($_POST['product-quantity']));
     $p_buy   = remove_junk($db->escape($_POST['buying-price']));
     $p_sale  = remove_junk($db->escape($_POST['saleing-price']));*/
     $p_nfc   = remove_junk($db->escape($_POST['codigo_nfc']));
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
     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }
     $date    = make_date();
     $query  = "INSERT INTO products (";
     /*$query .=" name,quantity,buy_price,sale_price,categorie_id,media_id,date";*/
     $query .=" name,categorie_id,codigo_nfc,serial,codigo_inventario,custodio,ubicacion,fecha_ingreso,fecha_compra,fecha_ultimo_mantenimiento,fecha_garantia,marca,procesador";
     $query .=") VALUES (";
     /*$query .=" '{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', '{$date}'";*/
     $query .=" '{$p_name}', '{$p_cat}', '{$p_nfc}', '{$p_ser}', '{$p_cod}', '{$p_cus}', '{$p_ubi}','{$p_ing}','{$p_com}', '{$p_man}', '{$p_gar}', '{$p_mar}','{$p_pro}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Product added ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
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
                  <input type="text" class="form-control" name="product-title" placeholder="Product Title">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="product-categorie">
                      <option value="">Select Product Category</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <!--<div class="col-md-6">
                    <select class="form-control" name="product-photo">
                      <option value="">Select Product Photo</option>
                    <?php  /*foreach ($all_photo as $photo): */?>
                      <option value="<?php /*echo (int)$photo['id'] */?>">
                        <?php /*echo $photo['file_name'] **/?></option>
                    <?php /*endforeach;*/ ?>
                    </select>
                  </div>-->
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <!--<div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="number" class="form-control" name="product-quantity" placeholder="Product Quantity">
                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="number" class="form-control" name="buying-price" placeholder="Buying Price">
                     <span class="input-group-addon">.00</span>
                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="saleing-price" placeholder="Selling Price">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>-->
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="number" class="form-control" name="codigo_nfc" placeholder="Código NFC">
                      <span class="input-group-addon"></span>
                    </div>
                  </div>
                   <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="number" class="form-control" name="serial" placeholder="Número de serial">
                      <span class="input-group-addon"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="number" class="form-control" name="codigo_inventario" placeholder="Codigo de inventario">
                      <span class="input-group-addon"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="text" class="form-control" name="custodiofgbfgb" placeholder="Nombre del custodio">
                      <span class="input-group-addon"></span>
                    </div>

                    
                    <select class="form-control" name="custodio">
                      <option value="">Select Product uuu</option>
                    <?php  foreach ($all_users as $user): ?>
                      <option value="<?php echo (int)$user['id'] ?>">
                        <?php echo $user['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                 




                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="text" class="form-control" name="ubicacion" placeholder="Ubicación del bien">
                      <span class="input-group-addon"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="date" class="form-control" name="fecha_ingreso" placeholder="Fecha de ingreso">
                      <span class="input-group-addon"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="date" class="form-control" name="fecha_compra" placeholder="Fecha de la compra">
                      <span class="input-group-addon"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="date" class="form-control" name="fecha_ultimo_mantenimiento" placeholder="Fecha del último mantenimiento">
                      <span class="input-group-addon"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="date" class="form-control" name="fecha_garantia" placeholder="Fecha de la garantía">
                      <span class="input-group-addon"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="text" class="form-control" name="marca" placeholder="Marca">
                      <span class="input-group-addon"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="text" class="form-control" name="procesador" placeholder="Procesador">
                      <span class="input-group-addon"></span>
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
