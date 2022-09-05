<!DOCTYPE html>
<?php
if (isset($_POST['username']))
{
    $v = var_dump($_POST, true);
    $v = $_POST['username'];
    echo "<p>$v</p>";
}

if (isset($_GET['expired']))
{
    echo '<p>Your Session Has Expired</p>';
    if (isset($_COOKIE['session_test']))
    {
        $v = $_COOKIE['session_test'];
        echo "<p>$v</p>";
    }
}
if (isset($_POST['username']))
{
    session_start();
    //session_name('session_test');
    if ('admin' == $_POST['username'] && 'admin' == $_POST['password'])
    {
        $_SESSION['authenticated'] = true;
        $_SESSION['authentication'] = time();
        header('Location: dashboard.php');
        exit;
    }
    else
    {
        echo "<p>User Details invalid for {$_POST['username']}</p>";
    }
    
}
else
{
    echo "<p>Please Login</p>";
}
?>

<html>
<head><title>login page</title><br>
    <link rel="stylesheet" href="../Assets/CSS/HomePage.css" type="text/css">
</head>
<body>


<form action="login.php" method="post" name="login">

<label for="user" >user:</label><input type ="text" value="" name="username"><br><br>
<label for="password" >password:</label><input type ="text" value="" name="password"><br><br>
<input type = "submit"><br>
</form>

</body>

</html>
