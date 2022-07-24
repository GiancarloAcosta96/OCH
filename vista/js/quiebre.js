$(document).ready(function () {
  TraerDatosAnoMes();
});

function mostrarOpciones() {
  let seleccionarValor = document.getElementById("quiebre_problemas").value;
  switch (seleccionarValor) {
    case "SI":
      document.getElementById("quiebre_detalle").style.display = "inline-block";
      document
        .getElementById("quiebre_detalle")
        .setAttribute("required", "required");
      break;
    case "NO":
      document.getElementById("quiebre_detalle").style.display = "none";
      $("#fechaTicket").val("");
      $("#quiebre_detalle").val("");
      document
        .getElementById("quiebre_detalle")
        .setAttribute("required", "required");
  }
}

function mostrarOpcionesTicket() {
  let seleccionarValorTicket = document.getElementById("quiebre_ticket").value;
  switch (seleccionarValorTicket) {
    case "SI":
      document.getElementById("fechaTicket").style.display = "inline-block";
      document.getElementById("quiebre_numero_ticket").style.display =
        "inline-block";
      break;
    case "NO":
      document.getElementById("fechaTicket").style.display = "none";
      $("#fechaTicket").val("");
      $("#quiebre_numero_ticket").val("");
      document.getElementById("quiebre_numero_ticket").style.display = "none";
  }
}

$("#cerrar1").click(function () {
  $("#ncregion").empty().append("whatever");
  $("#fechaActivacion").val("");
  $("#fechaInicio").val("");
  $("#ncrazonsocial").val("");
  $("#quiebre_servicio").val("");
  $("#quiebre_tipo_averia").val("");
  $("#quiebre_contacto1").val("");
  $("#quiebre_contacto2").val("");
  $("#quiebre_celular1").val("");
  $("#quiebre_celular2").val("");
  $("#quiebre_numero_problema").val("");
  $("#quiebre_observaciones").val("");
});

$("#cerrar2").click(function () {
  $("#ncregion").empty().append("whatever");
  $("#fechaActivacion").val("");
  $("#fechaInicio").val("");
  $("#ncrazonsocial").val("");
  $("#quiebre_servicio").val("");
  $("#quiebre_tipo_averia").val("");
  $("#quiebre_contacto1").val("");
  $("#quiebre_contacto2").val("");
  $("#quiebre_celular1").val("");
  $("#quiebre_celular2").val("");
  $("#quiebre_numero_problema").val("");
  $("#quiebre_observaciones").val("");
});

$("#btnRegistrar").click(function () {
  if (
    $("#ncregion").val() == "0" ||
    $("#fechaActivacion").val() == null ||
    $("#fechaInicio").val() == null ||
    $("#fechaTicket").val() == null ||
    $("#quiebre_contacto1").val() == "" ||
    $("#quiebre_contacto1").val() == "0" ||
    $("#quiebre_celular1").val() == "" ||
    $("#quiebre_celular1").val() == "0" ||
    $("#quiebre_numero_problema").val() == null ||
    $("#quiebre_observaciones").val() == null
  ) {
    alertify.error("REVISE LOS DATOS");
  } else {
    try {
      datos = $("#frmQuiebre").serialize();
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
            $("#fechaTicket").val("");
            $("#fechaActivacion").val("");
            $("#fechaInicio").val("");
            $("#quiebre_numero_ticket").val("");
            $("#quiebre_contacto1").val("");
            $("#quiebre_celular1").val("");
            $("#quiebre_contacto2").val("");
            $("#quiebre_celular2").val("");
            $("#quiebre_numero_problema").val("");
            $("#ncregion").val("");
            $("#quiebre_observaciones").val("");
            var estado = $("#ncestado").val();
            var idusu = $("#idusu").val();
            var ano = $("#ncano").val();
            var periodo = $("#ncperiodo").val();

            $("#tablaDatatable").load(
              "../capa_presentacion/tabla_quiebre.php?ano=" +
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
    } catch (e) {
      console.log("error: ", e);
    }
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
    "../capa_presentacion/tabla_quiebre.php?ano=" +
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
    "../capa_presentacion/tabla_quiebre.php?ano=" +
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
        $("#fechaActivacions").val(datos["fecha_activacion"]);
        $("#fechaInicios").val(datos["fecha_inicio"]);
        $("#ncrucs").val(datos["ruc"]);
        $("#ncrazonsocials").val(datos["razon_social"]);
        $("#quiebre_servicios").val(datos["servicio"]);
        $("#quiebre_tipo_averias").val(datos["tipo_averia"]);
        $("#quiebre_problemas").val(datos["problema_equipo"]);
        $("#quiebre_detalles").val(datos["detalle_equipo"]);
        $("#quiebre_tickets").val(datos["ticket_atencion"]);
        $("#fechaTickets").val(datos["fecha_ticket_atencion"]);
        $("#quiebre_numero_tickets").val(datos["numero_ticket"]);
        $("#quiebre_contacto1").val(datos["contacto1"]);
        $("#quiebre_celular1").val(datos["celular1"]);
        $("#quiebre_contacto2").val(datos["celular2"]);
        $("#quiebre_celular2").val(datos["celular2"]);
        $("#quiebre_numero_problemas").val(datos["numero_problema"]);
        $("#ncregions").val(datos["zonal_telefonica"]);
        $("#ncobservacioness").val(datos["comentario_ejecutivo"]);

        $("#ncrucss").val(datos["ruc"]);
        $("#ncrazonss").val(datos["razon_social"]);
        $("#quiebre_tipo_averiass").val(datos["tipo_averia"]);
        $("#casosf").val(datos["casosf"]);
        $("#fechavalidacions").val(datos["fecha_validacion"]);
        $("#ncvalidadors").val(datos["id_validador"]);
        $("#ncvalidacions").val(datos["validacion"]);
        $("#ncobservacionesvals").val(datos["comentario_validador"]);
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
      $("#nccorreos").val() == null ||
      $("#ncdnis").val() == ""
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
              "../capa_presentacion/tabla_quiebre.php?ano=" +
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
