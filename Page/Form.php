<?php

include "../Assets/PHPScripts/Include.php";
if (count($_POST) >0)
{
    if($_POST['icomments'] != "")
    {
        $_SESSION['formWasPosted'] = 'yes';
        $_SESSION['formData'] = $_POST;
        header('Location: DisplayForm.php');
    }
    else
    {
        $commentsError = "validation";
    }
}


?>
<!DOCTYPE html>

<html>
<head><title>My From</title><br><br><br>
    <link rel="stylesheet" href="../Assets/CSS/HomePage.css" type="text/css">
</head>
<body>
<div id="Header">
    <h1>My Form</h1><br><br>
    <a href="HomePage.php">Back Home</a><br><br><br><br>
    <h2>User Form</h2><br><br>
    <form action="Form.php" method="post">

        <label for="lname" >Name:</label><input type ="text" value="Please enter your name" name="iname"><br><br>
        <label for="lemail" >Email:</label><input type = "text" value="Please enter your email" name="iemail"><br><br>
        <label for="lcontact" >Contact Me:</label><br><br>
        <label>Yes</label> <input type = "radio" name="icontact" value="Yes" checked="checked"><br><br>
        <label>No</label> <input type = "radio" name="icontact" value="No"><br><br>
    <div class="<?=$commentsError?>">
        <label for="lcomment" >Comments:</label><br><br>
        <textarea name="icomments"></textarea><br><br>
    </div>

        <input type = "submit"><br>

    </form>

</div>

</body>

</html>
