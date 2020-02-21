<?php
  $page_title = 'Home';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
 <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center">
         <h1>Sistema de Inventario</h1>
         <h2>Facultad de Ingeniería Eléctrica y Electrónica</h2>
         <h3>Laboratorio de Informática</h3>
         <img src="https://www.epn.edu.ec/wp-content/uploads/2014/05/EPN_logo-250x152.jpg" alt="Escudo EPN">
         <!--<p>Just browes around and find out what page you can access.</p>-->
      </div>
    </div>
 </div>
</div>
<?php include_once('layouts/footer.php'); ?>
