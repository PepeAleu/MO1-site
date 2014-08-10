<div class="pure-form pure-form-stacked formulario">
    <fieldset>
        <!--        <legend>Contact form</legend>-->
        <label for="emailDestinatario">To:</label>
        <select id="emailDestinatario">
            <option>info@minorityofone.org</option>
            <option>booking@minorityofone.org</option>
            <option>jose@minorityofone.org</option>
            <option>angel@minorityofone.org</option>
            <option>fede@minorityofone.org</option>
            <option>javi@minorityofone.org</option>
            <option>adri@minorityofone.org</option>
        </select>

        <label for="nombre">Your Name</label>
        <input id="nombre" type="text" placeholder="Name">

        <label for="email">Your E-mail</label>
        <input id="email" type="email" placeholder="E-mail">

        <label for="asunto">Subject</label>
        <input id="asunto" type="text" placeholder="Subject">

        <label for="mensaje">Message</label>
        <textarea id="mensaje" type="text" placeholder="Message"></textarea> 
        <div class="avisoSucess" id="avisoSucess">The email has been sent successfully<div class="cerrarSucess" id="cerrarAvisoSucess" ></div></div>
        <div class="avisoFail" id="avisoFail">fill in all the fields<div class="cerrarFail" id="cerrarAvisoFail" ></div></div>
        <button id="emailButtonID" type="button" class="pure-button pure-button-primary">Send</button>
    </fieldset>
</div>
<script type="text/javascript">

    function mostrarAviso(id, velocidad) {
        if (!velocidad) {
            velocidad = "slow";
        }
        console.log("ID " + id);
        console.log("velocidad " + velocidad);
        $(id).fadeIn(velocidad);
    }
    function cerrarAviso(id, velocidad) {
        if (!velocidad) {
            velocidad = "slow";
        }
        console.log("ID " + id);
        console.log("velocidad " + velocidad);
        $(id).fadeOut(velocidad)
    }
    $("#emailButtonID").click(enviarEmail);
//    $("#emailButtonID").bind("click",enviarEmail);
    $("#cerrarAvisoSucess").click(function() {
        cerrarAviso("#avisoSucess")
    });
    $("#cerrarAvisoFail").click(function() {
        cerrarAviso("#avisoFail")
    });

    function enviarEmail() {
        if ($("#nombre").val() && $("#email").val() && $("#asunto").val() && $("#mensaje").val()) {
            var datos = {
                emailDestino: $("#emailDestinatario").val(),
                nombre: $("#nombre").val(),
                email: $("#email").val(),
                asunto: $("#asunto").val(),
                mensaje: $("#mensaje").val()
            }
            cerrarAviso("#avisoFail");
            var parametros = {pagina: "enviarEmail.php", datos: datos, funcionFinal: mostrarAviso, parametro: "#avisoSucess"};
            llamarPaginaSimple(parametros);
        } else {
            cerrarAviso("#avisoSucess", false);
            mostrarAviso("#avisoFail", false);
        }
    }



//        tinymce.init({
//            selector: "textarea#elm2",
//            theme: "modern",
//            width: window.screen.width - 500,
//            height: 300,
//            style_formats: [
//                {title: 'Bold text', inline: 'b'},
//                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
//                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
//                {title: 'Example 1', inline: 'span', classes: 'example1'},
//                {title: 'Example 2', inline: 'span', classes: 'example2'},
//                {title: 'Table styles'},
//                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
//            ]
//        });
</script>