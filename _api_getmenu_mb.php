<?php
include 'npad/model/db/DBManager.php';
include 'npad/common/Common.php';

$conn = DBManager::getConnection();

$id = $conn->real_escape_string($_REQUEST['subid']);

$sql = "SELECT D.permalink, A.group_id, A.group_name ";
$sql .= " FROM np_prod_group A ";
$sql .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
$sql .= " WHERE A.group_type = '$id' AND A.group_level = '1' AND A.delete_flag = '0'";
$result = $conn->query($sql);
$str = '';
$nId = 99;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nId ++;
        $str .= '<li id="left-menu-' . $nId . '" class="pure-menu-item pure-menu-has-children">';
        $str .= '<a href="' . $row['permalink'] . '" data-id="' . $nId . '" title="' . $row['group_name'] . '" class="pure-menu-link navlink2 ">';
        $str .= '<span class="icon-menu-item icon--' . $nId . '"></span>';
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
                $str .= '<a href="' . $row1['permalink'] . '" title="' . $row1['group_name'] . '" data-id="' . $nId . '" class="pure-menu-link navlink3">' . $row1['group_name'];
                $str .= '</a>';
                $str .= '<ul class="nav4">';
                    
                    // cap 3
                    $sql2 = "SELECT D.permalink, A.group_id, A.group_name ";
                    $sql2 .= " FROM np_prod_group A ";
                    $sql2 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
                    $sql2 .= " WHERE A.group_level_up = '" . $row1['group_id'] . "' AND A.delete_flag = '0'";
                    $result2 = $conn->query($sql2);
                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                        $str .= '<li class="pure-menu-item">';
                        $str .= '<a href="' . $row2['permalink'] . '" title="' . $row2['group_name'] . '" data-id="' . $nId . '" class="pure-menu-link navlink3">';
                        $str .= '&nbsp;&nbsp;&nbsp;' . $row2['group_name'];
                        $str .= '</a>';
                        $str .= '<ul class="nav5">';
                        
                            // cap 4
                            $sql3 = "SELECT D.permalink, A.group_id, A.group_name ";
                            $sql3 .= " FROM np_prod_group A ";
                            $sql3 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
                            $sql3 .= " WHERE A.group_level_up = '" . $row2['group_id'] . "' AND A.delete_flag = '0'";
                            $result3 = $conn->query($sql3);
                            if ($result3->num_rows > 0) {
                                while ($row3 = $result3->fetch_assoc()) {
                                    $str .= '<li class="pure-menu-item">';
                                    $str .= '<a href="' . $row3['permalink'] . '" title="' . $row3['group_name'] . '" data-id="' . $nId . '" class="pure-menu-link navlink3">';
                                    $str .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row3['group_name'];
                                    $str .= '</a>';
                                    $str .= '</li>';
                                }
                            }
                        
                        $str .= '</ul>';
                        $str .= '</li>';
                        }
                    }                
                $str .= '</ul>';
                $str .= '</li>';
               
            }
        }
        $str .= '</ul>';
        $str .= '</li>';
    }
} else {
    $str = 'Không có thông tin phù hợp ...';
}
echo $str;
DBManager::closeConn($conn);
?>

