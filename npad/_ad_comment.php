<div class="row">
	<ol class="breadcrumb">
		<li><a href="index.php"> <em class="fa fa-home"></em>
		</a></li>
		<li class="active">Quản lý Comment Sản Phẩm</li>
	</ol>
</div>
<!--/.row-->

<div class="row">
	<div class="col-lg-12">
		</br> <a href="?pcid=<?=$_REQUEST['pcid']?>&display=list"><button
				type="button" class="btn btn-sm btn-primary">Danh sách Comment</button></a>
		</br></br></br>
	</div>
</div>
<!--/.row-->

<?php
if (isset($_REQUEST['display']) && $_REQUEST['display'] == "edit") {
    $message = "";
    if (isset($_REQUEST['submit']))
    {
        $id = $_POST['id'];
        $comment_detail = $_POST['comment_detail'];
        $refer_id = '';
        $comment_title = '';
        $comment_type = '';
        $comment_index = '';
        $comment_status = $_POST['comment_status'];
        
        if ($comment_status == 0) {
            // update status
            $sql = " UPDATE np_comment SET comment_status = '0' ";
            $sql .= $sql_common_update;
            $sql .= " WHERE comment_id = ? ";
            
            // update lai status
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            
        } else {
            // update status
            $sql = " UPDATE np_comment SET comment_status = '1' ";
            $sql .= $sql_common_update;
            $sql .= " WHERE comment_id = ? ";
            
            // update lai status
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            
            // lay thong tin ban dau
            $sql = "SELECT A.comment_id, A. comment_title, A.refer_id, A.comment_name, A.comment_email, A.comment_detail ";
            $sql .= " , A.comment_status, A.comment_type, A.comment_index FROM np_comment A ";
            $sql .= " WHERE A.comment_id = '$id' AND A.delete_flag = '0'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $refer_id = $row['refer_id'];
                    $comment_title = $row['comment_title'];
                    $comment_type = $row['comment_type'];
                    $comment_index = $row['comment_index'] + 1;
                }
            }
            
            $sql1 = "INSERT INTO np_comment (refer_id, comment_title, comment_name, comment_email, comment_detail, comment_status, comment_type, comment_index, comment_flow) ";
            $sql1 .= " VALUES (?, ?, 'Nganphat.com.vn', '', ?, '1', ?, ?, ?) ";
            $stmt = $conn->prepare($sql1);
            $stmt->bind_param("ssssss", $refer_id, $comment_title, $comment_detail, $comment_type, $comment_index, $id);
            $stmt->execute();
        }
        $message = $INFO_UPDATE_DATA_OK;
    }
    if (!isset($_REQUEST['id']))
    {
        $message = $ERROR_UPDATE_DATA_FAIL;
    } else {
        $id = $conn->real_escape_string($_REQUEST['id']);
        
        $sql = "SELECT A.comment_id, A.refer_id, A.comment_name, A.comment_email, A.comment_detail ";
        $sql .= " , A.comment_status, A.comment_type, A.comment_index FROM np_comment A ";
        $sql .= " WHERE A.comment_id = '$id' AND A.delete_flag = '0'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Chi tiết comment <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form action="" method="post">
						<div class="form-group">
							<label>Tên : </label> <?=$row['comment_name']?>
						</div>
						<div class="form-group">
							<label>Email : </label> <?=$row['comment_email']?>
						</div>
						<div class="form-group">
							<label>Trạng Thái : </label> 
							<?php
        						if ($row['comment_status'] == '0') {
        						      echo "Chưa Duyệt";
        						} else if ($row['comment_status'] == '1') {
        						      echo "Đã Duyệt";
        						}
            				?>
						</div>
						<div class="form-group">
							<label>Link comment : </label> 
								<?php 
                                $sq1 = '';
                                $cmType1 = '';
                                if ($row['comment_type'] == '1') {
                                    $sql1 = " SELECT A.comment_id, C.permalink FROM np_comment A ";
                                    $sql1 .= " INNER JOIN np_product B ON A.refer_id = B.product_id AND A.comment_type = '1' ";
                                    $sql1 .= " INNER JOIN np_permalink C ON B.data_id = C.data_id ";
                                    $sql1 .= " WHERE A.comment_id = '" . $row['comment_id'] . "' ";
                                    $cmType1 = 'Link Sản phẩm';
                                } else if ($row['comment_type'] == '2') {
                                    $sql1 = " SELECT A.comment_id, C.permalink FROM np_comment A ";
                                    $sql1 .= " INNER JOIN np_page B ON A.refer_id = B.page_id AND A.comment_type = '2' ";
                                    $sql1 .= " INNER JOIN np_permalink C ON B.data_id = C.data_id ";
                                    $sql1 .= " WHERE A.comment_id = '" . $row['comment_id'] . "' ";
                                    $cmType1 = 'Link Page';
                                }
                                $result1 = $conn->query($sql1);
                                if ($result1->num_rows > 0) {
                                    while ($row1 = $result1->fetch_assoc()) {
                                        echo "<a target='blank' href='" . Common::$_HOME_PAGE . "/" . $row1['permalink']. "'>" . $cmType1 . "</a>";
                                    }
                                }
    						?>
						</div>
						<div class="form-group">
							<label>Chi tiết : </label> <?=$row['comment_detail']?>
						</div>
						<div class="form-group">
							<label>Trả lời: </label> _Max: 4000 ký tự
							<textarea rows="10" class="form-control" name="comment_detail" id="comment_detail" ></textarea>
						</div>
						<div class="form-group">
							<label>Update trạng thái comment : 
							<input type="radio" name="comment_status" id="comment_status1" value="1" <?php if ($row['comment_status'] == '1') echo 'checked'; ?>>&nbsp;Hiển thị
							&nbsp;&nbsp;&nbsp;
							<input type="radio" name="comment_status" id="comment_status2" value="0" <?php if ($row['comment_status'] == '0') echo 'checked'; ?> >&nbsp;Không hiển thị
							</label>
						</div>
						<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' />
						<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
						<input type="hidden" name='id' value='<?=$_REQUEST['id']?>' /> 
						<input
							type="submit" name="submit" value="Trả lời & Duyệt comment"
							class="btn btn-primary" /> 
						<input type="button"
							class="btn btn-default" value="Quay lại" onclick="window.history.back();"/>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
        }
      }
    }
    ?>
