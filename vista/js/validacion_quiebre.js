$(document).ready(function () {
  TraerDatosAnoMes();
});

$("#cerrar1").click(function () {
  $("#ncregion").val("");
  $("#nccargofijo").val("");
  $("#ncruc").val("");
  $("#ncrazonsocial").val("");
  $("#ncnomcontacto").val("");
  $("#nctelefono1").val("");
  $("#nccorreo").val("");
  $("#ncdni").val("");

  $("#ncobservacioneseje").val("");
  $("#ncpersonal").val("");
  $("#ncqlineas").val("");
  $("#ncmodalidad").val("");
  $("#ncobservacionesval").val("");
});

$("#cerrar2").click(function () {
  $("#ncregion").val("");
  $("#nccargofijo").val("");
  $("#ncruc").val("");
  $("#ncrazonsocial").val("");
  $("#ncnomcontacto").val("");
  $("#nctelefono1").val("");
  $("#nccorreo").val("");
  $("#ncdni").val("");
  $("#ncobservacioneseje").val("");
  $("#ncpersonal").val("");
  $("#ncqlineas").val("");
  $("#ncmodalidad").val("");
  $("#ncobservacionesval").val("");
});

$("#btnRegistrar").click(function () {
  if ($("#ncestado").val() == "PENDIENTE") {
    datos = $("#frmNCM").serialize();
    $.ajax({
      type: "POST",
      data: datos,
      url: "../procesos/agregarQuiebrevalidacion.php",
      success: function (r) {
        if (r != 1) {
          alertify.success("Registrado con exito");

          $("#modalEditar").modal("hide");

          $("#ncregion").val("");
          $("#nccargofijo").val("");
          $("#ncruc").val("");
          $("#ncrazonsocial").val("");
          $("#ncnomcontacto").val("");
          $("#nctelefono1").val("");
          $("#nccorreo").val("");
          $("#ncdni").val("");

          $("#ncobservacioneseje").val("");
          $("#ncpersonal").val("");
          $("#ncqlineas").val("");
          $("#ncmodalidad").val("");
          $("#ncobservacionesval").val("");
          var validacionf = $("#ncvalidacionf").val();
          var tienda = $("#tienda").val();
          var ano = $("#ncano").val();
          var periodo = $("#ncperiodo").val();
          $("#tablaDatatable").load(
            "../capa_presentacion/tabla_quiebre_validacion.php?ano=" +
              ano +
              "&periodo=" +
              periodo +
              "&validacionf=" +
              validacionf +
              "&tienda=" +
              tienda
          );
        } else {
          alertify.error("Fallo al agregar");
        }
      },
    });
  } else {
    alertify.error("EL PEDIDO ESTA:" + $("#ncestado").val());
  }
});

$("#btnfiltrar").click(function () {
  var validacionf = $("#ncvalidacionf").val();
  var tienda = $("#tienda").val();
  var ano = $("#ncano").val();
  var periodo = $("#ncperiodo").val();
  $("#tablaDatatable").load(
    "../capa_presentacion/tabla_quiebre_validacion.php?ano=" +
      ano +
      "&periodo=" +
      periodo +
      "&validacionf=" +
      validacionf +
      "&tienda=" +
      tienda
  );
});

function TraerDatosAnoMes() {
  var validacionf = $("#ncvalidacionf").val();
  var tienda = $("#tienda").val();
  var fecha = new Date();
  var ano = fecha.getFullYear();

  console.log(fecha);
  $("#ncano").val(ano);

  var periodo = fecha.getMonth() + 1;

  if (periodo > 9) {
    $("#ncperiodo").val(periodo);
  } else {
    $("#ncperiodo").val("0" + periodo);
  }

  $("#tablaDatatable").load(
    "../capa_presentacion/tabla_quiebre_validacion.php?ano=" +
      ano +
      "&periodo=" +
      periodo +
      "&validacionf=" +
      validacionf +
      "&tienda=" +
      tienda
  );
}

function TraerDatosTabla(idquiebre) {
  $.ajax({
    type: "POST",
    data: "idquiebre=" + idquiebre,
    url: "../procesos/obtenQuiebre_validacion.php",
    success: function (data) {
      datos = jQuery.parseJSON(data);
      $("#idquiebre").val(idquiebre);
      $("#ncqlineas").val(datos["q_lineas"]);
      $("#ncmodalidad").val(datos["modalidad"]);
      $("#nccargofijo").val(datos["cargo_fijo"]);
      $("#ncruc").val(datos["ruc"]);
      $("#ncrazonsocial").val(datos["razon_social"]);
      $("#ncnomcontacto").val(datos["contacto"]);
      $("#nctelefono1").val(datos["telefono1"]);
      $("#nccorreo").val(datos["correo"]);
      $("#ncdni").val(datos["dni"]);
      $("#ncregion").val(datos["zonal"]);
      $("#ncpersonal").val(datos["personal"]);
      $("#ncobservacioneseje").val(datos["comentario"]);
      $("#ncestado").val(datos["estado"]);
    },
  });
}

$("#btnexportar").click(function () {
  $("#frmrepexportarvalidacionmovil").submit();
});
