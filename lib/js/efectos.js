

function llamarPagina(parametros) {

//    console.log("pagina "+parametros.pagina);
//    console.log("datos "+parametros.datos);
//    console.log("funcion final "+parametros.funcionFinal);

    var loadingControl = new loading();
    loadingControl.init(1);
    $.ajax({
        url: parametros.pagina,
        async: false,
        type: 'POST',
        dataType: "json",
        data: parametros.datos,
        success: function(data) {
//            history.pushState("", document.title, "?c="+pagina);
//            alert(parametros.funcionFinal);
            if (parametros.funcionFinal) {
                if (parametros.parametro) {
//                    alert("con parametros");
                    parametros.funcionFinal(parametros.parametro);
                } else {
//                    alert("sin parametros");
                    parametros.funcionFinal(data);
                }

            }
            loadingControl.init(-1);

        },
        error: function() {
//            console.log("pagina error"+parametros.pagina);
            document.location.href = location.href;
//            $("#sectionPrincipalID").html("Error en la primera llamada");
        }
    });
}
function llamarPaginaSimple(parametros) {

//    console.log("pagina " + parametros.pagina);
//    console.log("datos " + parametros.datos);
//    console.log("funcion final " + parametros.funcionFinal);
    var loadingControl = new loading();

    loadingControl.init(1);
    $.ajax({
        url: parametros.pagina,
        async: false,
        type: 'POST',
        data: parametros.datos,
        success: function(data) {
//            history.pushState("", document.title, "?c="+pagina);
//            alert(parametros.funcionFinal);
            if (parametros.funcionFinal) {
                if (parametros.parametro) {
//                    alert("con parametros");
                    parametros.funcionFinal(parametros.parametro);
                } else {
//                    alert("sin parametros");
                    parametros.funcionFinal(data);
                }

            }
            loadingControl.init(-1);

        },
        error: function() {
                document.location.href = location.href;
//            $("#sectionPrincipalID").html("Error en la primera llamada");
        }
    });
}

function addPrincipal(data) {
    if (data.contenido && data) {
        if (data.add) {
            $("#sectionPrincipalID").append(data.contenido);
        } else {
            $("#sectionPrincipalID").html(data.contenido);
        }

        crearPaginas("paginacionContenedor", data.numResultados, data.tabla);
    } else if (!data.contenido && data) {
        $("#sectionPrincipalID").html(data);
    } else {
        $("#sectionPrincipalID").html("No hay noticias");
    }

}

function crearPaginas(contenedor, numResultado, tabla) {
    var numPag = numResultado / 10;
    var pagActual = $("#numPagina").html() - 1;
    contenedor = $("#" + contenedor);
    if (numPag >= 1) {

        contenedor.html("<ol id='paginacion' ><li class='previous' id='paginaPrimera' ><a onclick='paginar(" + (pagActual - 1) + ",\"" + tabla + "\")'>Prev</a></li>");
        for (var i = 0; i < numPag; i++) {

            contenedor.append("<li class='pagina' id='pagina" + i + "' ><a onclick='paginar(" + i + ",\"" + tabla + "\")'>" + (i + 1) + "</a></li>");
        }

        contenedor.append("<li class='next'   id='paginaUltima' ><a onclick='paginar(" + (pagActual + 1) + ",\"" + tabla + "\")'>Next</a></li></ol>");
    }
    $("#paginacion li").removeClass("paginaActiva");
    $("#pagina" + pagActual).addClass("paginaActiva");
    if ((pagActual - 1) < 0) {
        $("#paginaPrimera").addClass("previous-off");
        $("#paginaPrimera").removeClass("previous");
    }
    if ((pagActual + 1) > numPag) {
        $("#paginaUltima").addClass("next-off");
        $("#paginaUltima").removeClass("next");
    }
    if (numResultado <= 10) {
        contenedor.html("");
    }
}

function paginar(pag, tabla) {
    $("#numPagina").html(pag + 1);
    var historial;
    if (tabla === "Noticias") {
        historial = 'news';
    } else if (tabla === "Tours") {
        historial = "tours";
    }

    history.pushState({tabla: tabla, pagina: pag}, document.title, historial);
    var parametros = {
        pagina: "mostrarNoticias.php",
        datos: {tabla: tabla, pagina: pag},
        funcionFinal: addPrincipal
    };
    llamarPagina(parametros);
}

function eventoBorrarPost(id, tabla) {

    var parametros2 = {
        pagina: "mostrarNoticias.php",
        datos: {tabla: tabla},
        funcionFinal: addPrincipal
    };
    var parametros = {
        pagina: "borrarNoticias.php",
        datos: {id: id, tabla: tabla},
        funcionFinal: llamarPagina,
        parametro: parametros2
    };
    llamarPagina(parametros);
}

function loading() {
    this.loadingCount = 0;
    this.init = function loading(num) {
        this.loadingCount += num;

        if (this.loadingCount <= 0) {
            $("#loading").hide();
        } else {
            $("#loading").show();
        }
    };
}
