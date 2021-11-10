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

	<a href="http://localhost/nganphat/npad/convertDB/convertProductgroupID.php"><input type="button" name="ListProduct" value="ListProduct"/></a>
	<input type="submit" name="CopyGroupId" value="Copy GroupId" />
</form>

<?php
    $mess = '';
    $total = 0;
    $sql = "SELECT product_id, group_id, filter_id FROM np_product WHERE filter_id NOT IN ('0')";
    $result = $conn02->query($sql);
    if ($result->num_rows > 0) {
        $total  = $result->num_rows;
        ?>
<br>Tong : <?=$total?>
<table class="table">
	<tr>
		<td>post_id</td>
		<td>group_id</td>
		<td>filter_id</td>
	</tr>
		
	<?php
// 	$n = 0;
	while ($row = $result->fetch_assoc()) {
// 	    if ($n >= 1) {
// 	        break;
// 	    }
// 	    $n++;
            if (isset($_REQUEST['CopyGroupId']) && $_REQUEST['CopyGroupId'] == 'Copy GroupId') {
                $product_id = $row['product_id'];
                $filter_id = $row['filter_id'];
                
                $sql2 = "SELECT group_id FROM np_prod_filter WHERE prod_filter_id = '$filter_id'";

                $result2 = $conn02->query($sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $group_id = $row2['group_id'];
                        
                        $sql3 = "UPDATE np_product SET group_id = ? WHERE product_id = ?";
                        $stmt3 = $conn02->prepare($sql3);
                        $stmt3->bind_param("ss", $group_id, $product_id);
                        $stmt3->execute();
                    }
                }
                
                $mess = "insert OK het";
            }
       ?>
		<tr>
			<td><?=$row["product_id"]?></td>
			<td><?=$row["group_id"]?></td>
			<td><?=$row["filter_id"]?></td>
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