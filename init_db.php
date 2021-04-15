<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once './api/models/Database.php';

$db = new Database();

$xml = simplexml_load_file('meniny.xml');
//execQuery($db,"DELETE * FROM days");

if ($xml === false) {
    echo "Failed loading XML: ";
    foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
} else {
    foreach($xml->children() as $record) {

        if (isset($record->den) && !empty($record->den))
            execQuery($db,"INSERT INTO days (id) VALUES (" . $record->den . ")");

        if (isset($record->SK) && !empty($record->SK))
            execQuery($db,"INSERT INTO namedays (day_numeric,country,name, is_title) VALUES (".$record->den.",'SK','".$record->SK."',1)");

        if (isset($record->SKd) && !empty($record->SKd)) {
            $row = trim($record->SKd);
            $names = explode(",", $row);
            foreach ($names as $name){
              if (!empty(trim($name)))
                  execQuery($db,"INSERT INTO namedays (day_numeric,country,name, is_title) VALUES (".$record->den.",'SK','". $name."',0)");
         }

        }

        if (isset($record->CZ) && !empty($record->CZ))
            execQuery($db,"INSERT INTO namedays (day_numeric,country,name, is_title) VALUES (".$record->den.",'CZ','".$record->CZ."',0)");

        if (isset($record->HU) && !empty($record->HU))
            execQuery($db,"INSERT INTO namedays (day_numeric,country,name, is_title) VALUES (".$record->den.",'HU','".$record->HU."',0)");

        if (isset($record->AT) && !empty($record->AT))
            execQuery($db,"INSERT INTO namedays (day_numeric,country,name, is_title) VALUES (".$record->den.",'AT','".$record->AT."',0)");


        if (isset($record->SKsviatky) && !empty($record->SKsviatky))
            execQuery($db,"INSERT INTO holidays (day_numeric, country, name) VALUES (" . $record->den . ",'SK','" . $record->SKsviatky . "')");

        if (isset($record->CZsviatky) && !empty($record->CZsviatky))
            execQuery($db,"INSERT INTO holidays (day_numeric, country, name) VALUES (" . $record->den . ",'CZ','" . $record->CZsviatky . "')");

        if (isset($record->SKdni) && !empty($record->SKdni))
            execQuery($db,"INSERT INTO memorials (day_numeric , name) VALUES (" . $record->den . ",'" . $record->SKdni . "')");

    }
}

function execQuery($db, $query)
{
    try{
        $conn = $db->getConnection();

//        $prep = $conn->prepare("INSERT INTO resources (resource_name) VALUES (:resource_name)");
//        $prep->bindParam(':resource_name', $resourceName, PDO::PARAM_STR);
        $prep = $conn->prepare($query);

        echo $prep->execute() . "<br>";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}


