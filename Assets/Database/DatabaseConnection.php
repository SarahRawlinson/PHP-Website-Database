<?php
require 'SQLQueries.php';
require 'User.php';

class DatabaseConnection
{
    private static $instance;
    public $connection = null;

    private static function CreateInstance(): DatabaseConnection
    {
        DatabaseConnection::$instance = new DatabaseConnection();
        return self::$instance;
    }

    public function GetProjectsByParameters(string $language, string $feature): string
    {
        //return SQLQueries::GetProjectsByParametersQuery($language, $feature, $this);
        return $this->GetProjects(SQLQueries::GetProjectsByParametersQuery($language, $feature, $this));
    }

    public function GetLanguages(): array
    {
        return $this->ReturnQueryResult(SQLQueries::GetLanguagesQuery(), 'language');
    }

    public function GetFeatures(): array
    {
        return $this->ReturnQueryResult(SQLQueries::GetFeaturesQuery(),'feature');
    }

    public function LanguageExists(string $language): bool
    {
        return in_array($language, $this->GetLanguages(), true);
    }

    public function FeatureExists(string $feature): bool
    {
        return in_array($feature, $this->GetFeatures(), true);
    }

    private function RunQuery(string $query): void
    {
        $this->connection->query($query);
    }

    private function ReturnQueryResult(string $query, string $key): array
    {
        $this->Open();
        $lang_array = [];
        $result = $this->connection->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $lang_array[] = $row[$key];
            }
        }
        $this->Close();
        return $lang_array;
    }


    public function GetProjectsAll(): string
    {
        return $this->GetProjects(SQLQueries::GetAllProjectsQuery());
    }

    private function GetProjects(string $query): string
    {
        $this->Open();
        $tempFirstName = "";
        $result = $this->connection->prepare($query);
        //$result->bind_param("s", $tempFirstName);
        $result->execute();
        $id = 0;
        $projectname = "";
        $details = "";
        $keywords = "";
        $directory = "";
        $result->bind_result($id, $projectname, $directory, $details, $keywords);
        $result->store_result();
        $projectsHTMLString = "";
        if ($result->num_rows > 0) {
            while ($result->fetch()) {
                $projectsHTMLString .= "<h3>$projectname</h3><br><br><br>";
                $projectsHTMLString .= "<a href='$directory'>$projectname</a><br><br><br>";
                $projectsHTMLString .= "<p>$keywords</p><br><br><br>";
                $projectsHTMLString .= "<p>$details</p><br><br><br>";
            }
        }
        $this->Close();
        return $projectsHTMLString;
    }

    private function Connect(string $dbPassword, string $dbUserName, string $dbServer, string $dbName): void
    {
        //echo "Database->Connect($dbPassword, $dbUserName, $dbServer , $dbName)".PHP_EOL;

        $this->connection = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);

        if ($this->connection->connect_errno) {
            exit("Database connection failed. Reason: " . $this->connection->connect_errno);
        }
    }

    private function Open(): void
    {
        $this->Connect(User::$pass, User::$user, User::$host, "my_projects");
    }

    public static function GetInstance(): DatabaseConnection
    {
        //echo "Database->GetInstance()".PHP_EOL;
        return self::$instance ?? self::CreateInstance();
    }

    private function Close(): void
    {
        //echo "Database->Close()".PHP_EOL;
        if ($this->connection != null) {
            $this->connection->Close();
        }
    }

}

?>


