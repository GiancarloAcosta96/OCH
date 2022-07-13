$(document).ready(function () {
  $("#tablaDatatable").load("../capa_presentacion/tablaDatos_fija.php");
});

$("#cerrar1").click(function () {
  $("#telefono").val("");

  $("#qlineas").val("");
  $("#nomcontacto").val("");
  $("#correorl").val("");
  $("#comentario").val("");
  $("#respuesta").empty().append("whatever");
  $("#btnRegistrar").hide();
});

$("#cerrar2").click(function () {
  $("#telefono").val("");
  $("#nomcontacto").val("");
  $("#qlineas").val("");
  $("#correorl").val("");
  $("#comentario").val("");
  $("#respuesta").empty().append("whatever");
  $("#btnRegistrar").hide();
});

$("#respuesta").click(function () {
  if (
    $("#respuesta").val() == "1" ||
    $("#respuesta").val() == "2" ||
    $("#respuesta").val() == "3" ||
    $("#respuesta").val() == "4" ||
    $("#respuesta").val() == "15" ||
    $("#respuesta").val() == "16" ||
    $("#respuesta").val() == "17" ||
    $("#respuesta").val() == "18"
  ) {
    $("#titular").toggle();
    $("#comun").toggle();

    $(".fr").hide();
  } else {
    if (
      $("#respuesta").val() == "5" ||
      $("#respuesta").val() == "6" ||
      $("#respuesta").val() == "7" ||
      $("#respuesta").val() == "8" ||
      $("#respuesta").val() == "9" ||
      $("#respuesta").val() == "10" ||
      $("#respuesta").val() == "11" ||
      $("#respuesta").val() == "12" ||
      $("#respuesta").val() == "13" ||
      $("#respuesta").val() == "14" ||
      $("#respuesta").val() == "19" ||
      $("#respuesta").val() == "20" ||
      $("#respuesta").val() == "21" ||
      $("#respuesta").val() == "22" ||
      $("#respuesta").val() == "23" ||
      $("#respuesta").val() == "24" ||
      $("#respuesta").val() == "25" ||
      $("#respuesta").val() == "26" ||
      $("#respuesta").val() == "27" ||
      $("#respuesta").val() == "28"
    ) {
      $("#comun").toggle();
    } else {
      $("#titular").hide();
      $("#comun").hide();

      $(".fr").hide();
    }
  }
});

$("#btnRegistrar").click(function () {
  var telefono = $("#telefono").val();
  if (
    $("#respuesta").val() === "0" ||
    $("#telefono").val() === "" ||
    telefono.length < 8
  ) {
    alertify.error("REVISE LOS DATOS");
  } else {
    if (
      ($("#respuesta").val() == "1" ||
        $("#respuesta").val() == "2" ||
        $("#respuesta").val() == "3" ||
        $("#respuesta").val() == "4" ||
        $("#respuesta").val() == "15" ||
        $("#respuesta").val() == "16" ||
        $("#respuesta").val() == "17" ||
        $("#respuesta").val() == "18") &&
      ($("#qlineas").val() === "0" ||
        $("#qlineas").val() === "" ||
        $("#nomcontacto").val() === "")
    ) {
      alertify.error("REVISE LOS DATOS");
    } else {
      datos = $("#frmLlamada").serialize();
      $.ajax({
        type: "POST",
        data: datos,
        url: "../procesos/agregarLlamada.php",
        success: function (r) {
          if (r != 1) {
            AgregarTelefono();
            alertify.success("Registrado con exito");
            $("#modalEditar").modal("hide");
            $("#telefono").val("");

            $("#qlineas").val("");
            $("#nomcontacto").val("");
            $("#correorl").val("");
            $("#comentario").val("");
            $("#respuesta").empty().append("whatever");
            $("#btnRegistrar").hide();
            $("#tablaDatatable").load(
              "../capa_presentacion/tablaDatos_fija.php"
            );

            //  alertify.success("Agregado con exito");

            // location.reload();
          } else {
            alertify.error("Fallo al agregar");
          }
        },
      });
    }
  }
});

// function sumarDias(fecha, dias){
//   fecha.setDate(fecha.getDate() + dias);
//   return fecha;
// }

// var d = new Date();
// console.log(sumarDias(, -5));

$("#telefono").blur(function () {
  var tel = $("#telefono").val();
  if (tel === "") {
    $("#btnRegistrar").hide();
  } else {
    $("#btnRegistrar").show();
  }
});

$("#gestion").click(function () {
  TraerDatosRespuesta($("#gestion").val());
});

function AgregarListanegra() {
  datos = $("#frmLlamada").serialize();
  $.ajax({
    type: "POST",
    data: datos,
    url: "../procesos/AgregarListaNegra.php",
    success: function (data) {
      datos = jQuery.parseJSON(data);
      console.log(datos);
    },
  });
}

function CambiarEstadoTel() {
  datos = $("#frmLlamada").serialize();
  $.ajax({
    type: "POST",
    data: datos,
    url: "../procesos/CambiaEstadoTel.php",
    success: function (data) {
      datos = jQuery.parseJSON(data);
      console.log(datos);
    },
  });
}

function TraerDatosRespuesta(gestion) {
  $("#respuesta").empty().append("whatever");
  $.ajax({
    type: "POST",
    data: "gestion=" + gestion,
    url: "../procesos/obtenDatosRespuesta.php",
    success: function (data) {
      datos = jQuery.parseJSON(data);

      if (datos.length > 0) {
        $("#respuesta").append("<option value = '0'> --Elegir-- </option>");
        var i;
        for (i = 0; i < datos.length; i++) {
          $("#respuesta").append(
            "<option value = '" + datos[i][0] + "'>" + datos[i][1] + "</option>"
          );
        }
      }
    },
  });
}

function AgregarTelefono() {
  datos = $("#frmLlamada").serialize();
  $.ajax({
    type: "POST",
    data: datos,
    url: "../procesos/AgregarTelefono.php",
    success: function (data) {
      datos = jQuery.parseJSON(data);
      console.log(datos);
    },
  });
}

function TraerDatosTabla(ruc) {
  TraerDatosRespuesta($("#gestion").val());
  $("#titular").hide();
  $("#comun").hide();

  $.ajax({
    type: "POST",
    data: "ruc=" + ruc,
    url: "../procesos/obtenDatos.php",
    success: function (data) {
      datos = jQuery.parseJSON(data);
      $("#datos").html(datos["razon_social"] + "   RUC:" + ruc);
      $("#ruc").val(ruc);
      $("#razon_social").val(datos["razon_social"]);
      $("#tablaDatatablehistorial").load(
        "../capa_presentacion/tablaHistorial.php?ruc=" + ruc
      );
      $("#tablaDatatabletelefono").load(
        "../capa_presentacion/tablaTelefono.php?ruc=" + ruc
      );
    },
  });
}
