<?php
include 'DB.php';
include '../model/db/DBManager.php';

$conn01 = DBManager01::getConnection();
$conn02 = DBManager02::getConnection();
// Turn autocommit off
$conn01->autocommit(FALSE);
$conn02->autocommit(FALSE);
?>

<html>
<form>

	<a href="http://localhost/nganphat/npad/convertDB/convertProductInfo.php"><input type="button" name="ListProduct" value="ListProduct"/></a>
	<input type="submit" name="CopyProductInfo" value="Copy ProductInfo" />
</form>

<?php
    $mess = '';
    $total = 0;
    $sql = "SELECT post_id , product_id FROM mapproduct";
    $result = $conn01->query($sql);
    if ($result->num_rows > 0) {
        $total  = $result->num_rows;
        ?>
<br>Tong : <?=$total?>
<table class="table">
	<tr>
		<td>post_id</td>
		<td>product_id</td>
	</tr>
		
	<?php
// 	$n = 0;
	while ($row = $result->fetch_assoc()) {
// 	    if ($n >= 1) {
// 	        break;
// 	    }
// 	    $n++;
            if (isset($_REQUEST['CopyProductInfo']) && $_REQUEST['CopyProductInfo'] == 'Copy ProductInfo') {
                $Giasp = '';
                $Giakm = '';
                $xuatxu = '';
                $baohanh = '';
                $khuyenmai = '';
                $thongso = '';
                
                $post_id = $row['post_id'];
                $sql2 = "SELECT meta_key, meta_value FROM hug_postmeta where post_id = '$post_id'";
                $result2 = $conn01->query($sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        if ($row2['meta_key'] == 'Giasp') {
                            $Giasp = $row2['meta_value'];
                        }
                        if ($row2['meta_key'] == 'Giakm') {
                            $Giakm = $row2['meta_value'];
                        }
                        if ($row2['meta_key'] == 'xuatxu') {
                            $xuatxu = $row2['meta_value'];
                        }
                        if ($row2['meta_key'] == 'baohanh') {
                            $baohanh = $row2['meta_value'];
                        }
                        if ($row2['meta_key'] == 'tinhtrang') {
                            $tinhtrang = $row2['meta_value'];
                        }
                        if ($row2['meta_key'] == 'vanchuyen') {
                            $vanchuyen = $row2['meta_value'];
                        }
                        if ($row2['meta_key'] == 'lapdat') {
                            $lapdat = $row2['meta_value'];
                        }
                        if ($row2['meta_key'] == 'khuyenmai') {
                            $khuyenmai = $row2['meta_value'];
                        }
                        if ($row2['meta_key'] == 'thongso') {
                            $thongso = $row2['meta_value'];
                        }
                    }
                }
                if (empty($Giakm)) {
                    $Giakm = $Giasp;
                }
                
                $product_color = '';
                $product_size = '';
                $product_material = '';
                $product_code = '';
                $product_style = '';
                
                $listThongso = explode("</li>", $thongso);
                foreach ($listThongso as $ts) {
                    $ts = str_replace("</li>", "", $ts);
                    $ts = str_replace("<li>", "", $ts);
                    $ts = str_replace("<strong>", "", $ts);
                    $ts = str_replace("</strong>", "", $ts);
                    
                    
                    if (strpos($ts, "Kích thước:") > 0) {
                        $ts = str_replace("Kích thước:", "", $ts);
                        $product_size = $ts;
                        
                    } else if (strpos($ts, "Dung tích:") > 0) {
                        $ts = str_replace("Dung tích:", "", $ts);
                        $product_style = $ts;
                        
                    } else if (strpos($ts, "Chất liệu:") > 0) {
                        $ts = str_replace("Chất liệu:", "", $ts);
                        $product_material = $ts;
                        
                    } else if (strpos($ts, "Màu sắc:") > 0) {
                        $ts = str_replace("Màu sắc:", "", $ts);
                        $product_color = $ts;
                        
                    } else if (strpos($ts, "Mã sản phẩm :") > 0) {
                        $ts = str_replace("Mã sản phẩm :", "", $ts);
                        $ts = substr($ts, strpos($ts, "<ul>"), strlen($ts));
                        $ts = str_replace("<b>", "", $ts);
                        $ts = str_replace("</b>", "", $ts);
                        $ts = str_replace("<ul>", "", $ts);
                        
                        $product_code = $ts;
                        
                    } else {
                    }
                                       
                }

                $product_id = $row['product_id'];
                $sql3 = "UPDATE np_product SET 
                            product_code = ?
                            , product_old_price = ? 
                            , product_sell_price = ?
                            , product_color = ?
                            , product_size = ?
                            , product_material = ?
                            , product_style = ?
                            , product_made_in = ?
                            , product_other_info = ?
                            , product_save = ?
                        WHERE product_id = ?";
                $stmt3 = $conn02->prepare($sql3);
                $stmt3->bind_param("sssssssssss", $product_code, $Giakm, $Giasp, $product_color, $product_size, $product_material, $product_style, $xuatxu, $khuyenmai, $baohanh, $product_id);
                $stmt3->execute();
                
                $mess = "insert OK het";
            }
       ?>
		<tr>
			<td><?=$row["post_id"]?></td>
			<td><?=$row["product_id"]?></td>
    		<td></td>
    	</tr>
				<?php
        }
        ?>
</table>
<br>
<br><!--  -->
<?=$mess?>
<?php
    }
?>
</html>


<?php
// Commit transaction
if (! $conn01->commit()) {
    echo "Commit transaction failed";
    exit();
}
if (! $conn02->commit()) {
    echo "Commit transaction failed";
    exit();
}
// Rollback transaction
$conn01->rollback();
DBManager01::closeConn($conn01);


$conn02->rollback();
DBManager01::closeConn($conn02);
?>