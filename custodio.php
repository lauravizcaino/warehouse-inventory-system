<?php
  $page_title = 'Custodios';
  require_once('includes/load.php');
  // Comprobar qué nivel de usuario tiene permiso para ver esta página
   page_require_level(2);
   $custodios=join_custodios_table();
?>
<?php include_once('layouts/header.php'); ?>
<?php /*$name = find_custodio_by_name('custodios',(string)$_GET['nombre']);*/?>
<div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        
        <div class="panel-body"  style="overflow: scroll;">
         
          <table class="table table-bordered" id="tableproducts">
            <thead>
              <tr>
                <th class="text-center" style="width: 10%;">#</th>
                <th class="text-center" style="width: 10%;"> Nombre</th>                
                <th class="text-center" style="width: 10%;"> Código NFC </th>               
                <th class="text-center" style="width: 10%;"> Custodio </th>                          

              </tr>
            </thead>
            <tbody>
              <?php foreach ($custodios as $custodio):?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>                
                <td class="text-center"> <?php echo remove_junk($custodio['nombre']); ?></td>               
                <td class="text-center"> <?php echo remove_junk($custodio['codigoNFC']); ?></td>
                <td class="text-center"> <?php echo remove_junk($custodio['custodio']); ?></td>
                
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>