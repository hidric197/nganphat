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

	<a href="http://localhost/nganphat/npad/convertDB/convertImageGroup.php"><input type="button" name="ListProduct" value="ListProduct"/></a>
	<input type="submit" name="CopyImageGroup" value="Copy ImageGroup" />
</form>

<?php
    $mess = '';
    $total = 0;
    $sql = "SELECT group_id FROM np_prod_group";
    $result = $conn02->query($sql);
    if ($result->num_rows > 0) {
        $total  = $result->num_rows;
        ?>
<br>Tong : <?=$total?>
<table class="table">
	<tr>
		<td>group_id</td>
	</tr>
		
	<?php
// 	$n = 0;
	while ($row = $result->fetch_assoc()) {
// 	    if ($n >= 1) {
// 	        break;
// 	    }
// 	    $n++;
            if (isset($_REQUEST['CopyImageGroup']) && $_REQUEST['CopyImageGroup'] == 'Copy ImageGroup') {
                
                $id = $row['group_id'];
                $group_image_title = '';
                $url = 'uploadImage\bon-cau-2-khoi_1600226949.jpg';
                
                $sql2 = "INSERT INTO np_group_image(group_id, group_image_title, group_image_url) VALUES (?,?,?)";
                $stmt2 = $conn02->prepare($sql2);
                $stmt2->bind_param("sss", $id, $group_image_title, $url);
                $stmt2->execute();
                
                $mess = "insert OK het";
            }
       ?>
		<tr>
			<td><?=$row["group_id"]?></td>
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