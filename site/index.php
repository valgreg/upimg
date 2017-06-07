<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "Visiblement c'est une image.<br>";
        $uploadOk = 1;
    } else {
        echo "Je sais reconnaitre une image quand j'en vois une, et ça c'est pas une image.<br>";
        $uploadOk = 0;
    }

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Désolé, une image portant le même nom existe déjà.<br>";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Désolé, l'image est trop lourde, je ne peux pas la transporter.<br>";
        $uploadOk = 0;
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "jpeg") {
        echo "Désolé, seulemement les  JPG, JPEG sont autorisées.<br>";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Désolé, l'image n'a pas été envoyé.<br>";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "L'image ". basename( $_FILES["fileToUpload"]["name"]). " a bien été envoyé.<br>";
        } else {
            echo "Désolé, il y a eu une erreur dans le transfert, si le problème persiste contactez l'administrateur du site.<br>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
        Veuillez choisir une image svp :
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Envoyer l'image" name="submit">
</form>

</body>
</html>



