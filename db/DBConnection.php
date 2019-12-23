<?php

class DBConnection
{
    private $host="localhost";
    private $userName="root";
    private $password="";
    private $database="SFA";
    private $port="3306";
//    private $host="localhost";
//    private $userName="id9647343_root";
//    private $password="123456";
//    private $database="id9647343_sfa";
//    private $port="3306";

    private $connection;

    /**
     * DBConnection constructor.
     */
    public function __construct()
    {
        $this->connection=new mysqli($this->host,$this->userName,$this->password,$this->database,$this->port);
    }

    
    public function getDBConnection(){
        return $this->connection;
    }
    
   
}