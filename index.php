<?php 
  if(!isset($_GET['p'])){
    require_once ("cola.php");
  }else{
    require_once ("pila.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=, initial-scale=1.0" />
    <title>Compañia Ferroviaría</title>
    <link rel="stylesheet" href="css/cronometro.css" />
    <script src="js/jquery.min.js"></script>
    <script>
     
     $(document).ready(function(){

        $(document).keypress(function(e) {
          
          if(e.which == 99){

            <?php 
                if(!isset($_GET['p'])){
                  echo "window.location='index.php?vagon=cola';";
                }else{
                  echo "window.location='index.php?p=pila&vagon=pila';";
                }
            ?>
          }      
                          
        });   
            
      }); 

    </script>
  </head>
  <header>
    <h1>Control de Vagones</h1>
    <?php 
      if(isset($_GET['p'])){
        echo '<a id="link" href="index.php">Ir a la simulación de colas</a>';
      }else{
        echo '<a id="link" href="index.php?p=pila">Ir a la simulación de pilas</a>';
      }
    ?>
    
  </header>
  <body>
    <main>
      <section>
        <div id="cronometro">
          <h3>Días Transcurridos:</h3>
          <div id="reloj">
              <?php 
                if(!isset($_GET['p'])){
                  echo $_SESSION['contador2'];
                }else{
                  echo $_SESSION['cont2'];
                }
              ?>

            </div>
        </div>

        <div id="contador">

        <?php 
          if(!isset($_GET['p'])){
            echo "<h3>Vagones en cola</h3>";
          }else{
            echo "<h3>Vagones en pila</h3>";
          }
        ?>
          
          <div id="colavagones"><?php echo total();?></div>
        </div>

        <div id="numerodevagon">
          <h3>Número de vagon actual</h3>
          <div id="vagonactual"><?php echo vagon_actual();?></div>
        </div>

        <div id="pago">
          <h3>Total cobrado</h3>
          <div id="precio"><?php echo dinero();?>$</div>
        </div>
      
      </section>
    </main>
    <script>
    <?php
        if(!isset($_GET['p'])){
          echo 'function url(){window.location="index.php";}';
        }else{
          echo 'function url(){window.location="index.php?p=pila";}';
        }


        if(isset($_SESSION['inicio']) && !isset($_GET['p'])){
          $tiempo = ($_SESSION['expira']+1) - time();
          $tiempo = $tiempo * 1000;

          if(vagon_actual() != 0){
              echo "setTimeout('url()', ".$tiempo.");";
          }
        }

        if(isset($_SESSION['inicio_pila']) && isset($_GET['p'])){
          $tiempo = ($_SESSION['expira_pila']+1) - time();
          $tiempo = $tiempo * 1000;

          if(vagon_actual() != 0){

              echo "setTimeout('url()', ".$tiempo.");";

          }
        }
      ?>
    </script>
  </body>
</html>
