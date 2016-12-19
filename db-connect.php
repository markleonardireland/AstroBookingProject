 <!--* db-connect.php-->
 <!--* Version 1-->
 <!--* Date e.g. 01/11/2016-->
 <!--* @reference http://php.net/-->
 <!--* @author Kevin O'Rourke x15042782 -->
 
<?php

class DB {
    private $connection;
    
    public function __construct() {
        $con = mysql_connect('localhost','root','');
        if (!$con)
          {
          die('Could not connect: ' . mysql_error());
          }
        mysql_select_db('register', $con);
        $this->connection = $con;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    public function query($sql) {
        return mysql_query($sql,$this->getConnection());
    }
    
    public function fetch_assoc($result) {
        return mysql_fetch_assoc($result);
    }
    
    public function fetch_row($result) {
        return mysql_fetch_row($result);
    }
    
    public function escape($value) {
        return mysql_real_escape_string($value);
    }
    
    public function error() {
        return mysql_error();
    }
    
    public function close() {
        return mysql_close($this->connection);
    }
}