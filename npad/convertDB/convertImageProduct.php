<?php
include 'DB.php';
include '../model/db/DBManager.php';

$conn01 = DBManager01::getConnection();
$conn02 = DBManager02::getConnection();
// Turn autocommit off
$conn01->autocommit(FALSE);
set_time_limit(5000); 
?>

<html>
<form>

	<a href="http://localhost/nganphat/npad/convertDB/convertImageProduct.php"><input type="button" name="ListProduct" value="ListProduct"/></a>
	<input type="submit" name="CopyImageProduct" value="Copy ImageProduct" />
</form>

<?php
    $mess = '';
    $total = 0;
    $sql = "SELECT B.product_id, A.ID, A.post_parent, A.guid, A.post_type, A.post_mime_type FROM hug_posts A
                	INNER JOIN mapproduct B 
                    	ON A.post_parent = B.post_id
                WHERE A.post_type = 'attachment' and A.post_mime_type = 'image/jpeg'
                ORDER BY A.post_parent";
    $result = $conn01->query($sql);
    if ($result->num_rows > 0) {
        $total  = $result->num_rows;
        ?>
<br>Tong : <?=$total?>
<table class="table">
	<tr>
		<td>No</td>
		<td>product_id</td>
		<td>post_parent</td>
		<td>ID</td>
		<td>guid</td>
		<td>local_images</td>
		<td>images_name</td>
		<td>url</td>
		<td>post_type</td>
		<td>post_mime_type</td>
	</tr>
		
	<?php
	$n = 0;
	while ($row = $result->fetch_assoc()) {
// 	    if ($n >= 1) {
// 	        break;
// 	    }
	    $n++;

	    
	    
	    $localImg = $row['guid'];
	    $localImg = str_replace('http://nganphat.com.vn', 'C:\Users\Onsiter\Downloads\public_html', $localImg);
	    
	    $lastIndex = strripos($localImg, '/');
	    $imageName = substr($localImg, $lastIndex, strlen($localImg) - $lastIndex);
	    $product_id = $row['product_id'];
	    
	    $copyTo = 'C:\xampp\htdocs\nganphat\npad\uploadImage' . $imageName;
	    
	    $urlForDb = 'uploadImage' . $imageName;
	    
        if (isset($_REQUEST['CopyImageProduct']) && $_REQUEST['CopyImageProduct'] == 'Copy ImageProduct') {  
            // update vao image Icon
            $sql3 = "UPDATE np_prod_image SET image_url = ? WHERE product_id = ? AND image_type = '1' ";
            $stmt3 = $conn02->prepare($sql3);
            $stmt3->bind_param("ss", $urlForDb, $product_id);
            $stmt3->execute();
            
            $count = 0;
            $sql4 = "SELECT COUNT(*) as count FROM np_prod_image WHERE product_id = '$product_id' AND image_type = '2' AND 	image_url = '$urlForDb' ";
            $result4 = $conn02->query($sql4);
            if ($result4->num_rows > 0) {
                while ($row4 = $result4->fetch_assoc()) {
                    $count = $row4['count'];
                }
            }
            if ($count == 0) {
                $imageType = '2';
                $image_title = '';
                
                $sql5 = "INSERT INTO np_prod_image(product_id, image_type, image_title, image_url) VALUES (?,?,?,?)";
                $stmt5 = $conn02->prepare($sql5);
                $stmt5->bind_param("ssss", $product_id, $imageType, $image_title, $urlForDb);
                $stmt5->execute();
            }
            // copy file vao thu muc upload
            copy($localImg, $copyTo);
            
            $mess = "insert OK het";
        }
?>
		<tr>
			<td><?=$n?></td>
			<td><?=$product_id?></td>
    		<td><?=$row["post_parent"]?></td>
			<td><?=$row["ID"]?></td>
    		<td></td>
    		<td><?=$localImg?></td>
    		<td><?=$copyTo?></td>
    		<td><?=$urlForDb?></td>
    		<td><?=$row["post_type"]?></td>
    		<td><?=$row["post_mime_type"]?></td>
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
// if (! $conn02->commit()) {
//     echo "Commit transaction failed";
//     exit();
// }
// Rollback transaction
$conn01->rollback();
DBManager01::closeConn($conn01);


// $conn02->rollback();
DBManager01::closeConn($conn02);
?>