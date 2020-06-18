<?php
  $page_title = 'Inventario';
  require_once('includes/load.php');
  // Comprobar qué nivel de usuario tiene permiso para ver esta página
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
                <th class="text-center" style="width: 10%;"> Nombre</th>
                <th class="text-center" style="width: 10%;"> Tipo de bien </th>
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
                <th class="text-center" style="width: 10%;"> Estado </th>
                <th class="text-center" style="width: 10%;"> Características </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>               

              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                
                <td class="text-center"> <?php echo remove_junk($product['name']); ?></td>               
                <td class="text-center"> <?php echo remove_junk($product['tipo']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['codigo_nfc']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['serial']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['codigo_inventario']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['custodio']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['ubicacion']); ?></td>
                <td class="text-center"> <?php echo read_date($product['fecha_ingreso']); ?></td>
                <td class="text-center"> <?php echo read_date($product['fecha_compra']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['fecha_ultimo_mantenimiento']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['fecha_garantia']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['marca']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['procesador']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['estado']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['caracteristica']); ?></td>
                
                <td class="text-center">
                  <div class="btn-group">

                    <a href="edit_product.php?id=<?php  echo $product['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo $product['id'];?>" class="btn btn-danger btn-xs"  title="Borrar" data-toggle="tooltip">
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