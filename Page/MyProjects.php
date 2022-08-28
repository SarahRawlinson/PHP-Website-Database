<?php
require '../Database/DatabaseConnection.php';
$dbConnect = DatabaseConnection::GetInstance();
$ProjectPageFromDB = "";
$result = $dbConnect->GetProjects();

?>

<!DOCTYPE html>
<html>

<head><title>My Projects</title>
    <link rel="stylesheet" href="../Assets/CSS/HomePage.css" type="text/css">
</head>

<body>
<div id="Header">
    <h1>My Projects</h1>
    <h2><a href="HomePage.php">Back Home</a></h2>
    <h2>Projects</h2>
    <?php
    echo $result;
    ?>

</div>

</body>
</html>
