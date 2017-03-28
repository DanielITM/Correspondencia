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

    $('#text').focusout( function(){
          if($('#text').val()!= ""){
            $.ajax({
              type: "POST",
              url: "modelo/validar_usuario.php",
              data: "nick="+$('#text').val(),
              beforeSend: function(){
                $('#msgUsuario').html('<img src="img/loading.gif" style="width: 25px; height: 25px;"/> verificando');
              },
              success: function(data){
                  $('#msgUsuario').html(data);
              }
            });
          }
        });
    /*Función que manda los datos del formulario para su 
    inserción en la base de datos al dar click en boton 'Registrar'*/
    $('#btn_login').click(function(){
      //Variables a enviar a la base de datos (se obtienen datos del formulario)
      var user = $('#text').val();
      var pass = $('#password').val();
      var pass2 = $('#password2').val();
      var depto = $('#select-departamento').val();
      var nom = $('#nom-cop').val();
      var url = "modelo/registra_usuario.php";
      var tipouser;
      if(document.getElementById('tipo').checked)//Si eligió tipo administrador entra a if
        tipouser = true;
      else//Será usuario general
        tipouser = false;
      if (pass!=pass2) {//Compara las contraseñas ingresadas, si son diferentes muestra una alerta
        alert("Las contraseñas no coinciden.");
        /*Si las contraseñas si coinciden, se mandan al archivo 'modelo/registra_usuario'
        para ser procesados por PHP e ingresarlos a la BD
        */
      }else{
        /* Mediante AJAX, se envian los datos*/
        $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: {usuario: user, password: pass, password2: pass2, tipo:tipouser, departamento:depto, nombre: nom}, 
           success: function(data)             
           {
            /*En case de haber un error en la inserción. 
            En la parte inferior de la pagina se muestra una alerta*/
              $('#resp').html(data);             
           }
       });
      }
    });
  </script>
  <script>

  //Función que habilita el botón de registro al seleccionar un departamento del combobox
    function habilita_boton_registro(){
      document.getElementById("btn_login").disabled = false;
    }
  </script>
</head>
<body>
<center>
<br>
      <div class="container row">
        <div class="z-depth-1 grey lighten-4 row" id="contenedor-formulario" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
        <div class="row"><h4>Registrar usuario</h4></div>
          <form class="col s12"  method="post" name="login" id="formulario" action="modelo/registra_usuario.php">
            <!-- Div para nombre de usuario y tipo de usuario-->
            <div class='row'>
              <div class='input-field col s6'>
              <i class="small material-icons left">perm_identity</i>
                <input class='validate' type="text" name='usuario' id='text' required="required" autofocus/>
                <label for='usuario'>Usuario</label>
                 <div id="msgUsuario"></div>
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
                <select name="select-departamento" id="select-departamento">
                  <option disabled selected>Seleccionar departamento...</option>
                  <!-- PHP que llena el combobox de los departamentos -->
                  <?php
                    $dependencias = new operaciones();
                    $dependencias-> obtiene_departamentos();
                  ?>
                </select>
                <label>Departamento</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input type="text" name="nom-cop" id="nom-cop" required="required" onchange="habilita_boton_registro()">
                <label for='nom-cop'>Nombre completo</label>
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
      <!--Contenedor para mostrar mensajes de error-->
      <div id="resp"></div>
</body>
</html>