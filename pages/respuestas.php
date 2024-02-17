
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../estilo.css">
    <link rel="icon" type="icon" href="../img/logo.png">
    <title>Pepe Cabeza</title>
    <script>
        function submitForm(action) {
            document.getElementById('form_action').value = action;
            document.getElementById('consultar_respuestas_form').submit();
        }
    </script>
</head>

<body>
    <!-- SECCION I N I C I O --> 
    <section id="inicio">
        <div class="contenido">
            <header>
                <div class="contenido-header">
                    <img src="img/logo.png" alt="">
                    <h1>Pepe</h1>

                    <!-- Icono del menu responsive -->
                    <div id="icono-nav" onclick="responsiveMenu()">
                        <i class="fa-solid fa-bars"></i>
                    </div>


                    <div class="redes">
                        <a href="https://wa.me/34623226544"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="https://discord.gg/4YPu2xwMj3"><i class="fa-brands fa-discord"></i></a>
                        <a href="https://www.instagram.com/pepeccz/"><i class="fa-brands fa-instagram-square"></i></a>
                        <a href="https://github.com/Indiana630/"><i class="fa-brands fa-github"></i></a>
                    </div>
                </div>
            </header>
            <div class="presentacion">
                <?php
                    // Verifica si se ha enviado el formulario de inicio de sesión
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_login"])) {
                        $password = $_POST["password"];

                        // Verifica la contraseña maestra
                        if ($password == "P4ssw0rd") { // Reemplaza "tu_contraseña_maestra" con tu contraseña real
                            // Si la contraseña es correcta, muestra las respuestas
                            echo "<h2>Respuestas del Formulario</h2>";
                            echo "<form id='consultar_respuestas_form' action='' method='post'>";
                            echo "<input type='hidden' name='password' value='$password'>";
                            echo "<input type='hidden' name='form_action' id='form_action'>";
                            echo "<table>";
                            echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>Nombre</th>";
                            echo "<th>Email</th>";
                            echo "<th>Tema</th>";
                            echo "<th>Mensaje</th>";
                            echo "<th>Fecha</th>";
                            echo "<th>Acción</th>";
                            echo "</tr>";

                            // Conexión a la base de datos para obtener las respuestas
                            $servername = "localhost";
                            $username = "formulario";
                            $password = "P4ssw0rd";
                            $dbname = "formulariodb";

                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }

                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["form_action"]) && $_POST["form_action"] == "borrar") {
                                // Si se ha enviado un formulario para borrar una fila
                                if (isset($_POST["borrar"])) {
                                    $id_borrar = $_POST["borrar"];
                                    // Eliminar la fila de la base de datos
                                    $sql_delete = "DELETE FROM respuestas WHERE id=$id_borrar";
                                    if ($conn->query($sql_delete) === TRUE) {
                                        echo "<p>La fila con ID $id_borrar ha sido eliminada exitosamente.</p>";
                                    } else {
                                        echo "<p>Error al eliminar la fila: " . $conn->error . "</p>";
                                    }
                                }
                            }

                            $sql = "SELECT * FROM respuestas";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>".$row["id"]."</td>";
                                    echo "<td>".$row["nombre"]."</td>";
                                    echo "<td>".$row["email"]."</td>";
                                    echo "<td>".$row["tema"]."</td>";
                                    echo "<td>".$row["mensaje"]."</td>";
                                    echo "<td>".$row["fecha"]."</td>";
                                    echo "<td><button type='button' onclick='submitForm(\"borrar\")' name='borrar' value='".$row["id"]."'>Borrar</button></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No hay respuestas</td></tr>";
                            }
                            $conn->close();

                            echo "</table>";
                            echo "</form>";
                        } else {
                            // Si la contraseña es incorrecta, muestra un formulario de inicio de sesión
                            echo "<p>Contraseña incorrecta. Inténtalo de nuevo.</p>";
                            echo "<form action='' method='post'>";
                            echo "<label for='password'>Contraseña:</label>";
                            echo "<input type='password' id='password' name='password'>";
                            echo "<input type='submit' name='submit_login' value='Iniciar Sesión'>";
                            echo "</form>";
                        }
                    } else {
                        // Muestra el formulario de inicio de sesión si no se ha enviado
                        echo "<form action='' method='post'>";
                        echo "<label for='password'>Contraseña:</label>";
                        echo "<input type='password' id='password' name='password'>";
                        echo "<input type='submit' name='submit_login' value='Iniciar Sesión'>";
                        echo "</form>";
                    }
                ?>
            </div>  
        </div>
    </section>

    <!-- SECCION FOOTER --> 
    <footer>
        <p>Todos los derechos reservados - 2024</p>
        <div class="redes">
            <a href="https://wa.me/34623226544"><i class="fa-brands fa-whatsapp"></i></a>
            <a href="https://discord.gg/4YPu2xwMj3"><i class="fa-brands fa-discord"></i></a>
            <a href="https://www.instagram.com/pepeccz/"><i class="fa-brands fa-instagram-square"></i></a>
            <a href="https://github.com/Indiana630/"><i class="fa-brands fa-github"></i></a>
        </div>

    </footer>       

    <script src="script.js"></script>
</body>

</html>