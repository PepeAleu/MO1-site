<?php
session_start();
$_SESSION["dato"] = $_GET["dato"];
?>
<!DOCTYPE html>
<html>
    <head><title>Minority Of One</title>
        <link href="minority.ico" type="image/x-icon" rel="shortcut icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="msvalidate.01" content="115AD7A05CB17393825475D950F36548" />
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/estilos.css" media="all" />
        <link rel="stylesheet" type="text/css" href="css/main.css" media="all" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/forms-min.css">
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/buttons-min.css">
        <script type="text/javascript" src="lib/js/zepto.js" ></script>
        <script type="text/javascript" src="lib/js/zeptofxmethod.js" ></script>
<!--        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>-->
        <script type="text/javascript" src="lib/js/efectos.js" ></script>
        <script type="text/javascript" src="lib/js/tinymce/tinymce.min.js"></script>
        <script  type="text/javascript">
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                var resolucionH, marginLeftMenu, altoCabecera, anchoPrincipal, marginLeftPrincipal;

                //            if (window.screen.width < 800) {
                //                window.location.href = "mobile/index.php";
                //            }

                if (window.screen.width >= 1920) {
                    resolucionH = 1920;
                    altoCabecera = new Array(682, 1238);
//                    marginLeftMenu = -100;
                }
                else if (window.screen.width < 1920 && window.screen.width >= 1366) {
                    resolucionH = 1366;
                    altoCabecera = new Array(485, 881);
//                    marginLeftMenu = -90;
                }
                else if (window.screen.width < 1366 && window.screen.width >= 1280) {
                    resolucionH = 1280;
                    altoCabecera = new Array(455, 825);
//                    marginLeftMenu = -60;
                }
                else if (window.screen.width < 1280) {
                    resolucionH = 1024;
                    altoCabecera = new Array(364, 660);
//                    marginLeftMenu = -50;
                }

<?php if (isset($_GET["carpeta"])) { ?>
                    var carpeta = <?php echo $_GET["carpeta"] ?>;
<?php } else { ?>
                    var carpeta = "Noticias";
                    ;
<?php } ?>
                var dato = 0;
                var paginaPrincipal = "mostrarNoticias.php";
                var funcion = llamarPagina;
