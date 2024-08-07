<?php

// Read the JSON file
$data = json_decode(file_get_contents('data.json'), true);

if (isset($_POST['post'])) {
    $blogTitle = $_POST['title'];
    $blogContent = $_POST['content'];
	$blogBaseURL = "./read.php";
	$blogID = count($data) + 1;
    
    $newPost = array(
		"id" => $blogID,
		"time" => time(),
        "title" => $blogTitle,
        "content" => $blogContent,
		"link" => $blogBaseURL . "?id=" . $blogID,
		"image" => ""
    );
	//print_r($newPost);
    array_push($data, $newPost);

    file_put_contents('data.json', json_encode($data, JSON_PRETTY_PRINT));

    // Mostrar mensaje de confirmación
    	echo '<p>Posted sucessfully. Refresh to see changes.</p>';
    };

	$currentMethod = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
	$currentUrl = $currentMethod . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>motherfucking blog</title>
</head>
<body>
    <h1>welcome to a motherfucking blog</h1>

    <?php
	    if ($data) {
	        foreach (array_reverse($data) as $upload) {
				echo '<br>';
				echo '<img src="' . $upload['image'] . '">';
	            echo '<h2>' . $upload['title'] . '</h2>';
				echo '<p><small>' . date("d/m/Y", $upload['time']) . '</small><p>';
				echo '<p>' . substr($upload['content'], 0, 77) . '... <a href="' . $upload['link'] . '">Read more</a></p>';
				echo '<br>';
	        }
	    } else {
	        echo '<br><p>There are no posts yet.</p><br>';
	    }
    ?>

	<br>
	
	<form method="post">
        <label for="title">Title:</label><br>
		<textarea name="title" id="title" rows="1" cols="50" required></textarea><br><br>

        <label for="content">Content:</label><br>
		<textarea name="content" id="content" rows="4" cols="50" required></textarea><br><br>

        <button type="submit" name="post">Post</button>
    </form>
</body>
</html>