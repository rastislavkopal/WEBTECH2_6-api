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
            $stmt = $conn->prepare("SELECT country, name, is_title FROM namedays WHERE day_numeric=:day_numeric");
            $stmt->bindParam(':day_numeric', $day,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }



}