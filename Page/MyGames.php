<?php
include "../Assets/PHPScripts/Include.php";
$imageHTML = "";
$dir = new DirectoryIterator(dirname("../Assets/GamesImages/*"));
foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        $directoryPath = $fileinfo->getPath()."/".$fileinfo->getFilename()."/*";
        //echo var_dump($fileinfo->getFilename());
        $dir2 = new DirectoryIterator(dirname($directoryPath));
        $imageHTML .= "<h3>".$fileinfo->getFilename()."</h3><br><br>";
        foreach ($dir2 as $image)
        {
            if (!$image->isDot()) {
                $filePath = $image->getPath()."/".$image->getFilename();
                //echo $filePath;
                $imageHTML .= '<img src="'.$filePath.'"style="height:600px;" ><br><br><br>';
            }
        }

    }
}
?>

<!DOCTYPE html>
<html>

<head><title>My Games</title>
    <link rel="stylesheet" href="../Assets/CSS/HomePage.css" type="text/css">
</head>
<body>
<div id="Header">
    <h1>My Games</h1><br><br><br><br>
    <a href="HomePage.php">Back Home</a><br><br><br><br>
    <h2>My Game Images</h2><br><br><br><br>
    <?php
    echo $imageHTML;
    ?>

</div>

</body>


</html>