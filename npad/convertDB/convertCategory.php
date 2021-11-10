<?php
include 'DB.php';
include '../model/db/DBManager.php';

$conn01 = DBManager01::getConnection();
$conn02 = DBManager02::getConnection();
// Turn autocommit off
$conn01->autocommit(FALSE);
$conn02->autocommit(FALSE);
?>


<?php 
$parentid = '';
if (isset($_REQUEST['parentid']) && !empty($_REQUEST['parentid'])) {
    $parentid = $_REQUEST['parentid'];
}
?>
<html>
<form>
	DB Nguồn : <input type="text" name="parentid" value="<?=$parentid?>" /> 
	<input type="submit" name="select" value="Select" />
	<input type="submit" name="CopyGroup" value="Copy Group" />
	<input type="submit" name="CopyFilter" value="Copy Filter" />
</form>

<?php
    $mess = '';
    $parentid = $_REQUEST['parentid'];
    $sql = "select A1.term_taxonomy_id, A1.term_id, A2.name, A2.slug, A1.description
            from hug_term_taxonomy A1
            INNER JOIN hug_terms A2
            ON A1.term_id = A2.term_id
            where A1.taxonomy = 'category' AND A1.parent = '$parentid'";

    $result = $conn01->query($sql);
    if ($result->num_rows > 0) {

        ?>
<table class="table">
	<tr>
		<td>ParentId</td>
		<td>term_taxonomy_id</td>
		<td>term_id</td>
		<td>name</td>
		<td>slug</td>
		<td>description</td>
	</tr>
		
	<?php
        while ($row = $result->fetch_assoc()) {
            
            if (isset($_REQUEST['CopyGroup']) && $_REQUEST['CopyGroup'] == 'Copy Group') {
                $group_level = 0;
                $group_level_up = 0;
                $group_type = 0;
                $sql1 = "SELECT * FROM mapcategory WHERE term_id ='$parentid'";
                $result1 = $conn01->query($sql1);
                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
                        $group_level = $row1["level"] + 1 ;
                        $group_level_up = $row1["group_id"] ;
                        $group_type = $row1["grouptype"] ;
                    }
                }

                $term_id = $row['term_id'];
                $sql2 = "SELECT * FROM mapcategory WHERE term_id = '$term_id'";
                $result2 = $conn01->query($sql2);
                if ($result2->num_rows > 0) {
                    echo "No";
                } else {
                    $permalinkValue = $row["slug"];
                    $table_name = "np_prod_group";
                    
                    $groupName = $row["name"];
                    $group_description = $row["description"];
                    
                    NpPermaLinkDba::insertData($conn02, $permalinkValue, $table_name);
                    $data_id = NpPermaLinkDba::getMaxDataId($conn02);
                    
                    $sql3 = "INSERT INTO np_prod_group (data_id, group_type, group_level, group_level_up, group_name, group_description) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt3 = $conn02->prepare($sql3);
                    $stmt3->bind_param("ssssss", $data_id, $group_type, $group_level, $group_level_up, $groupName, $group_description);
                    $stmt3->execute();
                    
                    
                    $groupidMax = 0;
                    $sql5 = "SELECT Max(group_id) AS group_id FROM np_prod_group";
                    $result5 = $conn02->query($sql5);
                    if ($result5->num_rows > 0) {
                        // output data of each row
                        while ($row5 = $result5->fetch_assoc()) {
                            $groupidMax = $row5["group_id"];
                        }
                    }
                    
                    $sql4 = "INSERT INTO mapcategory (term_taxonomy_id , term_id , group_id , level, groupName, groupNameSlug, grouptype) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt4 = $conn01->prepare($sql4);
                    $stmt4->bind_param("sssssss", $term_id, $term_id, $groupidMax, $group_level, $groupName, $permalinkValue, $group_type);
                    $stmt4->execute();
                    
                    
                    $mess = "insert OK het";
                }
            } else if (isset($_REQUEST['CopyFilter']) && $_REQUEST['CopyFilter'] == 'Copy Filter') {
                
                $groupid = 0;
                $sql1 = "SELECT * FROM mapcategory WHERE term_id ='$parentid'";
                $result1 = $conn01->query($sql1);
                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
                        $groupid = $row1["group_id"] ;
                    }
                }
                
                $term_id = $row['term_id'];
                $sql2 = "SELECT * FROM mapfilter WHERE term_id = '$term_id'";
                $result2 = $conn01->query($sql2);
                if ($result2->num_rows > 0) {
                    echo "No";
                } else {
                    $permalinkValue = $row["slug"];
                    $table_name = "np_prod_filter";
                    
                    $prod_filter_name = $row["name"];
                    $prod_filter_description = $row["description"];
                    
                    NpPermaLinkDba::insertData($conn02, $permalinkValue, $table_name);
                    $data_id = NpPermaLinkDba::getMaxDataId($conn02);
                    
                    $sql3 = "INSERT INTO np_prod_filter (data_id, group_id, prod_filter_name, prod_filter_description) VALUES (?, ?, ?, ?)";
                    $stmt3 = $conn02->prepare($sql3);
                    $stmt3->bind_param("ssss", $data_id, $groupid, $prod_filter_name, $prod_filter_description);
                    $stmt3->execute();
                    
                    
                    $filteridMax = 0;
                    $sql5 = "SELECT Max(prod_filter_id) AS prod_filter_id FROM np_prod_filter";
                    $result5 = $conn02->query($sql5);
                    if ($result5->num_rows > 0) {
                        // output data of each row
                        while ($row5 = $result5->fetch_assoc()) {
                            $filteridMax = $row5["prod_filter_id"];
                        }
                    }
                    
                    $sql4 = "INSERT INTO mapfilter (term_taxonomy_id , term_id , filter_id , prod_filter_name, prod_filter_description) VALUES (?, ?, ?, ?, ?)";
                    $stmt4 = $conn01->prepare($sql4);
                    $stmt4->bind_param("sssss", $term_id, $term_id, $filteridMax, $prod_filter_name, $prod_filter_description);
                    $stmt4->execute();
                    
                    
                    $mess = "insert OK het";
                }
            }

       ?>
				<tr>
    		<td><?=$parentid?></td>
    		<td><?=$row["term_taxonomy_id"]?></td>
    		<td><?=$row["term_id"]?></td>
    		<td><?=$row["name"]?></td>
    		<td><?=$row["slug"]?></td>
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