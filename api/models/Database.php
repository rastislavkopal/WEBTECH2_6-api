<?php


class Database
{
    private $db_pass;
    private $db_name;
    private $server_name;


    function __construct()
    {
        require_once '/home/xkopalr1/public_html/config.php';

        if (empty($username) || empty($password) || empty($servername))
            echo "Cannot be empty string.";

        $this->db_name = $username;
        $this->db_pass = $password;
        $this->server_name = $servername;
    }

    public function getConnection()
    {
        try{
            $conn = new PDO("mysql:host=$this->server_name;dbname=zadanie3", $this->db_name, $this->db_pass);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function getDbPass()
    {
        return $this->db_pass;
    }

    /**
     * @param mixed $db_pass
     */
    public function setDbPass($db_pass): void
    {
        $this->db_pass = $db_pass;
    }

    /**
     * @return mixed
     */
    public function getDbName()
    {
        return $this->db_name;
    }

    /**
     * @param mixed $db_name
     */
    public function setDbName($db_name): void
    {
        $this->db_name = $db_name;
    }

    /**
     * @return mixed
     */
    public function getServerName()
    {
        return $this->server_name;
    }

    /**
     * @param mixed $server_name
     */
    public function setServerName($server_name): void
    {
        $this->server_name = $server_name;
    }


}