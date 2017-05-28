<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once('layout/library.php'); ?>
  <title> PACHANGA </title>
  <link rel="stylesheet" href="assets/css/inicio.css">
  <link rel="stylesheet" href="assets/css/datosPartido.css">
</head>

<body>
  <header>
    <?php require_once('layout/header.php'); ?>
  </header>


  <div class="container  profile-container">
    <div class="row profile">
      <div class="hidden-xs hidden-sm col-md-3">
        <?php include('layout/menu.php'); ?>
      </div>
      <div class = "col-xs-12 col-sm-12 col-md-9">
        <div class="profile-content">

          <div class="container-fluid">
            <div class="centrar">
              <p class="size_title">Detalles partido: <?php echo $partidoobj[0]->getNombre(); ?></p>
            </div>
            <div class=" row margen_top_title">
              <div class="col-md-4">
                <div class="col-xs-6 col-md-6 cuadro_naranja">Zona</div>
                <div class="col-xs-6 col-md-6 cuadro_negro"><?php echo $poli[0]->getDistrito(); ?></div>
              </div>
              <div class="col-md-4">
                <div class="col-xs-6 col-md-6 cuadro_naranja">Fecha</div>
                <div class="col-xs-6 col-md-6 cuadro_negro"><?php echo $partidoobj[0]->getFecha(); ?></div>
              </div>
              <div class="col-md-4">
                <div class="col-xs-6 col-md-6 cuadro_naranja">Creador</div>
                <div class="col-xs-6 col-md-6 cuadro_negro"><?php echo $partidoobj[0]->getCreador(); ?></div>
              </div>
            </div>
            <table class="table table-condensed margen_top_title">
              <thead>
                <tr>
                  <th>Equipo 1</th>
                  <th>Equipo 2</th>
                </tr>
              </thead>
              <tbody>
                <?php
                for ($x = 0; $x < 7; $x++) {
                  echo "<tr>";
                  if($x < sizeof($equipo1)){
                    echo "<td>";
                    echo $equipo1[$x]->getUsuario();
                    echo "</td>";
                  }
                  else{
                    echo "<td> - </td>";
                  }
                  if($x < sizeof($equipo2)){
                    echo "<td>";
                    echo $equipo2[$x]->getUsuario();
                    echo "</td>";
                  }
                  else{
                    echo "<td> - </td>";
                  }
                  echo "</tr>";
                }
                 ?>
              </tbody>
            </table>

            <div class="container-fluid margen_top_title">
              <form class="" action="<?php echo $helper->url('participantes', 'insertParticipante'); ?>" method="post">
                <input name="partido" value="<?php echo $partidoobj[0]->getId(); ?>"  type="text" required hidden>
                <input name="usuario" value="<?php echo $_SESSION['username']; ?>"  type="text" required hidden>
                <input name="equipo" value="1" type="text" required hidden>
                <div class="col-xs-6 col-md-6"><button type="submit" class="btn btn-warning back-orange flota-derecha"> Jugar equipo 1 </button></div>
              </form>
              <form class="" action="<?php echo $helper->url('participantes', 'insertParticipante'); ?>" method="post">
                <input name="partido" value="<?php echo $partidoobj[0]->getId(); ?>"  type="text" required hidden>
                <input name="usuario" value="<?php echo $_SESSION['username']; ?>"  type="text" required hidden>
                <input name="equipo" value="2" type="text" required hidden>
                <div class="col-xs-6 col-md-6"><button type="submit" class="btn btn-warning back-orange"> Jugar equipo 2 </button></div>
              </form>
              <!-- <div class="col-xs-6 col-md-6"><a href="#" class="btn btn-warning back-orange mouse-over" onclick="changeCompartir('compartir')" role="button">Compartir</a></div> -->
            </div>
            <div class="map-responsive margen_top_title">
              <iframe src="<?php echo $poli[0]->getUrl(); ?>"
                width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>



  <?php require_once('layout/footer.php'); ?>
  <?php require_once('layout/script.php'); ?>
</body>

</html>
