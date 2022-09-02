<?php

include "../Assets/PHPScripts/Include.php";
//$val = "<pre>";
//$val .= print_r($_SESSION['formData'], true);
//$val .= "</pre>";

if (isset($_SESSION['formData']))
{
    $formData = $_SESSION['formData'];
    //session_destroy(); //will kill all session details not recommended in this instance
    unset($_SESSION['formData']);
}
else
{
    header('Location: Form.php');
}


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
    <label for="lname" >Name:</label> <label><?=$formData['iname']?></label> <br><br>
    <label for="lemail" >Email:</label> <label><?=$formData['iemail']?></label>  <br><br>
    <label for="lcontact" >Contact Me:</label><br><br>
    <label><?=$formData['icontact']?></label><br><br>
    <label for="lcomment" >Comments:</label><br><br>
    <label><?=$formData['icomments']?></label>
<!--    <h2>--><?php //echo $val ?><!--</h2>-->


</div>

</body>

</html>
