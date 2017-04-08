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
  <title>Consultar correspondencia | SiFinancia</title>  
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link rel="stylesheet" type="text/css" href="../css/header.css">
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
        //Disparador de modals
         $('.modal').modal();
         $('.modal-tabla').modal();         
    });

    function carga_ventanas(){
      var valor = $('#select-consulta').val();
      if(valor==1){
        $('#form-consulta-folio').show();
      }else if(valor==2){
        $('#form-consulta-folio').hide();
      }
    }

    function muestra_tabla(){
    var folio = $('#folio').val();
    $('#contenedor-tabla').load('modelo/queries.php', {"folio": folio});
  }

  function obtiene_valor_boton(){
    //Obtiene los valores actuales para ponerlos en el formulario de modificaciones
    doc = $("button").parents("tr").find("td").eq(1).html();
    dep = $("button").parents("tr").find("td").eq(2).html();
    fec = $("button").parents("tr").find("td").eq(3).html();
    asu = $("button").parents("tr").find("td").eq(4).html();
    depa = $("button").parents("tr").find("td").eq(5).html();
    turn = $("button").parents("tr").find("td").eq(6).html();
    segdir = $("button").parents("tr").find("td").eq(7).html();
    segdep = $("button").parents("tr").find("td").eq(8).html();
    obser = $("button").parents("tr").find("td").eq(9).html();
    est = $("button").parents("tr").find("td").eq(10).html();
    nom = $("button").parents("tr").find("td").eq(11).html();
    carg = $("button").parents("tr").find("td").eq(12).html();
    //Vacia los datos anteriores al formulario
    $('#oficio-modif').val(doc);
    $('#dependencia-modif').val(dep);
    $('#fecha-modif').val(fec);
    $('#asunto-modif').val(asu);
    $('#select-departamento-modif option').filter(function() {
      return this.text == depa; 
    }).attr('selected', true);
    //Obtiene la propiedad value donde se almacena el identificador de cada row
    var valor_boton = $('#btn-modificar').attr("value");
     $('#modal1').modal('open');
     $('#folio-modif').val(valor_boton);
  }
  </script>
</head>
<body>
  <center>
  <br>
  <div class="container row">
    <div class="z-depth-1 grey lighten-4 row" id="contenedor-formulario" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
      <form class="col s12"  method="post" name="login" id="formulario">
        <h4>Seleccionar tipo de consulta</h4>
        <hr>
            <div class="row">
              <div class="input-field col s12">
                <select name="select-consulta" id="select-consulta" onchange="carga_ventanas()">
                  <option disabled selected>Seleccionar consulta</option>
                  <option value="1">No. de folio</option>
                  <option value="2">Fecha</option>
                  <option value="3">Departamento</option>
                  <option value="4">Dependencia</option>
                  <option value="5">Encargado de dependencia</option>
                  <option value="6">Consulta General</option>
                </select>
                <label>Tipo de consulta</label>
              </div>
            </div>
      </form>
    </div>
  </div>
  <div id="form-consulta-folio" hidden>
  <div class="z-depth-1 grey lighten-4 row" id="contenedor-formulario" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
      <form class="col s12"  method="post" name="form-folio" id="form-folio">
       <h4>Consulta por No. de folio</h4>
       <div class="row">
        <div class='input-field col s6'>
        <input  type="text" name='folio' id='folio' required="required" />
        <label for='folio'>Folio</label>
        </div>
       </div>
        <center>
          <div class='row'>
              <button type='button' data-target="modal-tabla" id="btn_folio" name='btn_folio' class='col s4 btn btn-small waves-effect left' onclick="muestra_tabla();">Consultar</button>
          </div>              
        </center>
      </form>
    </div>
    </div>
 <!-- Modal para la tabla -->
  <div id="modal-tabla" class="modal modal-fixed-footer">
    <div class="modal-content" id="contenedor-tabla">
    <!--Contenido del modal -->
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cerrar</a>
    </div>
  </div>