<?php
} else {
    $sql = "SELECT A.comment_id, A.refer_id, A.comment_name, A.comment_status, A.comment_type FROM np_comment A ";
    $sql .= " WHERE A.delete_flag = '0' AND comment_name <> 'Nganphat.com.vn' ORDER BY comment_status, insert_datetime DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $n = 0;
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách Comment Sản Phẩm</div>
			<div class="panel-body">
				<table class="table">
    				<tr>
    					<td>No</td>
    					<td>Comment Title</td>
    					<td>Link comment</td>
    					<td>Trang thái</td>					
    					<td>Chi Tiết</td>
    				</tr>
    				<?php 
    				while ($row = $result->fetch_assoc()) {
    				    $n ++;
    				?>
    				<tr>
    					<td><?=$n?></td>
    					<td><?=$row['comment_name']?></td>
    					<td>
    						<?php 
                                $sq1 = '';
                                $cmType1 = '';
                                if ($row['comment_type'] == '1') {
                                    $sql1 = " SELECT A.comment_id, C.permalink FROM np_comment A ";
                                    $sql1 .= " INNER JOIN np_product B ON A.refer_id = B.product_id AND A.comment_type = '1' ";
                                    $sql1 .= " INNER JOIN np_permalink C ON B.data_id = C.data_id ";
                                    $sql1 .= " WHERE A.comment_id = '" . $row['comment_id'] . "' ";
                                    $sql1 .= " ORDER BY comment_status";
                                    $cmType1 = 'Link Sản Phẩm';
                                } else if ($row['comment_type'] == '2') {
                                    $sql1 = " SELECT A.comment_id, C.permalink FROM np_comment A ";
                                    $sql1 .= " INNER JOIN np_page B ON A.refer_id = B.page_id AND A.comment_type = '2' ";
                                    $sql1 .= " INNER JOIN np_permalink C ON B.data_id = C.data_id ";
                                    $sql1 .= " WHERE A.comment_id = '" . $row['comment_id'] . "' ";
                                    $sql1 .= " ORDER BY comment_status";
                                    $cmType1 = 'Link Page';
                                }
                                $result1 = $conn->query($sql1);
                                if ($result1->num_rows > 0) {
                                    while ($row1 = $result1->fetch_assoc()) {
                                        echo "<a target='blank' href='" . Common::$_HOME_PAGE . "/" . $row1['permalink']. "'>" . $cmType1 . "</a>";
                                    }
                                }
    						?>
    					</td>
    					<td>
    						<?php
        						if ($row['comment_status'] == '0') {
        						      echo "Chưa Duyệt";
        						} else if ($row['comment_status'] == '1') {
        						      echo "Đã Duyệt";
        						}
            				?>
            			</td>
    					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=edit&id=<?=$row['comment_id']?>">Xem & Trả lời</a></td>
    				</tr>
    				<?php 
    				}
    				?>
				</table>
			</div>
		</div>
	</div>
</div>
	<?php 
    }
	?>
<?php 
}
?>