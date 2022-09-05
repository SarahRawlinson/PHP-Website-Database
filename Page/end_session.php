
<?php
$inactivity_limit = 2;

session_start();
if (!isset($_SESSION['authenticated']))
{
    header('Location: login.php');
    exit;
}
elseif ($_SESSION['authentication'] + $inactivity_limit < time())
{
    $_SESSION = [];
    $d = date('d/m/Y : H:sA',time());
    $dt = new DateTime('now');
    $dt->add(new DateInterval('PT1H'));
    if (isset($_COOKIE[session_name()])) 
    {        
        setcookie(session_name(), "session expired {$d}", time() - 86400, '/');
    }
    setcookie('session_test', "session expired {$d}", $dt->getTimestamp(), '/');
    session_destroy();
    header('Location: login.php?expired=true');
}
else
{
    $_SESSION['authentication'] = time();
}
?>

