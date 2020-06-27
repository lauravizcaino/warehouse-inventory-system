<?php $user = current_user(); 
  include_once('includes/load.php')
?>
<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta http-equiv="content-type" content="text/plain; charset=UTF-8">
    <title><?php if (!empty($page_title))
           echo remove_junk($page_title);
            elseif(!empty($user))
           echo ucfirst($user['name']);
            else echo "Sistema de Inventario";?>
    </title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
  </head>
  <body>
  <?php  if ($session->isUserLoggedIn(true)): ?>
    <header id="header">
      <div class="logo pull-left"> Opciones
        <a href="home.php"></a>
        </div> 
            
        <div class="header-content ">
            <div class="header-date pull-left">
              <strong><?php $actual_date = date("d-m-Y");
              echo fechaCastellano($actual_date); ?></strong>
            </div>
          <div class="pull-right clearfix">
            <ul class="info-menu list-inline list-unstyled">
              <li class="profile">
                <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
                  <span><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
                </a>
                <ul class="dropdown-menu">
                  
                  <li>
                    <a href="edit_account.php" title="edit account">
                        <i class="glyphicon glyphicon-cog"></i>
                        Ajustes
                    </a>
                </li>
                <li class="last">
                    <a href="logout.php">
                        <i class="glyphicon glyphicon-off"></i>
                        Salir
                    </a>
                </li>
              </ul>
              </li>
            </ul>
        </div>
     </div>
    </header>
    <div class="sidebar">
      <?php if($user['user_level'] === '1'): ?>
        <!-- admin menu -->
      <?php include_once('admin_menu.php');?>

      <?php elseif($user['user_level'] === '2'): ?>
        <!-- Special user menu -->
      <?php include_once('special_menu.php');?>

      <?php endif;?>

   </div>
<?php endif;?>

<div class="page">
  <div class="container-fluid">
