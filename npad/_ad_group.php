<?php 
$table_name = 'np_prod_group';
$fieldCondidtonName = 'group_id';
$fieldConditionValue = '';
$fieldEditName = 'group_name';
$fieldEditValue = '';
$permalinkValue = '';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?php  echo Common::$_HOME_PAGE .'/npad/' ?>"> <em class="fa fa-home"></em>
		</a></li>
		<li class="active">Quản lý Group Sản Phẩm</li>
	</ol>
</div>
<!--/.row-->
<div class="row">
	<div class="col-lg-12">
		</br> <a href="?pcid=<?=$_REQUEST['pcid']?>&display=list"><button
				type="button" class="btn btn-sm btn-primary">Danh sách Group</button></a>
		<a href="?pcid=<?=$_REQUEST['pcid']?>&display=addnew"><button
				type="button" class="btn btn-sm btn-success">Thêm Group Cấp 1</button></a> </br>
		</br>
	</div>
</div>
<!--/.row-->

<?php
if (isset($_REQUEST['display']) && $_REQUEST['display'] == "addnew") {

    $message = "";

    if (isset($_POST['submit'])) {
        $resultOK = 1;
        if (!isset($_POST['group_name']) || "" == $_POST['group_name']){
            $resultOK = 0;
        }
        if (!isset($_POST['permalink']) || "" == $_POST['permalink']){
            $resultOK = 0;
        }        
        if ($resultOK == 0){
            $message = $ERROR_FIELD_NULL;
        } else {
            $fieldEditValue = $_POST['group_name'];
            $permalinkValue = $_POST['permalink'];
            $group_type = $_REQUEST['group_type'];
            $group_description = $_POST['group_description'];
            $group_seo = $_POST['group_seo'];            
            
            $resultOK = NpPermaLinkDba::insertData($conn, $permalinkValue, $table_name);
            if ($resultOK == 0) {
                $message = $ERROR_DUPLICATE_SLUG;
            } else {
                $data_id = NpPermaLinkDba::getMaxDataId($conn);
                if (isset($_REQUEST['id']) && isset($_REQUEST['grdlv'])) {
                    $id = $_POST['id'];
                    $grdlv = $_POST['grdlv'] + 1;
                    
                    $sql = "INSERT INTO np_prod_group (data_id, group_type, group_level, group_level_up, group_name, group_description, group_seo) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssssss", $data_id, $group_type, $grdlv, $id, $fieldEditValue, $group_description, $group_seo);
                    $stmt->execute();
                } else {
                    $sql = "INSERT INTO np_prod_group (data_id, group_type, group_name, group_description, group_seo) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssss", $data_id, $group_type, $fieldEditValue, $group_description, $group_seo);
                    $stmt->execute();
                }
                
                $message = $INFO_INSERT_DATA_OK;
            }
        }
    }
    ?>
<script type="text/javascript">
    $(document).ready( function() {
        $("#group_name").change(function() {
              $("#permalink").val(slug($('#group_name').val()));
        });
	});
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Thêm Thông Tin Group Sản Phẩm <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form action="" method="post">
						<?php 
						if (!isset($_REQUEST['id']) || !isset($_REQUEST['grdlv']))
						  {
						?>
						<div class="form-group">
							<label>Group Type(<span style='color: red'>*</span>)
							</label> 
							<?php 
							$selected_group_type = '';
							if (isset($_REQUEST['group_type'])){
							    $selected_group_type = $_REQUEST['group_type'];
            				    }
            				?>
							<select class="form-control" name="group_type" id="group_type">
									<option <?php if($selected_group_type == "1"){ echo "selected='selected'";}?> value="1">THIẾT BỊ VỆ SINH (G1)</option>
									<option <?php if($selected_group_type == "2"){ echo "selected='selected'";}?> value="2">THIẾT BỊ NHÀ BẾP (G2)</option>
									<option <?php if($selected_group_type == "3"){ echo "selected='selected'";}?> value="3">THIẾT BỊ ĐIỆN (G3)</option>
							</select>
						</div>
						<?php 
						  }
						?>
						<div class="form-group">
							<label>Group Name(<span style='color: red'>*</span>)
							</label> _Max: 300 ký tự <input type="text" class="form-control" name="group_name" id="group_name"
								value="" />
						</div>
						<div class="form-group">
							<label>Group Name Permalink(<span style='color: red'>*</span>)
							</label> _Permalink là duy nhất. Không được có dấu '.' _Max: 300 ký tự <input type="text"
								class="form-control" name="permalink" id="permalink" value="" />
						</div>
						<div class="form-group">
							<label>Mô tả Group </label> _Có thể nhập hoặc không _Max: 500 ký tự
							<textarea rows="5" class="form-control" name="group_description" id="editor" ></textarea>
						</div>
						<div class="form-group">
							<label>Seo Group </label> _Thông tin Header, Title, Meta ... để SEO _Max: 4000 ký tự
							<textarea rows="10" class="form-control" name="group_seo" id="group_seo" ><title>  </title>
