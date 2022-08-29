<?php

$val = "<pre>";
$val .= print_r($_POST, true);
$val .= "</pre>";

?>

<!DOCTYPE html>

<html>
<head><title>Display Form</title><br>
    <link rel="stylesheet" href="../Assets/CSS/HomePage.css" type="text/css">
</head>
<body>
<div id="Header">
    <h1>Display Form</h1>
    <h2><a href="HomePage.php">Back Home</a></h2>
    <h2><?php echo $val ?></h2>


</div>

</body>

</html>
