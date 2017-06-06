<!DOCTYPE html>
<?php
include './include/conexion/conexion.php';
include './include/conexion/querys.php';
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Login</title>

        <!-- Bootstrap core CSS -->
        <link href="include/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="include/css/signin.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="include/js/jquery.validate.min.js"></script>
        <script type="text/javascript">
            $("#ingreso").hide();
            jQuery(document).ready(function ($) {
                window.name = "";
                // Reveal Login form
                setTimeout(function () {
                    $(".fade-in-effect").addClass('in');
                }, 1);
                $("form#login").validate({
                    rules: {
                        nick: {required: true},
                        pass: {required: true}
                    },
                    messages: {
                        name: {required: 'Por favor ingrese su usuario.'},
                        password: {required: 'Por favor ingrese su contraseña.'}
                    },
                    submitHandler: function (form) {
                        $.ajax({
                            url: "libs/select.php",
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                tag: 'getInfo',
                                nick: $(form).find('#inputNick').val(),
                                pass: $(form).find('#inputPassword').val(),
                            },
                            success: function (resp) {
                                if (resp.length > 0) {
                                    $("#formulario").hide();
                                    $("#ingreso").show();
                                    $("#ingreso").append("<h2 class='form-signin-heading' id='nombre'>Bienvenido " + resp[0].nombre + "</h2><br><button type='submit' class='btn btn-lg btn-primary btn-block' onclick='location.reload();'>Salir</button>");
                                } else {
                                    alert("Usuario o contraseña incorrecto");
                                }
                            }
                        });
                    }
                });
            });
        </script>
    </head>

    <body>
        <script>
            window.fbAsyncInit = function () {
                FB.init({
                    appId: '1694208874217923',
                    cookie: true,
                    xfbml: true,
                    version: 'v2.8'
                });
                FB.AppEvents.logPageView();
            };

            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
            
            
            function checkLoginState() {
                FB.getLoginStatus(function (response) {
                    statusChangeCallback(response);
                });
            }
            
            function statusChangeCallback(response){
                if (response.status === "connected") {
                    FB.api('/me', function(response) {
                        $("#formulario").hide();
                        $("#ingreso").show();
                        $("#ingreso").append("<h2 class='form-signin-heading' id='nombre'>Bienvenido " + response.name + "</h2><br><button type='submit' class='btn btn-lg btn-primary btn-block' onclick='location.reload();'>Salir</button>");
                    });
                }
            }
        </script>
        
        <div class="container" id="formulario">

            <form method="post" role="form" id="login" class="form-signin">
                <h2 class="form-signin-heading">MyAppSotfware</h2>
                <label for="inputNick" class="sr-only">Nick:</label>
                <input type="text" name="nick" id="inputNick" class="form-control" placeholder="Usuario" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Contraseña" required>
                <button type="submit" class="btn btn-lg btn-primary btn-block">Ingresar</button>
                <br>
                <fb:login-button 
                    scope="public_profile,email"
                    onlogin="checkLoginState();">
                </fb:login-button>
            </form>

        </div> <!-- /container -->

        <div class="container" id="ingreso">
            
        </div> <!-- /container -->
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="include/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
