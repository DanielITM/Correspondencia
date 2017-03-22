<?php
  if (session_status() !== PHP_SESSION_ACTIVE){
    session_start();
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Iniciar sesión | SiFinancia</title>
  <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <script src="js/jquery-3.0.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
  <script src="js/index.js"></script> 
</head>
<body>
<?php  
    include('header.php')
?>
  <main>
    <center>
      <img class="responsive-img" style="width: 190px; height: 150px; padding-top: 0.5cm;" src="img/logo_si_financia.png" />
      <h5>Bienvenido<br><br>Iniciar sesión</h5>
      <div class="container">
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
          <form class="col s12" method="post" name="login" action="valida_acceso.php">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
              <i class="small material-icons left">perm_identity</i>
                <input class='validate' type="text" name='email' id='email' required="required"/>
                <label for='email'>Usuario</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
              <i class="small material-icons left">vpn_key</i>
                <input class='validate' type='password' name='password' id='password' required="required"/>
                <label for='password'>Contraseña</label>
              </div>
            </div>
            <br/>
            <center>
              <div class='row'>
                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect' style="background-color: #29BDBE">Ingresar</button>
              </div>
            </center>
          </form>
        </div>
        <div class='row'>
          <div>
            <b>
              Avenida Lázaro Cárdenas #866<br>Colonia Ventura Puente C.P. 58020<br>Morelia, Michoacán.
            </b>
          </div>
        </div>
      </div>
    </center>
    <div class="section"></div>
  </main>
    <?php  
    include('footer.php')
  ?>
</body>
</html>