<?php

require 'User.php';

class DatabaseConnection
{
    private static $instance;
    public $connection = null;

    private static function CreateInstance()
    {
        //echo "Database->CreateInstance()".PHP_EOL;
        DatabaseConnection::$instance = new DatabaseConnection();
//        update the connection string for your own database
//        Database\DatabaseConnection::$instance->Connect(Database\User::$pass,Database\User::$user,Database\User::$host,"my_projects");
        return self::$instance;
    }

    private function GetProjectsQuery(): string
    {
        return "SELECT id, project_name, git_directory, details, key_words FROM project ORDER BY project_name ASC ";
    }

    private function GetProjectsQueryByLanguage($language): string
    {
        if (in_array($language,$this->GetLanguages(), true))
        {
            return "SELECT * FROM project WHERE id IN ( SELECT project_id from project_languages WHERE 
                                language_id IN ( SELECT id from languages WHERE language = '$language' ) ); ";
        }
        return $this->GetProjectsQuery();

    }

    private function GetLanguagesQuery(): string
    {
        return "SELECT language FROM languages; ";
    }

    public function GetLanguages(): array
    {
        return $this->ReturnQueryResult($this->GetLanguagesQuery());
    }


    private function RunQuery($query): void
    {
        $this->connection->query($query);
    }

    private function ReturnQueryResult($query): array
    {
        $this->Open();
        $lang_array = [];
        $result = $this->connection->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $lang_array[] = $row['language'];
            }
        }
        $this->Close();
        return $lang_array;

    }

    public function GetProjectsByLanguage($language): string
    {
        return $this->GetProjects($this->GetProjectsQueryByLanguage($language));
    }

    public function GetProjectsAll(): string
    {
        return $this->GetProjects($this->GetProjectsQuery());
    }

    private function GetProjects($query): string
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

    private function Connect($dbPassword, $dbUserName, $dbServer, $dbName): void
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


