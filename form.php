<?php

if($_SERVER["REQUEST_METHOD"] === "POST" ){ 
    
    $uploadDir = 'uploads/';
    
    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $fileUniqueName = uniqid('', true) . '.' . $extension;

    $uploadFile = $uploadDir . basename($fileUniqueName);

    $authorizedExtensions = ['jpg','gif','png', 'webp'];
    $maxFileSize = 1000000;

    $errors = [];

    if( (!in_array($extension, $authorizedExtensions))){
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Gif ou Png ou Webp !';
    }
    if(file_exists($_FILES['image']['tmp_name']) && filesize($_FILES['image']['tmp_name']) > $maxFileSize)
    {
    $errors[] = "Votre fichier doit faire moins de 1M !";
    }

    if (!empty($errors)) {
        foreach($errors as $error){
            echo $error;
        }
     } else {
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);
     }  
    
}

// var_dump($_FILES);
// var_dump($_POST);

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload quest</title>
</head>
<body>


<form action="form.php" method="post" enctype="multipart/form-data">
    <label for="image">Votre image</label>
    <input type="file" name="image">
    <button type="submit">Soumettre</button>

</form>


</body>
</html>
