$(document).ready(function () {
  TraerDatosAnoMes();
});

$("#cerrar1").click(function () {
  $("#ncregion").empty().append("whatever");
  $("#nccargofijo").val("");
  $("#ncruc").val("");
  $("#ncrazonsocial").val("");
  $("#ncnomcontacto").val("");
  $("#nctelefono1").val("");
  $("#nccorreo").val("");
  $("#ncobservaciones").val("");
  $("#ncoportunidad").val("");
  $("#ncqlineas").val("");
  $("#ncdni").val("");
});

$("#cerrar2").click(function () {
  $("#ncregion").empty().append("whatever");
  $("#nccargofijo").val("");
  $("#ncruc").val("");
  $("#ncrazonsocial").val("");
  $("#ncnomcontacto").val("");
  $("#nctelefono1").val("");
  $("#nccorreo").val("");
  $("#ncobservaciones").val("");
  $("#ncoportunidad").val("");
  $("#ncdni").val("");
});

$("#btnRegistrar").click(function () {
  if (
    $("#ncqlineas").val() == "0" ||
    $("#ncregion").val() == "0" ||
    $("#nccargofijo").val() == "0" ||
    $("#nccargofijo").val() == "" ||
    $("#ncnomcontacto").val() == "" ||
    $("#nctelefono1").val() == "" ||
    $("#nccorreo").val() == "" ||
    $("#ncdireccion").val() == "" ||
    $("#ncdni").val() == "0" ||
    $("#ncdni").val() == ""
  ) {
    alertify.error("REVISE LOS DATOS");
  } else {
    datos = $("#frmQuiebreMovil").serialize();
    $.ajax({
      type: "POST",
      data: datos,
      url: "../procesos/agregarQuiebreMnvo.php",
      success: function (r) {
        console.log(datos);
        if (r != 1) {
          alertify.success("Registrado con exito");

          $("#modalEditar").modal("hide");

          $("#ncregion").empty().append("whatever");
          $("#nccargofijo").val("");
          $("#ncfruc").val("");
          $("#ncfrazonsocial").val("");
          $("#ncnomcontacto").val("");
          $("#nctelefono1").val("");
          $("#nccorreo").val("");
          $("#ncobservaciones").val("");
          $("#ncoportunidad").val("");
          $("#ncqlineas").val("");
          $("#nvoruc").val("");
          $("#ncdni").val("");
          var estado = $("#ncestado").val();
          var idusu = $("#idusu").val();
          var ano = $("#ncano").val();
          var periodo = $("#ncperiodo").val();

          $("#tablaDatatable").load(
            "../capa_presentacion/tabla_quiebre_movil.php?ano=" +
              ano +
              "&periodo=" +
              periodo +
              "&estado=" +
              estado +
              "&idusu=" +
              idusu
          );
        } else {
          alertify.error("Fallo al agregar");
        }
      },
    });
  }
});

$("#btnagregar").click(function () {
  $("#ncregion").empty().append("whatever");
  MostrarRegion();

  var nvoruc = $("#nvoruc").val();
  // var ncfqlineas = $("#ncqlineas").val();

  if (nvoruc.length === 11) {
    datos = $("#frmagregar").serialize();
    $.ajax({
      type: "POST",
      data: datos,
      url: "../procesos/BuscarRuc.php",
      success: function (data) {
        datos = jQuery.parseJSON(data);
        console.log(datos);
        if (datos["estado"] === "1" || datos["estado"] === "0") {
          $("#modalEditar").modal("show");

          $("#ncruc").val(nvoruc);
          $("#ncrazonsocial").val(datos["razon_social"]);
          $("#ncfruc").val(nvoruc);
          $("#ncfrazonsocial").val(datos["razon_social"]);
        } else {
          alertify.error("CLIENTE NO REGISTRADO: IR A FUNNEL +AGREGAR CLIENTE");
        }
      },
    });
  } else {
    alertify.error("RUC DEBE TENER 11 DIGITOS");
  }
});

$("#btnfiltrar").click(function () {
  var estado = $("#ncestado").val();
  var idusu = $("#idusu").val();
  var ano = $("#ncano").val();
  var periodo = $("#ncperiodo").val();
  $("#tablaDatatable").load(
    "../capa_presentacion/tabla_quiebre_movil.php?ano=" +
      ano +
      "&periodo=" +
      periodo +
      "&estado=" +
      estado +
      "&idusu=" +
      idusu
  );
});

