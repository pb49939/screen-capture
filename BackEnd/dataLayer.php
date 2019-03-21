<?php 
include_once("config.php");


class DataLayer{

    public function signUp(String $firstName, String $lastName, String $email, String $password){
        $token = bin2hex(random_bytes(16));
        $db = new db();
        $db = $db->connect();
        $sql = "Insert into User (FirstName, LastName, Email, Password, Token) Values(:firstName, :lastName, :email, :password, :token);";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt-> execute();

        $sql = "Select UserID, Token from User where Email = :email and Password = :password and :token = Token;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':token', $token);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row){
           
           setcookie("is-token", $row["Token"], time() + (86400 * 30), "/");
           setcookie("us-uid", $row["UserID"], time() + (86400 * 30), "/");

           return $row["UserID"];

            
           
        }

        return "";

    }

    public function saveNewBrother(int $userID, String $firstName, String $lastName, String $pledgeSemester, int $pledgeYear, String $status, String $oaklandEmail, String $phoneNumber, String $position){
        
        $db = new db();
        $db = $db->connect();
        $sql = "Insert into Brother (UserID, FirstName, LastName, PledgeSemester, PledgeYear, OaklandEmail, PhoneNumber, Status, Position, CreateDate, LastUpdatedDate) Values(:userID, :firstName, :lastName, :pledgeSemester, :pledgeYear, :oaklandEmail, :phoneNumber, :status, :position, Now(), Now());";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':pledgeSemester', $pledgeSemester);
        $stmt->bindParam(':pledgeYear', $pledgeYear);
        $stmt->bindParam(':oaklandEmail', $oaklandEmail);
        $stmt->bindParam(':phoneNumber', $phoneNumber);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':position', $position);
        $stmt-> execute();

        print_r($stmt->errorInfo()); 
     

       

        $sql = "Select BrotherID, Position, FirstName, LastName, IsPrudential from Brother where UserID = :userID;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userID', $userID);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row){

           setcookie("asp-first-name", $row["FirstName"], time() + (86400 * 30), "/");
           setcookie("asp-last-name", $row["LastName"], time() + (86400 * 30), "/");
           setcookie("asp-position", $row["Position"], time() + (86400 * 30), "/");
           setcookie("asp-brother-id", $row["BrotherID"], time() + (86400 * 30), "/");
           setcookie("asp-pr", $row["IsPrudential"], time() + (86400 * 30), "/");
           
           return $row["BrotherID"];
        }

        return "";


    }

    function saveNewRecording($taskID, $duration, $positiveFeel){

        $basePath = "http://localhost/screen-capture/BackEnd/recordings/blob";

        $db = new db();
        $db = $db->connect();
        $sql = "Insert into Recording (TaskID, Duration, PositiveFeel) VALUES (:taskID, :duration, :positiveFeel);";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':taskID', $taskID);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':positiveFeel', $positiveFeel);
        $stmt-> execute();

        $sql = "Select RecordingID from Recording Order by RecordingID desc Limit 1;";
        $stmt = $db->prepare($sql);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row){

           $recordingID = $row["RecordingID"];
           $path = $basePath . $recordingID;
           
           $sql = "Update Recording Set RecordingPath = :recordingPath where RecordingID = :recordingID";
           $stmt = $db->prepare($sql);
           $stmt->bindParam(':recordingID', $recordingID);
           $stmt->bindParam(':recordingPath', $path);
           $stmt-> execute();
           return $row["RecordingID"];
           
        }

        return "";
        
    }

    function getAllRecordingsByTaskID($taskID){

        $db = new db();
        $db = $db->connect();
        $sql = "Select * from Recording r Join Task t on t.TaskID = r.TaskID Where r.TaskID = :taskID Order by RecordingID desc;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':taskID', $taskID);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

       return $rows;
        
    }

    function getAllTasks(){

        $db = new db();
        $db = $db->connect();
        $sql = "SELECT t.TaskID, t.TaskName, t.TaskDescription, t.TaskImagePath, t.UpperDurationThreshold, t.LowerDurationThreshold, count(distinct r.RecordingID) as TotalSessions, sum(IFNULL(r.Duration, 0)) as TotalDuration, sum(IFNULL(r.PositiveFeel, 0)) as TotalPositiveFeel FROM Task t LEFT JOIN Recording r on r.TaskID = t.TaskID GROUP BY t.TaskID, t.TaskName, t.TaskDescription, t.TaskImagePath, t.UpperDurationThreshold, t.LowerDurationThreshold";
        $stmt = $db->prepare($sql);
        $stmt-> execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
        
    }

    function getTaskByTaskID($taskID){

        $db = new db();
        $db = $db->connect();
        $sql = "SELECT t.TaskID, t.TaskName, t.TaskDescription, t.TaskImagePath, t.UpperDurationThreshold, t.LowerDurationThreshold, count(distinct r.RecordingID) as TotalSessions 
                  FROM Task t 
                  LEFT JOIN Recording r on r.TaskID = t.TaskID
                 WHERE t.TaskID = :taskID
              GROUP BY t.TaskID, t.TaskName, t.TaskDescription, t.TaskImagePath, t.UpperDurationThreshold, t.LowerDurationThreshold";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':taskID', $taskID);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row){
            return $row;
        }
        
    }

    function saveNewWebsite($websiteName, $websiteURL){
        $db = new db();
        $db = $db->connect();
        $sql = "INSERT INTO Website (WebsiteName, WebsiteURL) VALUES (:siteName, :siteURL)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':siteName', $websiteName);
        $stmt->bindParam(':siteURL', $websiteURL);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sql = "SELECT * From Website where WebsiteName = :siteName and WebsiteURL = :siteURL";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':siteName', $websiteName);
        $stmt->bindParam(':siteURL', $websiteURL);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
        foreach($rows as $row){
            return $row;
        }
        
    }

    function getWebsiteByWebsiteID($websiteID){
        $db = new db();
        $db = $db->connect();
        $sql = "SELECT * From Website where WebsiteID = :websiteID;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':websiteID', $websiteID);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row){
            return $row;
        }
    }

    
}

?>