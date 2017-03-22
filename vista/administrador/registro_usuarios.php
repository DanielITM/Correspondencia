<?php
  if (session_status() !== PHP_SESSION_ACTIVE){
    session_start();
  }
  if(!(isset($_SESSION['sesioncorresp']))){
    echo '<script>window.location="index.php";</script>';
  }
  else if($_SESSION['sesioncorresp'][1]!='t'){
    echo '<script>window.location="index.php";</script>';
  }
  include ("../../modelo/queries.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>Registrar Usuario | SiFinancia</title>  
  <link href="../css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link rel="stylesheet" type="text/css" href="../css/header.css">
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    //Disparador de activación para componente select
      $('select').material_select();
  });

    /*Función que manda los datos del formulario para su 
    inserción en la base de datos al dar click en boton 'Registrar'*/
    $('#btn_login').click(function(){
      //Variables a enviar a la base de datos
      var user = $('#text').val();
      var pass = $('#password').val();
      var pass2 = $('#password2').val();
      var tipouser;
      if(document.getElementById('tipo').checked)
        tipouser = true;
      else
        tipouser = false;
      var depto = $('#select-departamento').val();
      var url = "modelo/registra_usuario.php";
      if (pass!=pass2) {
        alert("Las contraseñas no coinciden.");
      }else{
        $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: {usuario: user, password: pass, password2: pass2, tipo:tipouser, departamento:depto}, 
           success: function(data)             
           {
              $('#resp').html(data);             
           }
       });
      }
    });
  </script>
  <script>

    function habilita_boton_registro(){
      document.getElementById("btn_login").disabled = false;
    }
  </script>
</head>
<body>
<center>
<br>
      <div class="container row">
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
        <div class="row"><h4>Registrar usuario</h4></div>
          <form class="col s12"  method="post" name="login" id="formulario" action="modelo/registra_usuario.php">
            <!-- Div para nombre de usuario y tipo de usuario-->
            <div class='row'>
              <div class='input-field col s6'>
              <i class="small material-icons left">perm_identity</i>
                <input class='validate' type="text" name='usuario' id='text' required="required" autofocus/>
                <label for='usuario'>Usuario</label>
              </div>
              <!-- Boton Toggle para administrador-->
              <div class='input-field col s6'>
                <div class="switch">
                  <label>Administrador
                  <input type="checkbox" name="tipo" id="tipo">
                  <span class="lever"></span>
                  </label>
                </div>
              </div>
            </div>
            <!-- Contenedor para campo contraseña y confirmacion de contraseña-->
            <div class='row'>
              <div class='input-field col s6'>
              <i class="small material-icons left">vpn_key</i>
                <input class='validate' type='password' name='password' id='password' required="required"/>
                <label for='password'>Contraseña</label>
              </div>
              <div class='input-field col s6'>
              <i class="small material-icons left">vpn_key</i>
                <input class='validate' type='password' name='password2' id='password2' required="required"/>
                <label for='password2'>Confirmar contraseña</label>
              </div>
            </div>
            <!-- Contenedor para listas de los departamentos-->
            <div class='row'>
              <div class="input-field col s12">
                <select name="select-departamento" id="select-departamento" onchange="habilita_boton_registro()">
                  <option disabled selected>Seleccionar departamento...</option>
                  <?php
                    $dependencias = new operaciones();
                    $dependencias-> obtiene_departamentos();
                  ?>
                </select>
                <label>Departamento</label>
              </div>
            </div>
            <br/>
            <center>
              <div class='row'>
              <center>
                <button type='button' id="btn_login" name='btn_login' class='col s3 btn btn-small waves-effect left' disabled>Registrar</button>
                <button type='reset' class='col s3 btn btn-small waves-effect red right'>Limpiar</button>
              </center>
              </div>              
            </center>
          </form>
        </div>
      </div>
      </center>
      <div id="resp"></div>
</body>
</html>