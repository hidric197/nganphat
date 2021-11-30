<?php
class DBManager
{
    static function getConnection()
    {
        // $dbadress = 'localhost';
        // $dbuser = 'root';
        // $dbpass = '';
        // $dbname = 'nganphat_db';
        
        $dbadress = 'localhost';
        $dbuser = 'nganphat_user';
        $dbpass = 'JB:s?+qT:xBMP^,W9=0';
        $dbname = 'nganphat_db';

        $conn = mysqli_connect($dbadress, $dbuser, $dbpass, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $conn->set_charset("utf8mb4");
        return $conn;
    }

    static function getConnectionPDO()
    {
        // $dbadress = 'localhost';
        // $dbuser = 'root';
        // $dbpass = '';
        // $dbname = 'nganphat_db';
        
        $dbadress = 'localhost';
        $dbuser = 'nganphat_user';
        $dbpass = 'JB:s?+qT:xBMP^,W9=0';
        $dbname = 'nganphat_db';

        $conn_pdo = new PDO("mysql:host=$dbadress;dbname=$dbname", $dbuser, $dbpass);
        return $conn_pdo;
    }

    static function closeConn($conn)
    {
        $conn->close();
    }
}

// $user = "a";
// $pass = "a";
// $fullName = "a";
// $address = "ab";

// // i - Integer
// // d - Double
// // s - String
// // b - Blob
// $mysqli = mysqli_connect('localhost', 'root', 'root', 'nganphatdb');
// if ($mysqli->connect_error) {
// die("Connection failed: " . $mysqli->connect_error);
// }
// $mysqli->set_charset("utf8mb4");
// $sql = "INSERT INTO np_user(user_name, user_password, user_full_name, user_address)
// VALUES (?,?,?,?)";
// $stmt = $mysqli->prepare($sql);
// $stmt->bind_param("ssss", $user, $pass, $fullName, $address);
// $result = $stmt->execute();
// print_r($result);
// $mysqli->close();

// ========================================

// $id = '1';
// $mysqli = mysqli_connect('localhost', 'root', 'root', 'nganphatdb');
// if ($mysqli->connect_error) {
// die("Connection failed: " . $mysqli->connect_error);
// }
// $name = $mysqli->real_escape_string($id);
// $sql = "SELECT * FROM np_user WHERE user_id = '$name'";
// $result = $mysqli->query($sql);
// if ($result->num_rows > 0) {
// // output data of each row
// while ($row = $result->fetch_assoc()) {
// echo "id: " . $row["user_id"] . " - Name: " . $row["user_name"] . " " . $row["user_password"]
// . " " . $row["user_full_name"] . " " . $row["user_address"] . "<br>";
// }
// } else {
// echo "0 results";
// }
// $mysqli->close();

// ========================================

// $id = '1';

// $mysqli = mysqli_connect('localhost', 'root', 'root', 'nganphatdb');

// if ($mysqli->connect_error) {
// die("Connection failed: " . $mysqli->connect_error);
// }

// $sql = "SELECT * FROM np_user WHERE user_id = '$id'";
// $result = $mysqli->query($sql);

// if ($result->num_rows > 0) {
// // output data of each row
// while ($row = $result->fetch_assoc()) {
// echo "id: " . $row["user_id"] . " - Name: " . $row["user_name"] . " " . $row["user_password"]
// . " " . $row["user_full_name"] . " " . $row["user_address"] . "<br>";
// }
// } else {
// echo "0 results";
// }
// $mysqli->close();
class NpPermaLinkDba
{

    static function insertData($conn, $permalinkValue, $table_name)
    {
        $pmk = $conn->real_escape_string($permalinkValue);
        $table = $conn->real_escape_string($table_name);
        $sql = "SELECT permalink FROM np_permalink WHERE permalink = '$pmk' AND delete_flag = '0'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return 0;
        }
        $sql = "INSERT INTO np_permalink(permalink, data_table) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $pmk, $table);
        $result = $stmt->execute();
        return $result;
    }

