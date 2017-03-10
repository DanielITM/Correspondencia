<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Registrar Usuario | SiFinancia</title>  
  <link href="../css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <script type="text/javascript" src="../js/materialize.min.js"></script>
</head>
<body>
<center>
      <div class="container row">
      <h4>Registrar usuario</h4>
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
          <form class="col s12" method="post" name="login" action="valida_acceso.php">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s6'>
              <i class="small material-icons left">perm_identity</i>
                <input class='validate' type="text" name='usuario' id='text' required="required"/>
                <label for='usuario'>Usuario</label>
              </div>
              <div class='input-field col s6'>
              <!-- Boton Toggle para administrador-->
                <div class="switch">
                  <label>Administrador
                  <input type="checkbox">
                  <span class="lever"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
              <i class="small material-icons left">vpn_key</i>
                <input class='validate' type='password' name='password' id='password' required="required"/>
                <label for='password'>Contraseña</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
              <i class="small material-icons left">vpn_key</i>
                <input class='validate' type='password' name='password2' id='password' required="required"/>
                <label for='password2'>Confirmar contraseña</label>
              </div>
            </div>
            <br/>
            <center>
              <div class='row'>
                <button type='submit' name='btn_login' class='col s5 btn btn-large waves-effect pink left'>Registrar</button>
                &nbsp;
                <a href="../index.php" class="col s5 btn btn-large waves-effect red btn right">Volver</a>
              </div>              
            </center>
          </form>
        </div>
      </div>
      </center>
<?php  
  include('../footer.php')
?>
</body>
</html>