function MostrarRegion() {
  $.ajax({
    url: "../procesos/obtenDatosUsuarioRegion.php",
    success: function (r) {
      datos = jQuery.parseJSON(r);
      if (datos.length > 0) {
        $("#ncregion").append("<option value = '0'> --Elegir-- </option>");
        var i;
        for (i = 0; i < datos.length; i++) {
          $("#ncregion").append(
            "<option value = '" + datos[i][0] + "'>" + datos[i][1] + "</option>"
          );
        }
      }
    },
  });
}

function TraerDatosAnoMes() {
  var estado = $("#ncestado").val();
  var idusu = $("#idusu").val();
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
    "../capa_presentacion/tabla_quiebre_movil.php?ano=" +
      ano +
      "&periodo=" +
      periodo +
      "&estado=" +
      estado +
      "&idusu=" +
      idusu
  );
}

function TraerDatosTabla(idquiebre) {
  $.ajax({
    type: "POST",
    data: "idquiebre=" + idquiebre,
    url: "../procesos/obtenQuiebreMovil.php",
    success: function (data) {
      try {
        datos = jQuery.parseJSON(data);
        $("#idquiebre").val(idquiebre);
        $("#ncqlineass").val(datos["q_lineas"]);
        $("#ncmodalidads").val(datos["modalidad"]);
        $("#nccargofijos").val(datos["cargo_fijo"]);
        $("#ncrucs").val(datos["ruc"]);
        $("#ncrazonsocials").val(datos["razon_social"]);
        $("#ncnomcontactos").val(datos["contacto"]);
        $("#nctelefono1s").val(datos["telefono1"]);
        $("#nctelefono1m").val(datos["telefono1"]);
        $("#nccorreos").val(datos["correo"]);
        $("#nccorreom").val(datos["correo"]);
        $("#ncdnis").val(datos["dni"]);
        $("#ncdnim").val(datos["dni"]);
        $("#ncregions").val(datos["zonal"]);
        $("#ncpersonals").val(datos["personal"]);
        $("#ncobservacionesejes").val(datos["comentario"]);
        $("#ncestados").val(datos["estado"]);
        $("#ncsupervisors").val(datos["supervisor"]);
        $("#fechaingresos").val(datos["fecha_ingreso"]);
        $("#fechavalidacions").val(datos["fecha_validacion"]);
        $("#ncvalidacions").val(datos["validacion"]);
        $("#ncvalidadors").val(datos["validador"]);
        $("#ncobservacionesvals").val(datos["comentario_validador"]);
        $("#ncestadoacts").val(datos["estado_actual"]);
        $("#ncfechaacts").val(datos["fecha_actualizacion"]);
        $("#ncoportunidads").val(datos["oportunidad"]);
        $("#nccomentariobacks").val(datos["comentario_back"]);
      } catch (error) {
        console.log("Error parsing JSON:", error, data);
      }
    },
  });
}

$("#btnActualizar").click(function () {
  if ($("#ncvalidacions").val() === "PENDIENTE") {
    if (
      $("#ncqlineass").val() == "0" ||
      $("#nccargofijos").val() == "0" ||
      $("#nccargofijos").val() == "" ||
      $("#nctelefono1s").val() == "" ||
      $("nccorreos").val() == "" ||
      $("ncdnis").val() == ""
    ) {
      alertify.error("REVISE LOS DATOS");
    } else {
      datos = $("#frmQuiebreMovilSeguimiento").serialize();
      $.ajax({
        type: "POST",
        data: datos,
        url: "../procesos/agregarQuiebreComentario.php",
        success: function (r) {
          if (r != 1) {
            alertify.success("Actualizado con exito");

            $("#modalSeguimiento").modal("hide");

            var estado = $("#ncestado").val();
            var idusu = $("#idusu").val();
            var ano = $("#ncano").val();
            var periodo = $("#ncperiodo").val();
            $("#tablaDatatable").load(
              "../capa_presentacion/tabla_quiebre_movil.php?ano=" +
                ano +
                "&periodo=" +
                periodo +
                "&estado=" +
                estado +
                "&idusu=" +
                idusu
            );
          } else {
            alertify.error("Fallo al actualizar");
          }
        },
      });
    }
  } else {
    alertify.error("VALIDADO COMO:" + $("#ncvalidacions").val());
  }
});