    static function getMaxDataId($conn)
    {
        $maxDataId = 0;
        $sql = "SELECT Max(data_id) AS data_id FROM np_permalink";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $maxDataId = $row["data_id"];
            }
        } else {
            return 0;
        }
        return $maxDataId;
    }
    
    static function getMaxOrderId($conn)
    {
        $maxOrderId = 0;
        $sql = "SELECT Max(order_id) AS order_id FROM np_order";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $maxOrderId = $row["order_id"];
            }
        } else {
            return 0;
        }
        return $maxOrderId;
    }

    static function delPermalink($conn, $table_name, $fieldCondidtonName, $fieldConditionValue)
    {
        $sql = "DELETE FROM np_permalink WHERE data_id IN (SELECT data_id FROM " . $table_name . " WHERE " . $fieldCondidtonName . " = ? )";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $fieldConditionValue);
        $stmt->execute();

        $sql = "DELETE FROM " . $table_name . " WHERE " . $fieldCondidtonName . " = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $fieldConditionValue);
        $stmt->execute();
    }
    
    static function updPermalink($conn, $permalinkValue, $login_user_id, $table_name, $fieldCondidtonName, $fieldConditionValue, $fieldEditName, $fieldEditValue)
    {
        $sql = "UPDATE np_permalink SET permalink = ? , insert_user = '$login_user_id'";
        $sql .= " WHERE data_id IN (SELECT data_id FROM " . $table_name . " WHERE " . $fieldCondidtonName . " = ? )";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $permalinkValue, $fieldConditionValue);
        $stmt->execute();
        
    }
    
    static function getMaxProductId($conn)
    {
        $maxProductId = 0;
        $sql = "SELECT Max(product_id) AS product_id FROM np_product";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $maxProductId = $row["product_id"];
            }
        } else {
            return 0;
        }
        return $maxProductId;
    }
    
    static function getMaxPageId($conn)
    {
        $maxPageId = 0;
        $sql = "SELECT Max(page_id) AS page_id FROM np_page";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $maxPageId = $row["page_id"];
            }
        } else {
            return 0;
        }
        return $maxPageId;
    }
    
    static function getMaxTagId($conn)
    {
        $maxTagId = 0;
        $sql = "SELECT Max(tag_id) AS tag_id FROM np_prod_tag";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $maxTagId = $row["tag_id"];
            }
        } else {
            return 0;
        }
        return $maxTagId;
    }
    
    static function getTagIdWithSlug($conn, $slug)
    {
        $pmk = $conn->real_escape_string($slug);
        $sql = "SELECT A.tag_id FROM np_prod_tag A INNER JOIN np_permalink B ON A.data_id = B.data_id WHERE B.permalink = '$pmk' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $maxTagId = $row["tag_id"];
            }
        }
        return $maxTagId;
    }
    
    static function insertTagProduct($conn, $str, $slug, $product_id){
        $result = NpPermaLinkDba::insertData($conn, $slug, 'np_prod_tag');
        $tag_id = '';
        if ($result != 0){
            // insert tag
            $data_id = NpPermaLinkDba::getMaxDataId($conn);
            $sql = "INSERT INTO np_prod_tag (data_id, tag_name) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $data_id, $str);
            $stmt->execute();
            
            $tag_id = NpPermaLinkDba::getMaxTagId($conn);
        } else {
            $tag_id = NpPermaLinkDba::getTagIdWithSlug($conn, $slug);
        }
        
        $id = $conn->real_escape_string($product_id);
        $sql = "INSERT INTO tag_product (tag_id, product_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $tag_id, $id);
        $stmt->execute();
    }
    
    static function insertTagPage($conn, $str, $slug, $product_id){
        $result = NpPermaLinkDba::insertData($conn, $slug, 'np_prod_tag');
        $tag_id = '';
        if ($result != 0){
            // insert tag
            $data_id = NpPermaLinkDba::getMaxDataId($conn);
            $sql = "INSERT INTO np_prod_tag (data_id, tag_name) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $data_id, $str);
            $stmt->execute();
            
            $tag_id = NpPermaLinkDba::getMaxTagId($conn);
        } else {
            $tag_id = NpPermaLinkDba::getTagIdWithSlug($conn, $slug);
        }
        
        $id = $conn->real_escape_string($product_id);
        $sql = "INSERT INTO tag_page (tag_id, page_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $tag_id, $id);
        $stmt->execute();
    }
    
    static function countData($conn, $tablename, $condition) {
        $count = 0;
        $sql = "SELECT count(*) AS count FROM " . $tablename . " WHERE " .$condition. " AND delete_flag = '0' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $count = $row["count"];
            }
        } else {
            return 0;
        }
        return $count;
    }
}
?>