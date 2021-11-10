<?php
class DBManager01
{
    static function getConnection()
    {
        $dbadress = 'localhost';
        $dbuser = 'root';
        $dbpass = 'root';
        $dbname = 'admin_npcomvn';

        $conn = mysqli_connect($dbadress, $dbuser, $dbpass, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $conn->set_charset("utf8mb4");
        return $conn;
    }

    static function closeConn($conn)
    {
        $conn->close();
    }
}


class DBManager02
{
    static function getConnection()
    {
        $dbadress = 'localhost';
        $dbuser = 'root';
        $dbpass = 'root';
        $dbname = 'nganphatdb';
        
        $conn = mysqli_connect($dbadress, $dbuser, $dbpass, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $conn->set_charset("utf8mb4");
        return $conn;
    }
    
    static function closeConn($conn)
    {
        $conn->close();
    }
}
?>