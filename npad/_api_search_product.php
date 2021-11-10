<?php
include 'model/db/DBManager.php';
include 'common/Common.php';

$conn = DBManager::getConnection();

$keyword = $_REQUEST['keyword'];

if (! empty($keyword)) {
    $sql = "SELECT product_id, product_name ";
    $sql .= " FROM np_product A ";
    $sql .= " WHERE  A.product_name LIKE '%" . $keyword . "%' ";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<datalist id='browsers-product'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" .$row['product_name']. "'>";
        }
        echo "</datalist>";
    }
}
DBManager::closeConn($conn);
?>
