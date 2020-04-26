<?php
  $page_title = 'Administrador Home';
  require_once('includes/load.php');
  // Comprobar qué nivel de usuario tiene permiso para ver esta página
   page_require_level(1);
?>
<?php
 $c_product       = count_by_id('products');
 $c_user          = count_by_id('users');
 $recent_products = find_recent_product_added('5'); 
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
  <div class="row">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_user['total']; ?> </h2>
          <p class="text-muted">Usuarios</p>
        </div>
       </div>
    </div>
   
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_product['total']; ?> </h2>
          <p class="text-muted">Bienes</p>
        </div>
       </div>
    </div>
    
</div>
  <div class="row">
   <div class="col-md-12">
      <div class="panel">
        <div class="jumbotron text-center">
           <p> <strong>Sistema de Inventario</strong>

        </div>
      </div>
   </div>
  </div>
  <div class="row">
   
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Bienes añadidos recientemente</span>
        </strong>
      </div>
      <div class="panel-body">

        <div class="list-group">
      <?php foreach ($recent_products as  $recent_product): ?>
            <a class="list-group-item clearfix" href="edit_product.php?id=<?php echo    (int)$recent_product['id'];?>">
                <h4 class="list-group-item-heading">
                  <?php echo remove_junk(first_character($recent_product['name']));?>                  
                </h4>
                <span class="list-group-item-text pull-right">                
              </span>
          </a>
      <?php endforeach; ?>
    </div>
  </div>
 </div>
</div>
 </div>
  <div class="row">

  </div>



<?php include_once('layouts/footer.php'); ?>
