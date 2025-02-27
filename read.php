<?php

$jsonFile = 'data.json';
$data = json_decode(file_get_contents($jsonFile), true);

// Obtener el parámetro 'id' de la URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Buscar el artículo con el ID especificado
$article = null;
foreach ($data as $item) {
    if ($item['id'] === $id) {
        $article = $item;
        break;
    }
}

// Verificar si se encontró el artículo
if ($article) {
    // Mostrar el contenido del artículo
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($article['title']); ?></title>
    </head>
    <body>
        <h1><?php echo htmlspecialchars($article['title']); ?></h1>
        <p><small><?php echo date("d/m/Y", $article['time']); ?></small></p>
        <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="< Article image >">
        <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
        <a href="./index.php">< go back</a>
    </body>
    </html>
    <?php
} else {
    echo '<p>Article not found.</p>';
}
?>