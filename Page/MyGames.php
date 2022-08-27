<?php
$imageHTML = "";
$dir = new DirectoryIterator(dirname("../Assets/GamesImages/*"));
foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        $directoryPath = $fileinfo->getPath()."/".$fileinfo->getFilename()."/*";
        //echo var_dump($fileinfo->getFilename());
        $dir2 = new DirectoryIterator(dirname($directoryPath));
        $imageHTML .= "<h2>".$fileinfo->getFilename()."</h2>";
        foreach ($dir2 as $image)
        {
            if (!$image->isDot()) {
                $filePath = $image->getPath()."/".$image->getFilename()."";
                //echo $filePath;
                $imageHTML .= '<img src="'.$filePath.'"style="height:600px;" ><br />';
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
    <h1>My Games</h1>
    <h2><a href="HomePage.php">Back Home</a></h2>
    <h2>My Game Images</h2>
    <?php
    echo $imageHTML;
    ?>

</div>

</body>


</html>