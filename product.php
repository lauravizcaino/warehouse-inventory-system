<?php
  $page_title = 'Inventario';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">Añadir nuevo</a>
         </div>
        </div>
        <div class="panel-body"  style="overflow: scroll;">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <!--<th> Photo</th>-->
                <th> Product Title </th>
                <th class="text-center" style="width: 10%;"> Categorie </th>
                <!--<th class="text-center" style="width: 10%;"> Instock </th>
                <th class="text-center" style="width: 10%;"> Buying Price </th>
                <th class="text-center" style="width: 10%;"> Saleing Price </th>
                <th class="text-center" style="width: 10%;"> Product Added </th>-->
                <th class="text-center" style="width: 10%;"> Código NFC </th>
                <th class="text-center" style="width: 10%;"> Serial </th>
                <th class="text-center" style="width: 10%;"> Código Inventario </th>
                <th class="text-center" style="width: 10%;"> Custodio </th>
                <th class="text-center" style="width: 10%;"> Ubicación </th>
                <th class="text-center" style="width: 10%;"> Fecha de ingreso </th>
                <th class="text-center" style="width: 10%;"> Fecha de la compra </th>
                <th class="text-center" style="width: 10%;"> Fecha de último mantenimiento </th>
                <th class="text-center" style="width: 10%;"> Fecha de garantía </th>
                <th class="text-center" style="width: 10%;"> Marca </th>
                <th class="text-center" style="width: 10%;"> Procesador </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
                

              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <!--<td>
                  <?php /*if($product['media_id'] === '0'): */?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php /*else:*/ ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php /*echo $product['image']; */?>" alt="">
                <?php /*endif; */?>
                </td>-->
                <td> <?php echo remove_junk($product['name']); ?></td>
                
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <!--<td class="text-center"> <?php /*echo remove_junk($product['quantity']);*/ ?></td>
                <td class="text-center"> <?php /*echo remove_junk($product['buy_price']); */?></td>
                <td class="text-center"> <?php /*echo remove_junk($product['sale_price']);*/ ?></td>
                <td class="text-center"> <?php /*echo read_date($product['date']); */?></td>
                -->
                <td class="text-center"> <?php echo remove_junk($product['codigo_nfc']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['serial']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['codigo_inventario']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['custodio']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['ubicacion']); ?></td>
                <td class="text-center"> <?php echo read_date($product['fecha_ingreso']); ?></td>
                <td class="text-center"> <?php echo read_date($product['fecha_compra']); ?></td>
                <td class="text-center"> <?php echo read_date($product['fecha_ultimo_mantenimiento']); ?></td>
                <td class="text-center"> <?php echo read_date($product['fecha_grantia']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['marca']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['procesador']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
