<!DOCTYPE html>
<html>
<head>
  <title>Iniciar sesión | SiFinancia</title>
  <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <script src="js/jquery-3.0.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
  <script src="js/index.js"></script> 
</head>
<body>
  <main>
    <center>
      <img class="responsive-img" style="width: 250px;" src="img/logo.png" />
      <div class="section"></div>
      <h5 class="text-instruccion">Ingresar datos</h5>
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
                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect pink'>Ingresar</button>
              </div>
            </center>
          </form>
        </div>
      </div>
      <a href="usuarios/registro_usuarios.php" class="waves-effect waves-light btn">Registrar</a>
    </center>
    <div class="section"></div>
  </main>
    <?php  
    include('footer.php')
  ?>
</body>
</html>