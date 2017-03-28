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
  <script type="text/javascript" src="js/materialize.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      //Disparador de activación para componente select
        $('select').material_select();
        $('textarea#observaciones').characterCounter();
    });

      $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 20 // Creates a dropdown of 15 years to control year
      });
  </script>
</head>
<body>
<center>
<br>
      <div class="container row">
        <div class="z-depth-1 grey lighten-4 row" id="contenedor-formulario" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
          <form class="col s12"  method="post" name="login" id="formulario" action="modelo/registra_usuario.php">
            <!-- Contenedor para folio, no. de oficio y dependencia-->
            <div class='row'>
            <h4>Datos externos</h4>
            <hr>
              <div class='input-field col s3'>
                <input  type="text" name='folio' id='folio' disabled/>
                <label for='usuario'>Folio</label>
              </div>
            <!-- Contenedor para campo contraseña y confirmacion de contraseña-->   
              <div class='input-field col s3'>
                <input type='text' name='oficio' id='oficio' required="required"/>
                <label for='password'>No. de Oficio</label>
              </div>
              <div class='input-field col s6'>
                <input class='validate' type='password' name='password2' id='password2' required="required"/>
                <label for='password2'>Dependencia</label>
              </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <input  type="text" name='nombre' id='nombre'/>
                  <label for='nombre'>Nombre</label>
                </div>
                <div class="input-field col s6">
                  <input  type="text" name='cargo' id='cargo'/>
                  <label for='cargo'>Cargo</label>
                </div>
              </div>
              <h4>Datos Internos</h4>
                <hr>
            <!-- Contenedor para listas de los departamentos-->
            <div class='row'>
              <div class="input-field col s6">
                   <input type="date" class="datepicker" name="fecha" id="fecha">
                   <label for='fecha'>Fecha</label>
              </div>
              <div class="input-field col s6">
                <input type="text" name="asunto" id="asunto">
                <label for='asunto'>Asunto</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
                <select name="select-departamento" id="select-departamento" onchange="habilita_boton_registro()">
                  <option disabled selected>Seleccionar departamento...</option>
                  <!-- PHP que llena el combobox de los departamentos -->
                  <?php
                    $dependencias = new operaciones();
                    $dependencias-> obtiene_departamentos();
                  ?>
                </select>
                <label>Departamento</label>
              </div>
              <div class="input-field col s6">
                <input type="text" name="turnado" id="turnado" disabled>
                <label for="turnado">Turnado a</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s4">
                <input type="text" name="seguimiendo_dg" id="seguimiendo_dg">
                <label for="seguimiendo_dg">Seguimiento dir. gral.</label>
              </div>
              <div class="input-field col s4">
                <input type="text" name="seguimiendo_dp" id="seguimiendo_dp">
                <label for="seguimiendo_dp">Seguimiento Depto.</label>
              </div>
              <div class="input-field col s4">
                <input type="text" name="estatus" id="estatus">
                <label for="estatus">Estatus</label>
              </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                  <textarea name="observaciones" id="observaciones" class="materialize-textarea" maxlength="255" data-length="250"></textarea>
                  <label for='observaciones'>Observaciones</label>
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