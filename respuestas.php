<!DOCTYPE html>
<html>
<head>
    <title>Consultar Respuestas</title>
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
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nombre</th>";
            echo "<th>Email</th>";
            echo "<th>Tema</th>";
            echo "<th>Mensaje</th>";
            echo "<th>Fecha</th>";
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
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay respuestas</td></tr>";
            }
            $conn->close();

            echo "</table>";
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