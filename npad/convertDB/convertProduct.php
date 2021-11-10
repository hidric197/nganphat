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

	<a href="http://localhost/nganphat/npad/convertDB/convertProduct.php"><input type="button" name="ListProduct" value="ListProduct"/></a>
	<input type="submit" name="CopyProduct" value="Copy Product" />
</form>

<?php
    $mess = '';
    $total = 0;
    $sql = "(SELECT A1.ID, A3.group_id AS group_id, '' AS filter_id, A1.post_title, A1.post_name, A1.post_content FROM hug_posts A1
                INNER JOIN hug_term_relationships A2
                	ON A1.ID = A2.object_id
                INNER JOIN mapcategory A3
                	ON A2.term_taxonomy_id = A3.term_taxonomy_id
                WHERE A1.post_status = 'publish' AND A1.post_type = 'sanpham')
            UNION ALL
            (SELECT A1.ID, '' AS group_id, A3.filter_id AS filter_id, A1.post_title, A1.post_name, A1.post_content FROM hug_posts A1
                            INNER JOIN hug_term_relationships A2
                            	ON A1.ID = A2.object_id
                            INNER JOIN mapfilter A3
                            	ON A2.term_taxonomy_id = A3.term_taxonomy_id
                            WHERE A1.post_status = 'publish' AND A1.post_type = 'sanpham')";
    $result = $conn01->query($sql);
    if ($result->num_rows > 0) {
        $total  = $result->num_rows;
        ?>
<br>Tong : <?=$total?>
<table class="table">
	<tr>
		<td>post_id</td>
		<td>group_id</td>
		<td>filter_id</td>
		<td>post_title</td>
		<td>post_name</td>
	</tr>
		
	<?php
// 	$n = 0;
	while ($row = $result->fetch_assoc()) {
// 	    if ($n >= 1) {
// 	        break;
// 	    }
// 	    $n++;
            if (isset($_REQUEST['CopyProduct']) && $_REQUEST['CopyProduct'] == 'Copy Product') {
                $postid = $row['ID'];
                $sql2 = "SELECT * FROM mapproduct WHERE post_id = '$postid'";
                $result2 = $conn01->query($sql2);
                if ($result2->num_rows > 0) {
                    echo "No";
                } else {
                    
                    $permalinkValue = $row["post_name"];
                    $table_name = "np_product";
                    NpPermaLinkDba::insertData($conn02, $permalinkValue, $table_name);
                    $data_id = NpPermaLinkDba::getMaxDataId($conn02);
                    
                    $group_id = $row["group_id"];
                    if (empty($group_id)) {
                        $group_id = 0;
                    }
                    $prod_filter_id = $row["filter_id"];
                    if (empty($prod_filter_id)) {
                        $prod_filter_id = 0;
                    }
                    
                    $brand_id = '';
                    $product_name = $row["post_title"];
                    $product_code = '';
                    $product_old_price = '';
                    $product_down_price = '';
                    $product_sell_price = '';
                    $product_status = '';
                    $product_function = '';
                    $product_color = '';
                    $product_size = '';
                    $product_material = '';
                    $product_style = '';
                    $product_made_in = '';
                    $product_other_info = '';
                    $product_save = '';
                    $product_flash_sale = '0';
                    $product_hot = '0';
                    $product_detail = $row["post_content"];
                    $product_seo = '';
                    
                    $sql3 = "INSERT INTO np_product (";
                    $sql3 .= " data_id, group_id, filter_id, brand_id, product_name, product_code, ";
                    $sql3 .= " product_old_price, product_down_price, product_sell_price, product_status, product_function, ";
                    $sql3 .= " product_color, product_size, product_material, product_style, product_made_in, ";
                    $sql3 .= " product_other_info, product_save, product_flash_sale, product_hot, product_detail, product_seo";
                    $sql3 .= ") ";
                    $sql3 .= " VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $stmt3 = $conn02->prepare($sql3);
                    $stmt3->bind_param("ssssssssssssssssssssss", $data_id, $group_id, $prod_filter_id, $brand_id,
                        $product_name, $product_code, $product_old_price, $product_down_price, $product_sell_price,
                        $product_status, $product_function, $product_color, $product_size, $product_material, $product_style,
                        $product_made_in, $product_other_info, $product_save, $product_flash_sale, $product_hot, $product_detail, $product_seo);
                    $stmt3->execute();
                    
                    $productMax = 0;
                    $sql5 = "SELECT Max(product_id) AS product_id FROM np_product";
                    $result5 = $conn02->query($sql5);
                    if ($result5->num_rows > 0) {
                        // output data of each row
                        while ($row5 = $result5->fetch_assoc()) {
                            $productMax = $row5["product_id"];
                        }
                    }
                    
                    $sql4 = "INSERT INTO mapproduct (post_id , product_id) VALUES (?, ?)";
                    $stmt4 = $conn01->prepare($sql4);
                    $stmt4->bind_param("ss", $postid, $productMax);
                    $stmt4->execute();
                    
                    
                    $mess = "insert OK het";
                }
            }
       ?>
		<tr>
			<td><?=$row["ID"]?></td>
			<td><?=$row["group_id"]?></td>
			<td><?=$row["filter_id"]?></td>
    		<td><?=$row["post_title"]?></td>
    		<td><?=$row["post_name"]?></td>
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