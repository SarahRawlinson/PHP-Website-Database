<?php

$youTubeLink = "https://www.youtube.com/channel/UCZzctauCe1sxTTCsK93Tlmw";
$itchLink = "https://sarahrawlinson.itch.io/";
$gitHubLink = "https://github.com/SarahRawlinson";
$name = "Sarah Rawlinson";
//<script src="../JavaScript/HomPage.js">

?>

<!DOCTYPE html>
<html>

<head><title><?php echo $name."'s Home Page" ?></title><br>
    <link rel="stylesheet" href="../Assets/CSS/HomePage.css" type="text/css">
</head>

<body>
<h1><?php echo $name."'s Home Page" ?></h1>

    <h2>Links</h2>
    <a href="<?php echo $youTubeLink ?>">YouTube</a><br><br>
    <a href="<?php echo $itchLink ?>">itch.io</a><br><br>
    <a href="<?php echo $gitHubLink ?>">GitHub</a><br><br>
<h2>Pages</h2>
<a href="MyGames.php">My Games</a> <br><br>
<a href="MyProjects.php">My Projects</a> <br><br>
<a href="Form.php">My Form</a> <br><br>
<br><br><br>
<h2 id="WhatImDoing"></h2>
<br><br>

<script src="../JavaScript/HomPage.js">
</script>

</body>


</html>