<?php 
include_once("config.php");


class DataLayer{

     public function saveNewUser(String $firstName, String $lastName, String $email, String $password, String $username, String $userType){
        $token = bin2hex(random_bytes(16));
        $db = new db();
        $db = $db->connect();
        $sql = "Insert into User (Username, Email, FirstName, LastName, Password, UserType, Token) Values(:username, :email, :firstName, :lastName, :password, :userType, :token);";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':userType', $userType);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':token', $token);
        $stmt-> execute();
        $sql = "Select UserID, Username, FirstName, LastName, Password, UserType, Email, Token from User where Username = :username and Password = :password;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($rows as $row){
           
           $_SESSION["username"] = $row["Username"];
           $_SESSION["first-name"] = $row["FirstName"];
           $_SESSION["last-name"] = $row["LastName"];
           $_SESSION["password"] = $row["Password"];
           $_SESSION["user-type"] = $row["UserType"];
           $_SESSION["email"] = $row["Email"];
           $_SESSION["token"] = $row["Token"];

           setcookie("u", $row["UserID"], time() + (86400 * 30), "/");
           setcookie("fn", $row["FirstName"], time() + (86400 * 30), "/");
           setcookie("ln", $row["LastName"], time() + (86400 * 30), "/");
           setcookie("ut", $row["UserType"], time() + (86400 * 30), "/");
           setcookie("e", $row["Email"], time() + (86400 * 30), "/");
           setcookie("un", $row["Username"], time() + (86400 * 30), "/");
           setcookie("p", $row["Password"], time() + (86400 * 30), "/");
           setcookie("t", $row["Token"], time() + (86400 * 30), "/");
           
           return "success";
           
            
           
        }
       
    }

    public function authenticateToken(){
        $db = new db();
        $db = $db->connect();
        $sql = "Select * from User where Token = :token;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':token', $_COOKIE["t"]);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($rows as $row){
            return true;
        }

        return false;
    }


    public function logIn($username, $password){

        $db = new db();
        $db = $db->connect();
        $sql = "Select * from User where Username = :username;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($rows as $row){

            if(password_verify($password, $row["Password"])){
                
                setcookie("u", $row["UserID"], time() + (86400 * 30), "/");
                setcookie("fn", $row["FirstName"], time() + (86400 * 30), "/");
                setcookie("ln", $row["LastName"], time() + (86400 * 30), "/");
                setcookie("ut", $row["UserType"], time() + (86400 * 30), "/");
                setcookie("e", $row["Email"], time() + (86400 * 30), "/");
                setcookie("un", $row["Username"], time() + (86400 * 30), "/");
                setcookie("p", $row["Password"], time() + (86400 * 30), "/");
                setcookie("t", $row["Token"], time() + (86400 * 30), "/");

                return true;
            }else{
                return false;
            }
        }
    }

        public function getUserByUserID(String $userID){

        $db = new db();
        $db = $db->connect();
        $sql = "Select * From User where UserID = :userID;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userID', $userID);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($rows as $row){
            return $row;
        }

    }
    function saveNewRecording($taskID, $duration, $positiveFeel){

        $basePath = "http://localhost/screen-capture/BackEnd/recordings/blob";

        $db = new db();
        $db = $db->connect();
        $sql = "Insert into Recording (TaskID, Duration, PositiveFeel, UserID) VALUES (:taskID, :duration, :positiveFeel, :userID);";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':taskID', $taskID);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':positiveFeel', $positiveFeel);
        $stmt->bindParam(':userID', $_COOKIE["u"]);
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
        $sql = "Select * from Recording r Join Task t on t.TaskID = r.TaskID Join Website w on w.WebsiteID = t.WebsiteID join User u on u.UserID = r.UserID Where r.TaskID = :taskID Order by RecordingID desc;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':taskID', $taskID);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

       return $rows;
        
    }

    function getAllTasksByWebsiteID($websiteID){

        $db = new db();
        $db = $db->connect();
        $sql = "SELECT t.TaskID, t.TaskName, t.TaskDescription, t.TaskImagePath, t.UpperDurationThreshold, t.LowerDurationThreshold, count(distinct r.RecordingID) as TotalSessions, sum(IFNULL(r.Duration, 0)) as TotalDuration, sum(IFNULL(r.PositiveFeel, 0)) as TotalPositiveFeel FROM Task t Join Website w on w.WebsiteID = t.WebsiteID LEFT JOIN Recording r on r.TaskID = t.TaskID where t.WebsiteID = :websiteID GROUP BY t.TaskID, t.TaskName, t.TaskDescription, t.TaskImagePath, t.UpperDurationThreshold, t.LowerDurationThreshold;";
        $stmt = $db->prepare($sql);
         $stmt->bindParam(':websiteID', $websiteID);
        $stmt-> execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
        
    }

    function getAllTasksForUserTester($userID){

        $db = new db();
        $db = $db->connect();
        $sql = "SELECT t.TaskID, t.TaskName, t.TaskDescription, t.TaskImagePath, t.UpperDurationThreshold, t.LowerDurationThreshold, count(distinct r.RecordingID) as TotalSessions, sum(IFNULL(r.Duration, 0)) as TotalDuration, sum(IFNULL(r.PositiveFeel, 0)) as TotalPositiveFeel, IFNULL(r.UserID, 0) as Completed FROM Task t LEFT JOIN Recording r on r.TaskID = t.TaskID and r.UserID = :userID GROUP BY t.TaskID, t.TaskName, t.TaskDescription, t.TaskImagePath, t.UpperDurationThreshold, t.LowerDurationThreshold";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userID', $userID);
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

    function saveNewWebsite($websiteName, $websiteURL, $websiteImagePath){
        $db = new db();
        $db = $db->connect();
        $sql = "INSERT INTO Website (WebsiteName, WebsiteURL, WebsiteImagePath) VALUES (:siteName, :siteURL, :websiteImagePath)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':siteName', $websiteName);
        $stmt->bindParam(':siteURL', $websiteURL);
        $stmt->bindParam(':websiteImagePath', $websiteImagePath);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sql = "SELECT * From Website where WebsiteName = :siteName and WebsiteURL = :siteURL";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':siteName', $websiteName);
        $stmt->bindParam(':siteURL', $websiteURL);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
        foreach($rows as $row){

        $sql = "INSERT INTO UserWebsite (UserID, WebsiteID) VALUES (:userID, :websiteID)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userID', $_COOKIE["u"]);
        $stmt->bindParam(':websiteID', $row["WebsiteID"]);
        $stmt-> execute();

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

    


    function getAllWebsitesByUserID($userID){
        $db = new db();
        $db = $db->connect();
        $sql = "SELECT * From Website w Join UserWebsite uw on uw.WebsiteID = w.WebSiteID where uw.UserID = :userID;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userID', $userID);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;

    }

    function getWebsiteInfo($websiteID){
        $db = new db();
        $db = $db->connect();
        $sql = "Select w.WebsiteID, WebsiteName, WebsiteImagePath, t.TaskID, t.TaskName, count(distinct r.RecordingID) as Sessions From Website w join Task t on t.WebsiteID = w.WebsiteID left join Recording r on r.TaskID = t.TaskID where w.WebsiteID = :websiteID Group by w.WebsiteID, WebsiteName, WebsiteImagePath, t.TaskID, t.TaskName;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':websiteID', $websiteID);
        $stmt-> execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

}

?>