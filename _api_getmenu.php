<?php
include 'npad/model/db/DBManager.php';
include 'npad/common/Common.php';

$conn = DBManager::getConnection();

$id = $conn->real_escape_string($_REQUEST['subid']);
$str = '';

if ($id == '1' || $id == '2' || $id == '3') {
    $sql = "SELECT D.permalink, A.group_id, A.group_name ";
    $sql .= " FROM np_prod_group A ";
    $sql .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
    $sql .= " WHERE A.group_type = '$id' AND A.group_level = '1' AND A.delete_flag = '0'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $str .= '<li id="left-menu-581" class="pure-menu-item pure-menu-has-children">';
            $str .= '<a href="' . $row['permalink'] . '" data-id="581" title="' . $row['group_name'] . '" class="pure-menu-link navlink2 ">';
            $str .= '<span class="icon-menu-item icon--581"></span>';
            $str .= '<b>' . $row['group_name'] . '</b></a>';
            $str .= '<ul class="pure-menu-children nav3">';
            // cap 2
            $sql1 = "SELECT D.permalink, A.group_id, A.group_name ";
            $sql1 .= " FROM np_prod_group A ";
            $sql1 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
            $sql1 .= " WHERE A.group_level_up = '" . $row['group_id'] . "' AND A.delete_flag = '0'";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    
                    $str .= '<li class="pure-menu-item">';
                    $str .= '<a href="' . $row1['permalink'] . '" title="' . $row1['group_name'] . '" data-id="581" class="pure-menu-link navlink3">' . $row1['group_name'];
                    $str .= '</a>';
                    $str .= '</li>';
                   
                }
            }
            $str .= '</ul>';
            $str .= '</li>';
        }
    } else {
        $str = 'Không có thông tin phù hợp ...';
    }
} else {
    $sql = "SELECT D.permalink, A.group_id, A.group_name ";
    $sql .= " FROM np_prod_group A ";
    $sql .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
    $sql .= " WHERE A.group_level_up = '$id' AND A.delete_flag = '0'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $str .= '<li id="left-menu-581" class="pure-menu-item pure-menu-has-children">';
            $str .= '<a href="' . $row['permalink'] . '" data-id="581" title="' . $row['group_name'] . '" class="pure-menu-link navlink2 ">';
            $str .= '<span class="icon-menu-item icon--581"></span>';
            $str .= $row['group_name'] . '</a>';
            $str .= '<ul class="pure-menu-children nav3">';
            $str .= '</ul>';
            $str .= '</li>';
        }
    } else {
        $str = 'Không có thông tin phù hợp ...';
    }
}
echo $str;
DBManager::closeConn($conn);
?>