<meta name="description" content="  "/>
<meta name=robots content=INDEX,FOLLOW,ALL />
							</textarea>
						</div>
						<div class="form-group">
							<label>(<span style='color: red'>*</span>)
							</label> Trường cần phải nhập thông tin
						</div>
						<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' />
						<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' />
						<?php 
						if (isset($_REQUEST['id']) && isset($_REQUEST['grdlv']))
						  {
						?>
						<input type="hidden" name='id' value='<?=$_REQUEST['id']?>' />
						<input type="hidden" name='grdlv' value='<?=$_REQUEST['grdlv']?>' />
						<?php 
						  }
						?>
						<input type="submit" name="submit" value="Thêm Thông Tin"
							class="btn btn-primary" /> 
						<input type="reset"
							class="btn btn-default" value="Reset" />
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
} else if (isset($_REQUEST['display']) && $_REQUEST['display'] == "edit") {
    $message = "";
    if (isset($_REQUEST['submit']))
    {
        $fieldConditionValue = $_POST['id'];
        $fieldEditValue = $_POST['group_name'];
        $permalinkValue = $_POST['permalink'];
        $group_description = $_POST['group_description'];
        $group_seo = $_POST['group_seo'];
        $group_menu_display = $_POST['group_menu_display'];
        
        NpPermaLinkDba::updPermalink($conn, $permalinkValue, $login_user_id, $table_name, $fieldCondidtonName, $fieldConditionValue, $fieldEditName, $fieldEditValue);
        
        $sql = "UPDATE np_prod_group SET ";
        $sql .= " group_name = ? ";
        $sql .= " ,group_description = ? ";
        $sql .= " ,group_seo = ? ";
        $sql .= " ,group_menu_display = ? ";
        $sql .= $sql_common_update;
        $sql .= " WHERE group_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $fieldEditValue, $group_description, $group_seo, $group_menu_display, $fieldConditionValue);
        $stmt->execute();
 
        $message = $INFO_UPDATE_DATA_OK;
    }
    if (!isset($_REQUEST['id']))
    {
        $message = $ERROR_UPDATE_DATA_FAIL;
    } else {
        $id = $conn->real_escape_string($_REQUEST['id']);
        $sql = "SELECT A.group_id, A.group_name, A.group_description, A.group_seo, B.permalink, A.group_menu_display ";
        $sql .= " FROM np_prod_group A INNER JOIN np_permalink B ON A.data_id = B.data_id WHERE A.group_id = '$id' AND B.delete_flag = '0'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Sửa Group Sản Phẩm <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form action="" method="post">
						<div class="form-group">
							<label>Group Name(<span style='color: red'>*</span>)
							</label> _Max: 300 ký tự <input type="text" class="form-control" name="group_name" id="group_name"
								value="<?=$row['group_name']?>" />
						</div>
						<div class="form-group">
							<label>Group Name Permalink(<span style='color: red'>*</span>)
							</label> _Permalink là duy nhất. Không được có dấu '.' _Max: 300 ký tự  
						<input type="text"
								class="form-control" name="permalink" id="permalink"
								value="<?=$row['permalink']?>" />
						</div>
						<div class="form-group">
							<label>Mô tả Group </label> _Có thể nhập hoặc không _Max: 500 ký tự
							<textarea rows="5" class="form-control" name="group_description" id="group_description" ><?=$row['group_description']?></textarea>
						</div>
						<div class="form-group">
							<label>Seo Group </label> _Thông tin Header, Title, Meta ... để SEO _Max: 4000 ký tự
							<textarea rows="10" class="form-control" name="group_seo" id="group_seo" ><?=$row['group_seo']?></textarea>
						</div>
						<div class="form-group">
							<label>Setting hiển thị ở menu </label> (Mặc định sẽ không được hiển thị)&nbsp;&nbsp;
							<input type="radio" name="group_menu_display" id="user_type1" value="0" <?php if ($row['group_menu_display'] == '0') echo "checked='checked'"; ?>>&nbsp;Không hiển thị
							&nbsp;&nbsp;&nbsp;
							<input type="radio" name="group_menu_display" id="user_type2" value="1" <?php if ($row['group_menu_display'] == '1') echo "checked='checked'"; ?>>&nbsp;Hiển thị
						</div>
						<div class="form-group">
							<label>(<span style='color: red'>*</span>)
							</label> Trường cần phải nhập thông tin
						</div>
						<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' />
						<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
						<input
							type="hidden" name='id' value='<?=$_REQUEST['id']?>' /> 
						<input
							type="submit" name="submit" value="Sửa Dữ Liệu"
							class="btn btn-primary" /> 
						<input type="reset"
							class="btn btn-default" value="Reset" />
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
    $message = "";
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' && isset($_REQUEST['id']))
    {
        $id = $_REQUEST['id'];
        NpPermaLinkDba::delPermalink($conn, $table_name, $fieldCondidtonName, $id);
        $message = $INFO_DELETE_DATA_OK;
    }
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách Group Sản Phẩm <?=$message?></div>
			<div class="panel-heading">
			<form action=""  method="post">
				<?php 
				    $selected_grp_lv1 = '';
				    if (isset($_POST['filter_grp_lv1'])){
				        $selected_grp_lv1 = $_POST['filter_grp_lv1'];
				    }
				?>
    			<select name="filter_grp_lv1" id="filter_grp_lv1">
    				<option value="">----------------------------</option>
    				<option <?php if($selected_grp_lv1 == "1"){ echo "selected='selected'";}?> value="1">THIẾT BỊ VỆ SINH (G1)</option>
    				<option <?php if($selected_grp_lv1 == "2"){ echo "selected='selected'";}?> value="2">THIẾT BỊ NHÀ BẾP (G2)</option>
    				<option <?php if($selected_grp_lv1 == "3"){ echo "selected='selected'";}?> value="3" >THIẾT BỊ ĐIỆN (G3)</option>
    			</select>
    			<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' />
				<input type="hidden" name='display' value='list' /> 
    			<input type="submit" name="submit" value="Filter" class="btn btn-primary" /> 
			</form>
			</div>
    	<?php 
        	$sql = "SELECT A.group_id, A.group_type, A.group_name, A.group_level, B.permalink, C.group_name AS group_up_name, A.image_url FROM np_prod_group A ";
        	$sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
        	$sql .= " LEFT OUTER JOIN np_prod_group C ON A.group_level_up = C.group_id ";
        	$sql .= " WHERE B.delete_flag = '0' AND A.group_level = '1' ";
        	
        	if (isset($_POST['submit']) && $_POST['submit'] == 'Filter') {
        	    if (isset($_POST['filter_grp_lv1']) && !empty($_POST['filter_grp_lv1'])) {
        	        $filter_group_lv = '';
        	        $filter_group_lvup = '';
        	        
        	        $filter_grp_lv1 = $conn->real_escape_string($_POST['filter_grp_lv1']);
        	        $sql .= " AND A.group_type = '$filter_grp_lv1'";
        	        $filter_group_lv = '1';
        	        
        	        if (isset($_POST['filter_grp_lv2']) && !empty($_POST['filter_grp_lv2'])) {
        	            $filter_group_lvup = $conn->real_escape_string($_POST['filter_grp_lv2']);
        	            $filter_group_lv = '2';
        	            $sql .= " AND A.group_level_up = '$filter_group_lvup'";
        	        }
        	        $sql .= " AND A.group_level = '$filter_group_lv'";
        	    }
        	}
        	$sql .= " ORDER BY A.group_type,  A.group_id ";
        	
        	$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    $n = 0;
			?>
		
			<div class="panel-body">
				<table class="table">
				<tr>
					<td>Nhóm</td>
					<td>Group Name</td>
					<td>Group Permalink</td>
					<td>Cấp Nhóm</td>
					<td>Nhóm bên trên</td>
					<td>Số Lượng Sản Phẩm</td>
					<td>Ảnh Group</td>
					<td>Add SubGroup</td>
					<td>Sửa</td>
					<td>Xóa</td>
					<td>View</td>
				</tr>
				<?php 
				while ($row = $result->fetch_assoc()) {
				    $n ++;
				?>
				<tr>
					<td><?php
    					if ($row['group_type'] == '1') {
    					   echo 'G1';
    					} else if ($row['group_type'] == '2') {
    					    echo 'G2';
    					} else if ($row['group_type'] == '3') {
    					    echo 'G3';
    					}
					?></td>
					<td><?php
    					if ($row['group_level'] > 1) {
    					   echo "&nbsp;&nbsp;&nbsp;&nbsp;+ ";
    					}
    					echo $row['group_name'];
					   ?>
					</td>
					<td><?=$row['permalink']?></td>
					<td><?=$row['group_level'] + 1?></td>
					<td><?=$row['group_up_name']?></td>
					<td><?=NpPermaLinkDba::countData($conn, "np_product", "group_id = '" . $row['group_id'] ."'"); ?></td>
					<td><?=$row['image_url']?> | <a href="?pcid=imggrd&display=addnew&id=<?=$row['group_id']?>&grdname=<?=$row['group_name']?>&table=np_group_image">Update Ảnh</a></td>
					<td>
						<a href="?pcid=<?=$_REQUEST['pcid']?>&display=addnew&id=<?=$row['group_id']?>&grdlv=<?=$row['group_level']?>&group_type=<?=$row['group_type']?>">add</a>
					</td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=edit&id=<?=$row['group_id']?>">Sửa</a></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=list&action=delete&id=<?=$row['group_id']?>"
						onclick="return confirm('<?=$CONFIRM_DELETE?>');">Xóa</a></td>
					<td><a target="blank" href="<?=Common::$_HOME_PAGE .'/'. $row['permalink']?>">View</a></td>
				</tr>
				
				<?php 
				$sql2 = "SELECT A.group_id, A.group_type, A.group_name, A.group_level, B.permalink, C.group_name AS group_up_name, A.image_url FROM np_prod_group A ";
				$sql2 .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
				$sql2 .= " LEFT OUTER JOIN np_prod_group C ON A.group_level_up = C.group_id ";
				$sql2 .= " WHERE B.delete_flag = '0' AND A.group_level = '2' AND A.group_level_up = '" .$row['group_id']. "'";
				$sql2 .= " ORDER BY A.group_type,  A.group_id ";
				
				$result2 = $conn->query($sql2);
				if ($result2->num_rows > 0) {
				    while ($row2 = $result2->fetch_assoc()) {
				?>
				<tr>
					<td><?php
					if ($row2['group_type'] == '1') {
    					   echo 'G1';
					} else if ($row2['group_type'] == '2') {
    					    echo 'G2';
					} else if ($row2['group_type'] == '3') {
    					    echo 'G3';
    					}
					?></td>
					<td><?php
					if ($row2['group_level'] > 1) {
					   echo "&nbsp;&nbsp;&nbsp;&nbsp;+ ";
					}
					echo $row2['group_name'];
					
					?></td>
					<td><?=$row2['permalink']?></td>
					<td><?=$row2['group_level'] + 1?></td>
					<td><?=$row2['group_up_name']?></td>
					<td><?=NpPermaLinkDba::countData($conn, "np_product", "group_id = '" . $row2['group_id'] ."'"); ?></td>
					<td><?=$row2['image_url']?> | <a href="?pcid=imggrd&display=addnew&id=<?=$row2['group_id']?>&grdname=<?=$row2['group_name']?>&table=np_group_image">Update Ảnh</a></td>
					<td>
					</td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=edit&id=<?=$row2['group_id']?>">Sửa</a></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=list&action=delete&id=<?=$row2['group_id']?>"
						onclick="return confirm('<?=$CONFIRM_DELETE?>');">Xóa</a></td>
					<td><a target="blank" href="<?=Common::$_HOME_PAGE .'/'. $row2['permalink']?>">View</a></td>
				</tr>
				<?php 
				    }
				}
				?>
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

<script>
	CKEDITOR.replace( 'group_description' , {
		height: 200,
    	filebrowserUploadUrl: 'ckUpload.php'
	} );

	CKEDITOR.replace('group_seo' , {
		height: 250,
    	filebrowserUploadUrl: 'ckUpload.php'
	} );
</script>