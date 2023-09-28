<!DOCTYPE html>
<html>
<head>
    <title>Resultado de la Búsqueda</title>
</head>
<body>
    <h1>Resultado de la Búsqueda</h1>
    <?php
    // Conexión a la base de datos
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "textilexbase";

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener el término de búsqueda
    $query = $_GET["query"];

    // Consulta SQL para buscar productos
    $sql = "SELECT * FROM product WHERE name LIKE '%$query%' OR image LIKE '%$query%' OR code LIKE '%$query%'";
    $result = $conn->query($sql);

    // Mostrar resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>ID:</strong> " . $row["id"] . "<br>";
        echo "<strong>Nombre:</strong> " . $row["name"] . "<br>";
        echo "<strong>Código:</strong> " . $row["code"] . "<br>";

        // Mostrar imagen en tamaño pequeño
        echo "<img src='" . $row["image"] . "' alt='Imagen del producto' style='max-width: 200px;'><br>";

        echo "<strong>Precio:</strong> $" . $row["price"] . "</p>";

        // Agregar botón para quitar la imagen
        echo "<button class='remove-image'>Quitar Imagen</button><br>";

        // Agregar script para manejar el evento click del botón
        echo "<script>
                const removeButtons = document.querySelectorAll('.remove-image');
                removeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const image = this.previousElementSibling; // El elemento de imagen está justo antes del botón
                        image.style.display = 'none'; // Ocultar la imagen
                        this.style.display = 'none'; // Ocultar el botón
                    });
                });
              </script>";
    }
} else {
    echo "No se encontraron resultados.";
}

    // Cerrar conexión
    $conn->close();
    ?>
</body>
</html>