<?php
require '../Assets/Database/DatabaseConnection.php';
include "../Assets/PHPScripts/Include.php";
$dbConnect = DatabaseConnection::GetInstance();
$ProjectPageFromDB = "";
$selectedLanguage = "All";
if (count($_POST) >0)
{
    if($_POST['o_language'] != "")
    {
        $_SESSION['language'] = $_POST['o_language'];
        $selectedLanguage = $_POST['o_language'];
        $result = $result = $dbConnect->GetProjectsByLanguage($_POST['o_language']);
        $_SESSION['projects'] = $result;
        echo "post selected";

    }
    else
    {
        echo "missing key";
        $result = $dbConnect->GetProjectsAll();
    }
}
elseif ($_SESSION['projects'] != "")
{
    echo "session selected";
    $result = $_SESSION['projects'];
    $selectedLanguage = $_SESSION['language'];
}
else
{
    echo "non selected";
    $result = $dbConnect->GetProjectsAll();
}
$languages = $dbConnect->GetLanguages();

function Selected($value): string
{
    global $selectedLanguage;
    if ($selectedLanguage == $value)
    {
        return "selected=\"selected\"";
    }
    return "";
}

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
    <div>
        <form action="MyProjects.php" method="post" >
            <label for="lbl_language" >Select Language</label>
            <select name="o_language">
                <option <?=Selected("All")?> value="All">All</option>
                <?php for ($i = 0; $i < Count($languages); $i++) :?>
                    <option <?=Selected($languages[$i])?> value="<?= $languages[$i]; ?>"><?= $languages[$i]; ?></option>
                <?php endfor; ?>
            </select><br><br>
            <input type="submit"><br>

        </form>

    </div>
    <h2>Projects</h2>
    <?php
    echo $result;
    ?>

</div>

</body>
</html>
