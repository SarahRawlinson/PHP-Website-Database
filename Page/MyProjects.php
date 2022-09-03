<?php
require '../Assets/PHPScripts/Tags.php';
require '../Assets/Database/DatabaseConnection.php';
include "../Assets/PHPScripts/Include.php";
$dbConnect = DatabaseConnection::GetInstance();
$ProjectPageFromDB = "";
$selectedLanguage = "All";

if (count($_POST) >0)
{
    if($_POST[Tags::Language] != "")
    {
        $_SESSION[Tags::Language] = $_POST[Tags::Language];
        $selectedLanguage = $_POST[Tags::Language];
        $result = $dbConnect->GetProjectsByLanguage($_POST[Tags::Language]);
        $_SESSION[Tags::Projects] = $result;
        echo "post selected";

    }
    else
    {
        echo "missing key";
        $result = $dbConnect->GetProjectsAll();
    }
}
elseif ($_SESSION[Tags::Projects] != "")
{
    echo "session selected";
    $result = $_SESSION[Tags::Projects];
    $selectedLanguage = $_SESSION[Tags::Language];
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
    <h1>My Projects</h1><br><br><br><br>
    <a href="HomePage.php">Back Home</a><br><br><br><br>
    <div>
        <form action="MyProjects.php" method="post" >
            <label for="lbl_language" >Select Language</label>
            <select name=<?=Tags::Language?>>
                <option <?=Selected("All")?> value="All">All</option>
                <?php for ($i = 0; $i < Count($languages); $i++) :?>
                    <option <?=Selected($languages[$i])?> value="<?= $languages[$i]; ?>"><?= $languages[$i]; ?></option>
                <?php endfor; ?>
            </select><br><br>
            <input type="submit"><br>

        </form>

    </div><br><br><br><br>
    <h2>Projects</h2><br><br><br><br>
    <?php
    echo $result;
    ?>

</div>

</body>
</html>
