<?php

class DataClass {

    var $connect;
    var $db;
    function  __construct()
    {
        $this->connect =  new mysqli('localhost', 'root', '', 'employeedetails');
    }
    
    function ExeQuery($sql)
    {
        $this->connect->query($sql);
    }

    function sqliQueryExecution($sql)
    {
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
}