<!-- Estructura de modal y formulario de modificacion de correspondencia-->
  <div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      <div class="container row">
        <div class="z-depth-1 grey lighten-4 row" id="cont-formulario-modif" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
          <form class="col s12"  method="post" name="formulario-modif" id="formulario-modif">
            <!-- Contenedor para folio, no. de oficio y dependencia-->
            <div class='row'>
              <h4>Datos externos</h4>
              <hr>
              <div class='input-field col s3'>
                <input  type="text" name='folio-modif' id='folio-modif' readonly />
              </div>
            <!-- Contenedor para campo No. de oficio y dependencia-->   
              <div class='input-field col s3'>
                <input type='text' name='oficio-modif' id='oficio-modif' required="required" maxlength="10" data-length="10" required="required" />
                <label for='oficio-modif'>No. de Oficio</label>
              </div>
              <div class='input-field col s6'>
                <input type='text' name='dependencia-modif' id='dependencia-modif' required="required" maxlength="100" data-length="100"/>
                <label for='dependencia-modif'>Dependencia</label>
              </div>
            </div>
              <div class="row">
                <div class="input-field col s6">
                  <input  type="text" name='remitente-modif' id='remitente-modif' maxlength="80" data-length="80" required="required" />
                  <label for='remitente-modif'>Nombre de remitente</label>
                </div>
                <div class="input-field col s6">
                  <input  type="text" name='cargo-modif' id='cargo-modif' maxlength="80" data-length="80" required="required" />
                  <label for='cargo-modif'>Cargo de remitente</label>
                </div>
              </div>
              <h4>Datos Internos</h4>
                <hr>
            <!-- Contenedor para fecha y estatus-->
            <div class='row'>
              <div class="input-field col s6">
                   <input type="date" class="datepicker" name="fecha-modif" id="fecha-modif" required="required">
                   <label for='fecha-modif'>Fecha</label>
              </div>
              <div class="input-field col s6">
                <div class="switch">
                  <label>Estatus
                  <input type="checkbox" name="estatus-modif" id="estatus-modif">
                  <span class="lever"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input type="text" name="asunto-modif" id="asunto-modif" maxlength="100" data-length="100" required="required">
                <label for='asunto-modif'>Asunto</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s7">
                <select name="select-departamento-modif" id="select-departamento-modif">
                  <option disabled selected>Seleccionar departamento...</option>
                  <!-- PHP que llena el combobox de los departamentos -->
                  <?php
                    $dependencias-> obtiene_departamentos();
                  ?>
                </select>
                <label>Departamento</label>
              </div>
              <div class="input-field col s5">
                <input type="text" name="turnado-modif" id="turnado-modif" placeholder="Turnado a" readonly>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <textarea name="seguimiento-dg-modif" id="seguimiento-dg-modif" class="materialize-textarea" maxlength="255" data-length="250"></textarea>
                <label for="seguimiento-dg-modif">Seguimiento dir. gral.</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <textarea name="seguimiento-dp-modif" id="seguimiento-dp-modif" class="materialize-textarea" maxlength="255" data-length="250"></textarea>
                <label for="seguimiento-dp-modif">Seguimiento Depto.</label>
              </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                  <textarea name="observaciones-modif" id="observaciones-modif" class="materialize-textarea" maxlength="255" data-length="250"></textarea>
                  <label for='observaciones-modif'>Observaciones</label>
                </div>
            </div>
            <br/>
            <center>
              <div class='row'>
              <center>
                <button type='button' id="btn-aceptar-modificar" name='btn-aceptar-modificar' class='col s3 btn btn-small waves-effect left' disabled>Modificar</button>
                <button type='reset' class='col s3 btn btn-small waves-effect red right'>Limpiar</button>
              </center>
              </div>              
            </center>
          </form>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cerrar</a>
    </div>
  </div>
<!--Terminad modal -->
</body>
</html>