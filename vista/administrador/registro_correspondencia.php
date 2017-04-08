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
  $dependencias = new operaciones();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>Registrar correspondencia | SiFinancia</title>  
  <link href="../css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link rel="stylesheet" type="text/css" href="../css/header.css">
  <script type="text/javascript" src="js/materialize.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      //Disparadores de activación de componentes
        $('select').material_select();
        $('textarea#observaciones').characterCounter();
        $('textarea#seguimiento-dg').characterCounter();
        $('textarea#seguimiendo-dp').characterCounter();
           //Disparador para crear el datepicker
        $('.datepicker').pickadate({
          format: 'yyyy/mm/dd',
          selectMonths: true, // Crea comboBox con los meses
          selectYears: 20, // Crea la lista de los años disponibles
        });
        //Metodo AJAX para obtener el siguiente id_correspondencia
        $.ajax({
          url: "modelo/obtiene_folio.php",
          success: function(data){
            $('#folio').val(data);
          }
        });
    });

    /*Esta funcion se encarga de habilitar el boton de registro cuando 
    se selecciona un departamento, y tambien se encarga de obtener el nombre completo
    del usuario encargado del departamento al que se envio la correspondencia*/
    function habilita_boton_registro(){
      document.getElementById("btn_login").disabled = false;
      var valor = $('#select-departamento').val();
        $.ajax({
          type: "POST",
          url: "modelo/obtener_nombre_usuario.php",
          data: {depto: valor},
          success: function(data){
            $('#turnado').val(data);
          }
        });
    }
  </script>
  <script type="text/javascript">
  //Funcion que se dispara cuando se da clic en boton registrar, 
  //manda todos los datos al php de registro
    $('#btn_login').click(function(){
      //Variables a enviar a la base de datos (se obtienen datos del formulario)
      var folio = $('#folio').val();
      var oficio = $('#oficio').val();
      var dependencia = $('#dependencia').val();
      var nombre_remitente = $('#nombre-remitente').val();
      var cargo_remitente = $('#cargo').val();
      var fecha = $('#fecha').val();
      var asunto = $('#asunto').val();
      var departamento = $('#select-departamento').val();
      var nombre_encargado = $('#turnado').val();
      var seguimiento_dirgen = $('#seguimiento-dg').val();
      var seguimiento_depto = $('#seguimiento-dp').val();
      var observaciones = $('#observaciones').val();
      var estatus;
      if(document.getElementById('estatus').checked)
        estatus = true;//Estatus activo
      else
        estatus = false;//Estatus inactivo
      var url = "modelo/registra_correspondencia.php";
        $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: {Num_folio: folio, Num_oficio: oficio, depend: dependencia, nom_remitente: nombre_remitente, cargo_remit: cargo_remitente, date: fecha, asunt: asunto, depto: departamento, nom_encargado: nombre_encargado, segui_dir: seguimiento_dirgen, segui_depto: seguimiento_depto, observa: observaciones, status: estatus}, 
           success: function(data)             
           {
              alert(data); 
              $.ajax({
                url: "modelo/obtiene_folio.php",
                success: function(data){
                  $('#folio').val(data);
                }
              });            
           }
       });
    });

    $('#limpiar').click(function(){
      $.ajax({
          url: "modelo/obtiene_folio.php",
          success: function(data){
            $('#folio').val(data);
          }
        });
    });
  </script>
</head>
<body>
<center>
<br>
      <div class="container row">
        <div class="z-depth-1 grey lighten-4 row" id="contenedor-formulario" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
          <form class="col s12"  method="post" name="login" id="formulario">
            <!-- Contenedor para folio, no. de oficio y dependencia-->
            <div class='row'>
              <h4>Datos externos</h4>
              <hr>
              <div class='input-field col s3'>
                <input  type="text" name='folio' id='folio' placeholder="Folio" readonly />
                <label for='folio'>Folio</label>
              </div>
            <!-- Contenedor para campo No. de oficio y dependencia-->   
              <div class='input-field col s3'>
                <input type='text' name='oficio' id='oficio' required="required" maxlength="10" data-length="10" required="required" />
                <label for='oficio'>No. de Oficio</label>
              </div>
              <div class='input-field col s6'>
                <input type='text' name='dependencia' id='dependencia' required="required" maxlength="100" data-length="100"/>
                <label for='dependencia'>Dependencia</label>
              </div>
            </div>
              <div class="row">
                <div class="input-field col s6">
                  <input  type="text" name='nombre-remitente' id='nombre-remitente' maxlength="80" data-length="80" required="required" />
                  <label for='nombre-remitente'>Nombre de remitente</label>
                </div>
                <div class="input-field col s6">
                  <input  type="text" name='cargo' id='cargo' maxlength="80" data-length="80" required="required" />
                  <label for='cargo'>Cargo de remitente</label>
                </div>
              </div>
              <h4>Datos Internos</h4>
                <hr>
            <!-- Contenedor para fecha y estatus-->
            <div class='row'>
              <div class="input-field col s6">
                   <input type="date" class="datepicker" name="fecha" id="fecha" required="required">
                   <label for='fecha'>Fecha</label>
              </div>
              <div class="input-field col s6">
                <div class="switch">
                  <label>Estatus
                  <input type="checkbox" name="estatus" id="estatus">
                  <span class="lever"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input type="text" name="asunto" id="asunto" maxlength="100" data-length="100" required="required">
                <label for='asunto'>Asunto</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
                <select name="select-departamento" id="select-departamento" onchange="habilita_boton_registro()">
                  <option disabled selected>Seleccionar departamento...</option>
                  <!-- PHP que llena el combobox de los departamentos -->
                  <?php
                    $dependencias-> obtiene_departamentos();
                  ?>
                </select>
                <label>Departamento</label>
              </div>
              <div class="input-field col s6">
                <input type="text" name="turnado" id="turnado" placeholder="Turnado a" readonly>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <textarea name="seguimiento-dg" id="seguimiento-dg" class="materialize-textarea" maxlength="255" data-length="250"></textarea>
                <label for="seguimiento_dg">Seguimiento dir. gral.</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <textarea name="seguimiento-dp" id="seguimiento-dp" class="materialize-textarea" maxlength="255" data-length="250"></textarea>
                <label for="seguimiento_dp">Seguimiento Depto.</label>
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
                <button type='reset' class='col s3 btn btn-small waves-effect red right' name="limpiar" id="limpiar">Limpiar</button>
              </center>
              </div>              
            </center>
          </form>
        </div>
      </div>
      </center>
</body>
</html>