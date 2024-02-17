<!DOCTYPE html>
<html>
<head>
    <title>Consultar Respuestas</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <?php
    // Verifica si se ha enviado el formulario de inicio de sesión
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $password = $_POST["password"];

        // Verifica la contraseña maestra
        if ($password == "P4ssw0rd") { // Reemplaza "tu_contraseña_maestra" con tu contraseña real
            // Si la contraseña es correcta, muestra las respuestas
            echo "<h2>Respuestas del Formulario</h2>";
            echo "<form action='' method='post'>";
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

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
                    echo "<td><button type='submit' name='borrar' value='".$row["id"]."'>Borrar</button></td>";
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
            echo "<input type='submit' value='Iniciar Sesión'>";
            echo "</form>";
        }
    } else {
        // Muestra el formulario de inicio de sesión si no se ha enviado
        echo "<form action='' method='post'>";
        echo "<label for='password'>Contraseña:</label>";
        echo "<input type='password' id='password' name='password'>";
        echo "<input type='submit' value='Iniciar Sesión'>";
        echo "</form>";
    }
    ?>
</body>
</html>
