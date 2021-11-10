<?php
include 'model/db/DBManager.php';
include 'common/Common.php';

$conn = DBManager::getConnection();

$keyword = $_REQUEST['keyword'];

if (! empty($keyword)) {
    $sql = "SELECT tag_name ";
    $sql .= " FROM np_prod_tag A ";
    $sql .= " WHERE  A.tag_name LIKE '%" . $keyword . "%' ";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<datalist id='browsers-tag'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" .$row['tag_name']. "'>";
        }
        echo "</datalist>";
    }
}
DBManager::closeConn($conn);
?>
