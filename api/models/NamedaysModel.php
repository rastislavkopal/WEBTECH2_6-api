<?php

include_once 'Database.php';

/*
 * Handles operation with namedays
 */
class NamedaysModel{

    private $db;

    /**
     * NamedaysModel constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getNamesForDay($day){
        try{
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("SELECT country, name FROM namedays WHERE day_numeric=:day_numeric");
            $stmt->bindParam(':day_numeric', $day,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }

    public function getNamedaysByNameAndState($name, $state){
        try{
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("SELECT day_numeric FROM namedays WHERE name=:name AND country=:country");
            $stmt->bindParam(':name', $name,PDO::PARAM_STR);
            $stmt->bindParam(':country', $state,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }

    public function getHolidaysByState($state){
        try{
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("SELECT day_numeric, name FROM holidays WHERE country=:country");
            $stmt->bindParam(':country', $state);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }


    public function getMemorialDays(){
        try{
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("SELECT day_numeric, name FROM memorials");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }


    public function addSlovakNameday($name, $day){
        try{
            $conn = $this->db->getConnection();

            $prep = $conn->prepare("INSERT INTO namedays (day_numeric,country, name, is_title) VALUES (:day_numeric,'SK',:name, 0)");
            $prep->bindParam(':day_numeric', $day, PDO::PARAM_INT);
            $prep->bindParam(':name', $name, PDO::PARAM_STR);

            return $prep->execute();
        } catch(PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }

}