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

    public function getDay($arr, $pass){
        try{
            
        } catch(PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }



}