<?php
require 'User.php';
class DatabaseConnection
{
    private  static $instance;
    public $connection = null;
    private  static  function CreateInstance()
    {
        //echo "Database->CreateInstance()".PHP_EOL;
        DatabaseConnection::$instance = new DatabaseConnection();
        DatabaseConnection::$instance->Connect(User::$pass,User::$user,User::$host,"my_projects");
        return self::$instance;
    }

    public function GetProjectsQuery(): string
    {
        return "SELECT id, project_name, git_directory, details, key_words FROM project ORDER BY project_name ASC ";
    }

    public function RunQuery($query): void
    {
        $this->connection->query($query);
    }

    public function ReturnQueryResult($query)
    {
        return $this->connection->query($query);
    }

    public function GetProjects() : string
    {
        $this->Open();
        $tempFirstName = "";
        $result = $this->connection->prepare($this->GetProjectsQuery());
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
        if ($result->num_rows > 0)
        {
            while ($result->fetch())
            {
                $projectsHTMLString .= "<h2>$projectname</h2><br><br>";
                $projectsHTMLString .= "<a href='$directory'>$projectname</a><br><br>";
                $projectsHTMLString .= "<p>$keywords</p><br><br>";
                $projectsHTMLString .= "<p>$details</p><br><br>";
            }
        }
        $this->Close();
        return $projectsHTMLString;
    }

    private function Connect($dbPassword,$dbUserName ,$dbServer , $dbName): void
    {
        //echo "Database->Connect($dbPassword, $dbUserName, $dbServer , $dbName)".PHP_EOL;

        $this->connection = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);

        if ($this->connection -> connect_errno)
        {
            exit("Database connection failed. Reason: ".$this->connection->connect_errno);
        }
    }
    private function Open(): void
    {
        $this->Connect(User::$pass,User::$user,User::$host,"my_projects");
    }

    public static function GetInstance() : DatabaseConnection
    {
        //echo "Database->GetInstance()".PHP_EOL;
        return self::$instance ?? self::CreateInstance();
    }

    private function Close(): void
    {
        //echo "Database->Close()".PHP_EOL;
        if ($this->connection != null)
        {
            $this->connection->Close();
        }
    }
}
?>


