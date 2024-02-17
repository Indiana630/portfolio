<?php
$servername = "localhost";
$username = "formulario";
$password = "P4ssw0rd";
$dbname = "formulariodb";

// Procesar los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$tema = $_POST['tema'];
$mensaje = $_POST['mensaje'];

// Guardar los datos en la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "INSERT INTO respuestas (nombre, email, tema, mensaje) VALUES ('$nombre', '$email', '$tema', '$mensaje')";
if ($conn->query($sql) === TRUE) {
    echo "Respuesta guardada en la base de datos correctamente";
} else {
    echo "Error al guardar la respuesta en la base de datos: " . $conn->error;
}
$conn->close();

// Enviar mensaje a Discord a través de la webhook (reemplaza la URL con la tuya)
$webhook_url = 'https://discord.com/api/webhooks/1208370304460791848/US3n3sX5AJc_qUMIGAR0DBa0Bjqz14gSHwmraCG0Dkj12noEcmVq7UYuxJd9Z369hPur';
$message = "Nuevo mensaje recibido:\nNombre: $nombre\nEmail: $email\nTema: $tema\nMensaje: $mensaje";

$data = array('content' => $message);
$curl = curl_init($webhook_url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$response = curl_exec($curl);
curl_close($curl);

// Manejo de la respuesta de Discord (puedes hacer algo con ella si lo necesitas)
var_dump($response);

header("Location: pages/enviado.htm");

?>
