<?php
header('Content-Encoding: UTF-8');
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="List_san_pham.csv"');

include 'common/Common.php';
include 'model/db/DBManager.php';
$conn = DBManager::getConnection();

$csvdata = array();
$csvdata[0] = array( 'Id', 'Mã Sản phẩm', 'Tên Sản Phẩm', 'Giá Cũ (đ)', 'Giảm giá (%)', 'Giá Bán (đ)' );

$sql = "SELECT A.product_id, A.product_name, A.product_code, A.product_old_price, A.product_down_price, A.product_sell_price ";
$sql .= " FROM np_product A ";
$sql .= " WHERE A.delete_flag = '0' ";
// Khi filter
if (isset($_POST['filter_group_id']) && ! empty($_POST['filter_group_id'])) {
    $filter_group_id = $_POST['filter_group_id'];
    $sql .= " AND A.group_id = '" . $filter_group_id . "'";
}

// Khi filter Bộ lọc Thương Hiệu
if (isset($_POST['filter_filter_group_id']) && !empty($_POST['filter_filter_group_id'])) {
    $filter_filter_group_id = $_POST['filter_filter_group_id'];
    $sql .= " AND A.filter_id = '" . $filter_filter_group_id . "'";
}

// Khi Tìm kiếm theo mã sản phẩm
if (isset($_POST['search_productCode']) && !empty($_POST['search_productCode'])) {
    $search_productCode = $_POST['search_productCode'];
    $sql .= " AND A.product_code LIKE '%" . $search_productCode . "%'";
}

$sql .= " ORDER BY A.product_id DESC ";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $n = 0;
    while ($row = $result->fetch_assoc()) {
        $n ++;
        $csvdata[$n] = array($row['product_id'],$row['product_code'],$row['product_name'],$row['product_old_price'],$row['product_down_price'],$row['product_sell_price']);
    }
}

$fp = fopen('php://output', 'wb');
foreach ($csvdata as $line) {
    // though CSV stands for "comma separated value"
    // in many countries (including France) separator is ";"
    fputcsv($fp, $line, ',');
}

fclose($fp);
DBManager::closeConn($conn);

?>