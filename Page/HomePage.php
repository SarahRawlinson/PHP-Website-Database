<?php

$youTubeLink = "https://www.youtube.com/channel/UCZzctauCe1sxTTCsK93Tlmw";
$itchLink = "https://sarahrawlinson.itch.io/";
$gitHubLink = "https://github.com/SarahRawlinson";
$name = "Sarah Rawlinson";

?>

<!DOCTYPE html>
<html>

<head><title><?php echo $name."'s Home Page" ?></title><br>
    <link rel="stylesheet" href="../Assets/CSS/HomePage.css" type="text/css">
</head>
<h1><?php echo $name."'s Home Page" ?></h1>
<body>
<div id="Header">
</div>
<div id="Body">
    <form method="post" action="MyGames.php">
        <div>
            <h1></h1><label>Links</label><br><br></h1>
            <a href="<?php echo $youTubeLink ?>">YouTube</a><br><br>
            <a href="<?php echo $itchLink ?>">itch.io</a><br><br>
            <a href="<?php echo $gitHubLink ?>">GitHub</a><br><br>
        </div>
    </form>
</div>
<h2><a href="MyGames.php">My Games</a></h2>

</body>


</html>