<?php if (isset($_GET["dato"])) { ?>
                    dato = <?php echo $_GET["dato"] ?>;
<?php } ?>
                console.log("pagina "+carpeta);
                if (!carpeta) {
                    carpeta = "Noticias";
                    paginaPrincipal = "mostrarNoticias.php";
                }
                if (carpeta === "media" || carpeta === "contact" || carpeta === "bio") {
                    funcion = llamarPaginaSimple;
                }
                if (carpeta === "contact") {
                    paginaPrincipal = "contact.php";
                }
                if (carpeta === "bio") {
                    paginaPrincipal = "bio.php";
                }
                if (carpeta === "merch") {
                    document.location.href = "http://minorityofonehc.bandcamp.com/merch";
                }

                if (carpeta === "media") {
                    carpeta = "media";
                    paginaPrincipal = "media.php";

                } else if (carpeta == "media") {
                    carpeta = "";
                }
                if (carpeta === "news") {
                    carpeta = "Noticias";
                }
                if (carpeta === "tours") {
                    carpeta = "Tours";
                }
                $("#titulo").html(carpeta);
                if (dato == 852456753159) {
                    dato = 0;
                }

                var parametrosGlobal = {
                    pagina: paginaPrincipal,
                    datos: {tabla: carpeta, pagina: dato},
                    funcionFinal: addPrincipal
                };
                funcion(parametrosGlobal);
                $("#noticiasButtonID").unbind("click");
                $("#noticiasButtonID").click(function(e) {
                    e.preventDefault();
                    tinyMCE.triggerSave();
                    var parametros = {
                        pagina: "insertarNoticias.php",
                        datos: {dato: $("#elm1").val(), tabla: carpeta},
                        funcionFinal: llamarPagina,
                        parametro: parametrosGlobal
                    };
                    llamarPagina(parametros);
                })





                //            $("#menu #menu1").click(function(e) {
                //                e.preventDefault();
                //                llamarPagina("media.php", false, false, false);
                //                history.pushState("", document.title, 'media');
                //
                //            });


                $("#cssmenu #menu0").click(function(e) {
                    $("#titulo").html("News");
                    $("#cssmenu li").removeClass("active");
                    $(this).parent().addClass("active");
                    var parametros1 = {
                        pagina: "mostrarNoticias.php",
                        datos: {tabla: "Noticias", pagina: 0},
                        funcionFinal: addPrincipal
                    };
                    e.preventDefault();
                    llamarPagina(parametros1);
                    history.pushState({tabla: "Noticias", pagina: 0}, document.title, 'news');
                    $("#noticiasButtonID").unbind("click");
                    $("#noticiasButtonID").click(function(e) {
                        e.preventDefault();
                        tinyMCE.triggerSave();
                        var parametros2 = {
                            pagina: "insertarNoticias.php",
                            datos: {dato: $("#elm1").val(), tabla: "Noticias"},
                            funcionFinal: llamarPagina,
                            parametro: parametros1
                        };
                        llamarPagina(parametros2);
                    })
                });

                $("#cssmenu #menu1").click(function(e) {
                    $("#titulo").html("Bio");
                    $("#cssmenu li").removeClass("active");
                    $(this).parent().addClass("active");
                    var parametros1 = {
                        pagina: "bio.php",
                        datos: {},
                        funcionFinal: addPrincipal
                    };
                    e.preventDefault();
                    llamarPaginaSimple(parametros1);
                    history.pushState({tabla: false, pagina: false}, document.title, 'bio');
                    $("#noticiasButtonID").unbind("click");
                });
                $("#cssmenu #menu2").click(function(e) {
                    $("#titulo").html("Media");
                    $("#cssmenu li").removeClass("active");
                    $(this).parent().addClass("active");
                    var parametros1 = {
                        pagina: "media.php",
                        datos: {},
                        funcionFinal: addPrincipal
                    };
                    e.preventDefault();
                    llamarPaginaSimple(parametros1);
                    history.pushState({tabla: false, pagina: false}, document.title, 'media');
                    $("#noticiasButtonID").unbind("click");
                });
                $("#cssmenu #menu3").click(function(e) {
                    $("#titulo").html("Shows/Tours");
                    $("#cssmenu li").removeClass("active");
                    $(this).parent().addClass("active");
                    var parametros1 = {
                        pagina: "mostrarNoticias.php",
                        datos: {tabla: "Tours", pagina: 0},
                        funcionFinal: addPrincipal
                    };
                    e.preventDefault();
                    llamarPagina(parametros1);
                    history.pushState({tabla: "Tours", pagina: 0}, document.title, 'tours');
                    $("#noticiasButtonID").unbind("click");
                    $("#noticiasButtonID").click(function(e) {
                        e.preventDefault();
                        tinyMCE.triggerSave();
                        var parametros2 = {
                            pagina: "insertarNoticias.php",
                            datos: {dato: $("#elm1").val(), tabla: "Tours"},
                            funcionFinal: llamarPagina,
                            parametro: parametros1
                        };
                        llamarPagina(parametros2);
                    })
                });
                $("#cssmenu #menu4").click(function(e) {
                    $("#titulo").html("Contact");
                    $("#cssmenu li").removeClass("active");
                    $(this).parent().addClass("active");
                    var parametros1 = {
                        pagina: "contact.php",
                        datos: {tabla: "Noticias", pagina: 0},
                        funcionFinal: addPrincipal
                    };
                    e.preventDefault();
                    llamarPaginaSimple(parametros1);
                    history.pushState({}, document.title, 'contact');
                    $("#noticiasButtonID").unbind("click");
                });
                $("#cssmenu #menu5").click(function(e) {
                    document.location.href = "http://minorityofonehc.bandcamp.com/merch";
                });

                onpopstate = function(event) {

                    var parametros = {
                        pagina: "mostrarNoticias.php",
                        datos: {tabla: event.state.tabla, pagina: event.state.pagina, modo: 2},
                        funcionFinal: addPrincipal
                    };
                    llamarPagina(parametros);
//                    $("#paginacion li").removeClass("paginaActiva");
//                    $("#pagina" + event.state.pagina).addClass("paginaActiva");
                }


            });

        </script>

    </head>
    <body>
        <div id="loading" class="loading"><div class="loadingIMG"></div></div>
        <div id="wrap">

            <header>
                <div class="headerImagenArriba" id="headerImagenArribaID">
                    <div id="cssmenu">
                        <ul>
                            <li><a  id="menu0"><span>NEWS</span></a></li>
                            <li><a  id="menu1"><span>BIO</span></a></li>
                            <li> <a  id="menu2"><span>MEDIA</span></a></li>
                            <li> <a  id="menu3"><span>SHOWS/TOURS</span></a></li>
                            <li> <a  id="menu5"><span>MERCH</span></a></li>
                            <li class='last' > <a  id="menu4"><span>CONTACT</span></a></li>
                        </ul>
                    </div>


                </div>
                <div class="headerImagenAbajo" id="headerImagenAbajoID">

                    <div class="contenedorBody">
                        <div class="sectionControl" id="sectionControlID" style="<?php
                        if ($_GET["dato"] != 852456753159) {
                            echo "display:none;";
                        }
                        ?>">
                            <form method="post" id="noticiasFormID">
                                <input type="button"  value="Post!" id="noticiasButtonID" style="width: 400px; height: 50px;">
                                <textarea id="elm1" name="noticia"></textarea>
                            </form>
                        </div>
                        <div class="sectionPrincipal" >
                            <div class="titulo" id="titulo"></div>
                            <hr>
                            <div id="sectionPrincipalID"></div>
                        </div>
                        <div class="sectionDerecha" id="sectionDerechaID">
                            <div class="fb-like-box" data-href="https://www.facebook.com/pages/Minority-Of-One/323307364381263" data-height="500" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="true" data-show-border="false"></div>
                        </div>
                        <div class="sectionDerecha" id="sectionDerechaID" style="clear:right;">
                            <a class="twitter-timeline" href="https://twitter.com/MinorityOfOneHC" data-widget-id="432917960684875776">Tweets por @MinorityOfOneHC</a>
                            <script>!function(d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                                    if (!d.getElementById(id)) {
                                        js = d.createElement(s);
                                        js.id = id;
                                        js.src = p + "://platform.twitter.com/widgets.js";
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }
                                }(document, "script", "twitter-wjs");</script>
                        </div>
                        <div class="paginacionContenedor">
                            <div id="paginacionContenedor"  style="list-style-type: none;">

                            </div>
                            <div style="display:none;">Página <div id="numPagina" style="float:right">1</div></div> 
                        </div>
                    </div>
                </div>
            </header>
            <div class="cuerpoDegradado"></div>
            <div class="cuerpoFondo" id="cuerpoImagenID">


            </div>


            <footer>

            </footer>
        </div>
    </body>
</html>
<?php
if ($_GET["dato"] == 852456753159) {
    ?>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea#elm1",
            theme: "modern",
            width: window.screen.width - 500,
            height: 300,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
        });
    </script>
    <?php
}
?>