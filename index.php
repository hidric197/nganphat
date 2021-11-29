<?php
include 'npad/model/db/DBManager.php';
include 'npad/common/Common.php';
header('Cache-Control: no cache'); //no cache
// session_cache_limiter('private_no_expire'); // works
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
ob_start();

$useragent = $_SERVER['HTTP_USER_AGENT'];
$isMobile = 'False';
if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))){
    $isMobile = 'True';
}

$conn = DBManager::getConnection();
$home_table_name = '';
$home_data_id = '';
$home_level_group = '';
$home_group_id = '';
$home_group_pmk = '';
$home_group_type = '';
$home_product_id = '';
$home_pmk = '';
$home_estr_pmk = '';
$home_prod_filter_id = '';
$home_prod_filter_pmk = '';
$home_page_flg = 'false';

if (isset($_REQUEST['pmk']) && ! empty($_REQUEST['pmk'])) {
    
    $home_pmk = $_REQUEST['pmk'];
    
    if ($home_pmk == 'dang-ky-tai-khoan') {
        if ($isMobile == 'False') {
            include '_accountregis.php';
        } else {
            include '_accountregis_mb.php';
        }
    } else if ($home_pmk == 'lay-lai-mat-khau') {
        if ($isMobile == 'False') {
            include '_accountgetpass.php';
        } else {
            include '_accountgetpass_mb.php';
        }
    } else if ($home_pmk == 'dang-nhap') {
        if ($isMobile == 'False') {
            include '_accountlogin.php';
        } else {
            include '_accountlogin_mb.php';
        }
    } else if ($home_pmk == 'dang-xuat') {
        include '_accountlogout.php';
    } else if ($home_pmk == 'mua-hang') {
        if ($isMobile == 'False') {
            include '_produtctcheckout.php';
        } else {
            include '_produtctcheckout_mb.php';
        }
    } else if ($home_pmk == 'tu-van') {
        include '_produtctcheckout.php';
    } else if ($home_pmk == 'tim-kiem') {
        if ($isMobile == 'False') {
            include '_groupcontent.php';
        } else {
            include '_groupcontent_mb.php';
        }
    } else if ($home_pmk == 'flash-sale') {
        if ($isMobile == 'False') {
            include '_groupcontent.php';
        } else {
            include '_groupcontent_mb.php';
        }
    } else if ($home_pmk == 'khuyen-mai') {
        if ($isMobile == 'False') {
            include '_groupcontent.php';
        } else {
            include '_groupcontent_mb.php';
        }
    } else {        
        $home_estr_pmk = $conn->real_escape_string($home_pmk);
        $sql = "SELECT data_id, permalink, data_table FROM np_permalink ";
        $sql .= " WHERE permalink = '$home_estr_pmk' AND delete_flag = '0'";
        $index_permalink_result = $conn->query($sql);
        if ($index_permalink_result->num_rows > 0) {
            while ($row = $index_permalink_result->fetch_assoc()) {
                $home_table_name = $row['data_table'];
                $home_data_id = $row['data_id'];
            }
        }
        if ($home_table_name == Common::$_TABLE_NP_PROD) {
            $sql = "SELECT B.product_id, A.group_level, A.group_id, A.group_type, B.filter_id, X.permalink AS g_permalink, Z.permalink AS f_permalink FROM np_prod_group A ";
            $sql .= " INNER JOIN np_permalink X ON X.data_id = A.data_id ";
            $sql .= " INNER JOIN np_product B ON B.group_id = A.group_id ";
            $sql .= " INNER JOIN np_permalink C ON C.data_id = B.data_id ";
            $sql .= " LEFT JOIN np_prod_filter Y ON Y.prod_filter_id = B.filter_id ";
            $sql .= " LEFT JOIN np_permalink Z ON Y.data_id = Z.data_id ";
            $sql .= " WHERE C.permalink = '$home_estr_pmk' AND A.delete_flag = '0'";
            $filter_result = $conn->query($sql);
            if ($filter_result->num_rows > 0) {
                while ($rowFilter = $filter_result->fetch_assoc()) {
                    $home_level_group = $rowFilter['group_level'];
                    $home_group_id = $rowFilter['group_id'];
                    $home_group_type = $rowFilter['group_type'];
                    $home_product_id = $rowFilter['product_id'];
                    $home_prod_filter_id = $rowFilter['filter_id'];
                    $home_group_pmk = $rowFilter['g_permalink'];
                    $home_prod_filter_pmk = $rowFilter['f_permalink'];
                }
            }
            if ($isMobile == 'False') {
                include '_productcontent.php';
            } else {
                include '_productcontent_mb.php';
            }
            
        } else if ($home_pmk == Common::$_GROUP_THIET_BI_VE_SINH || $home_pmk == Common::$_GROUP_THIET_BI_VE_SINH_NOI_BAT) {
            $home_level_group = '0';
            $home_group_id = '1';
            $home_group_type = '1';
            $home_data_id = '1';
            $home_table_name = Common::$_TABLE_NP_PROD_GROUP;
            if ($isMobile == 'False') {
                include '_groupcontent.php';
            } else {
                include '_groupcontent_mb.php';
            }
        } else if ($home_pmk == Common::$_GROUP_THIET_BI_DIEN || $home_pmk == Common::$_GROUP_THIET_BI_DIEN_NOI_BAT) {
            $home_level_group = '0';
            $home_group_id = '3';
            $home_group_type = '3';
            $home_data_id = '3';
            $home_table_name = Common::$_TABLE_NP_PROD_GROUP;
            if ($isMobile == 'False') {
                include '_groupcontent.php';
            } else {
                include '_groupcontent_mb.php';
            }
        } else if ($home_pmk == Common::$_GROUP_THIET_BI_NHA_BEP || $home_pmk == Common::$_GROUP_THIET_BI_NHA_BEP_NOI_BAT) {
            $home_level_group = '0';
            $home_group_id = '2';
            $home_group_type = '2';
            $home_data_id = '2';
            $home_table_name = Common::$_TABLE_NP_PROD_GROUP;
            if ($isMobile == 'False') {
                include '_groupcontent.php';
            } else {
                include '_groupcontent_mb.php';
            }
        } else if ($home_table_name == Common::$_TABLE_NP_PROD_GROUP) {
            $sql = "SELECT A.group_level, A.group_id, A.group_type FROM np_prod_group A ";
            $sql .= " INNER JOIN np_permalink B ON B.data_id = A.data_id ";
            $sql .= " WHERE B.permalink = '$home_estr_pmk' AND A.delete_flag = '0'";
            $index_groupproduct_result = $conn->query($sql);
            if ($index_groupproduct_result->num_rows > 0) {
                while ($rowxx = $index_groupproduct_result->fetch_assoc()) {
                    $home_level_group = $rowxx['group_level'];
                    $home_group_id = $rowxx['group_id'];
                    $home_group_type = $rowxx['group_type'];
                }
                if ($isMobile == 'False') {
                    include '_groupcontent.php';
                } else {
                    include '_groupcontent_mb.php';
                }
            } else {
                $home_page_flg = 'true';
                if ($isMobile == 'False') {
                    include '_homecontent_pc.php';
                } else {
                    include '_homecontent_mb.php';
                }
            }
        } else if ($home_table_name == Common::$_TABLE_NP_PAGE){
            if ($isMobile == 'False') {
                include '_new_detail.php';
            } else {
                include '_new_detail_mb.php';
            }
        } else if ($home_table_name == Common::$_TABLE_NP_PROD_BRAND){
            if ($isMobile == 'False') {
                include '_groupcontent.php';
            } else {
                include '_groupcontent_mb.php';
            }
        } else if ($home_table_name == Common::$_TABLE_NP_PROD_TAG){
            if ($isMobile == 'False') {
                include '_groupcontent.php';
            } else {
                include '_groupcontent_mb.php';
            }
        } else if ($home_table_name == Common::$_TABLE_NP_PROD_FILTER){
            $sql = "SELECT A.group_level, A.group_id, A.group_type FROM np_prod_group A ";
            $sql .= " INNER JOIN np_prod_filter B ON B.group_id = A.group_id ";
            $sql .= " WHERE B.data_id = '$home_data_id' AND A.delete_flag = '0'";
            $filter_result = $conn->query($sql);
            if ($filter_result->num_rows > 0) {
                while ($rowFilter = $filter_result->fetch_assoc()) {
                    $home_level_group = $rowFilter['group_level'];
                    $home_group_id = $rowFilter['group_id'];
                    $home_group_type = $rowFilter['group_type'];
                }
            }
            
            $sql = "SELECT A.prod_filter_id FROM np_prod_filter A ";
            $sql .= " WHERE A.data_id = '$home_data_id' AND A.delete_flag = '0'";
            $filter_result = $conn->query($sql);
            if ($filter_result->num_rows > 0) {
                while ($rowFilter = $filter_result->fetch_assoc()) {
                    $home_prod_filter_id = $rowFilter['prod_filter_id'];
                }
            }
            
            if ($isMobile == 'False') {
                include '_groupcontent.php';
            } else {
                include '_groupcontent_mb.php';
            }
        } else if ($home_table_name == Common::$_TABLE_NP_LANDING_PAGE){
            include '_landingPage1.php';
        } else {
            if ($isMobile == 'False') {
                include '404.php';
            } else {
                include '404_mb.php';
            }
        }
    }
} else {
    $home_page_flg = 'true';
    if ($isMobile == 'False') {
        include '_homecontent_pc.php';
    } else {
        include '_homecontent_mb.php';
    }
}
DBManager::closeConn($conn);
?>
