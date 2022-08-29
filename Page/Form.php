<?php
?>
<!DOCTYPE html>

<html>
<head><title>My From</title><br>
    <link rel="stylesheet" href="../Assets/CSS/HomePage.css" type="text/css">
</head>
<body>
<div id="Header">
    <h1>My Form</h1>
    <h2><a href="HomePage.php">Back Home</a></h2>
    <h2>User Form</h2>
    <form action="DisplayForm.php" method="post">

        <label for="lname" >Name:</label><input type ="text" value="Please enter your name" name="iname"><br><br>
        <label for="lemail" >Email:</label><input type = "text" value="Please enter your email" name="iemail"><br><br>
        <label for="lcontact" >Contact Me:</label><br><br>
        Yes <input type = "radio" name="icontact" value="Yes" checked="checked"><br><br>
        No <input type = "radio" name="icontact" value="No"><br><br>
        <label for="lcomment" >Comments:</label><br><br>
        <textarea name="icomments"></textarea><br><br>
        <input type = "submit"><br>

    </form>

</div>

</body>

</html>
