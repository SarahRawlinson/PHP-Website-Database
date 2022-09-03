<?php
include "../Assets/PHPScripts/Include.php";
require '../Assets/PHPScripts/Tags.php';
require '../Assets/Database/DatabaseConnection.php';

$dbConnect = DatabaseConnection::GetInstance();
$ProjectPageFromDB = "";
$selectedLanguage = "All";
$selectedFeature = "All";
$keysForProject = array(Tags::ID, Tags::ProjectName, Tags::Directory, Tags::Details, Tags::Key_Words);

if ($_SESSION != null)
{
    session_destroy();
}

function ProjectsToHTML(array $projects) : string
{
    $projectsHTMLString = "";
    for ($i = 0; $i < count($projects); $i++)
    {
        $projectName = $projects[$i][Tags::ProjectName];
        $directory = $projects[$i][Tags::Directory];
        $keywords = $projects[$i][Tags::Key_Words];
        $id = $projects[$i][Tags::ID];
        $details = $projects[$i][Tags::Details];

        $projectsHTMLString .= "<h3>$projectName</h3><br><br><br>";
        $projectsHTMLString .= "<a href='$directory'>$projectName</a><br><br><br>";
        $projectsHTMLString .= "<p>$keywords</p><br><br><br>";
        $projectsHTMLString .= "<p>$details</p><br><br><br>";
    }

    return  $projectsHTMLString;
}

if (count($_POST) >0)
{
    if($_POST[Tags::Language] != "")
    {
        $_SESSION[Tags::Language] = $_POST[Tags::Language];
        $_SESSION[Tags::Feature] = $_POST[Tags::Feature];
        $selectedLanguage = $_POST[Tags::Language];
        $selectedFeature = $_POST[Tags::Feature];
        $result = ProjectsToHTML($dbConnect->GetProjectsByParameters($_POST[Tags::Language], $_POST[Tags::Feature], $keysForProject));
        $_SESSION[Tags::Projects] = $result;
        echo "post selected";
    }
    else
    {
        echo "missing key";
        $result = ProjectsToHTML($dbConnect->GetProjectsAll($keysForProject));
    }
}
elseif ($_SESSION != null && $_SESSION[Tags::Projects] != "")
{
    echo "session selected";
    $result = $_SESSION[Tags::Projects];
    $selectedLanguage = $_SESSION[Tags::Language];
    $selectedFeature = $_SESSION[Tags::Feature];
}
else
{
    echo "non selected";
    $result = ProjectsToHTML($dbConnect->GetProjectsAll($keysForProject));
}
$features = $dbConnect->GetFeatures();
$languages = $dbConnect->GetLanguages();

function SelectedLanguage($value): string
{
    global $selectedLanguage;
    if ($selectedLanguage == $value)
    {
        return "selected=\"selected\"";
    }
    return "";
}

function SelectedFeature($value): string
{
    global $selectedFeature;
    if ($selectedFeature == $value)
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
                <option <?=SelectedLanguage("All")?> value="All">All</option>
                <?php for ($i = 0; $i < Count($languages); $i++) :?>
                    <option <?=SelectedLanguage($languages[$i])?> value="<?= $languages[$i]; ?>"><?= $languages[$i]; ?></option>
                <?php endfor; ?>
            </select><br><br>

            <label for="lbl_language" >Select Feature</label>
            <select name=<?=Tags::Feature?>>
                <option <?=SelectedFeature("All")?> value="All">All</option>
                <?php for ($i = 0; $i < Count($features); $i++) :?>
                    <option <?=SelectedFeature($features[$i])?> value="<?= $features[$i]; ?>"><?= $features[$i]; ?></option>
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
