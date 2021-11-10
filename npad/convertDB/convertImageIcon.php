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

	<a href="http://localhost/nganphat/npad/convertDB/convertImageIcon.php"><input type="button" name="ListProduct" value="ListProduct"/></a>
	<input type="submit" name="CopyImageIcon" value="Copy ImageIcon" />
</form>

<?php
    $mess = '';
    $total = 0;
    $sql = "SELECT product_id FROM np_product";
    $result = $conn02->query($sql);
    if ($result->num_rows > 0) {
        $total  = $result->num_rows;
        ?>
<br>Tong : <?=$total?>
<table class="table">
	<tr>
		<td>product_id</td>
	</tr>
		
	<?php
// 	$n = 0;
	while ($row = $result->fetch_assoc()) {
// 	    if ($n >= 1) {
// 	        break;
// 	    }
// 	    $n++;
            if (isset($_REQUEST['CopyImageIcon']) && $_REQUEST['CopyImageIcon'] == 'Copy ImageIcon') {
                
                $id = $row['product_id'];
                $imageType = '1';

                $image_title = '';
                $url = 'uploadImage/ac-2700.jpg';
                
                $sql2 = "INSERT INTO np_prod_image(product_id, image_type, image_title, image_url) VALUES (?,?,?,?)";
                $stmt2 = $conn02->prepare($sql2);
                $stmt2->bind_param("ssss", $id, $imageType, $image_title, $url);
                $stmt2->execute();
                
                $mess = "insert OK het";
            }
       ?>
		<tr>
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