<?php 
$table_name = 'np_prod_filter';
$fieldCondidtonName = 'prod_filter_id';
$fieldConditionValue = '';
$fieldEditName = 'prod_filter_name';
$fieldEditValue = '';
$permalinkValue = '';
?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?php  echo Common::$_HOME_PAGE .'/npad/' ?>"> <em class="fa fa-home"></em>
		</a></li>
		<li class="active">Quản lý Bộ lọc Thương hiệu</li>
	</ol>
</div>
<!--/.row-->
<div class="row">
	<div class="col-lg-12">
		</br> <a href="?pcid=<?=$_REQUEST['pcid']?>&display=list"><button
				type="button" class="btn btn-sm btn-primary">Danh sách Bộ lọc</button></a>
		<a href="?pcid=<?=$_REQUEST['pcid']?>&display=addnew"><button
				type="button" class="btn btn-sm btn-success">Thêm Bộ lọc</button></a> </br>
		</br>
	</div>
</div>
<!--/.row-->

<?php
if (isset($_REQUEST['display']) && $_REQUEST['display'] == "addnew") {

    $message = '';
    $group_id = '';
    $filter_id_up = '';
    if (isset($_POST['submit'])) {
        $resultOK = 1;
        if (!isset($_POST['prod_filter_name']) || "" == $_POST['prod_filter_name']){
            $resultOK = 0;
        }
        if (!isset($_POST['permalink']) || "" == $_POST['permalink']){
            $resultOK = 0;
        }        
        if ($resultOK == 0){
            $message = $ERROR_FIELD_NULL;
        } else {
            $fieldEditValue = $_POST['prod_filter_name'];
            $permalinkValue = $_POST['permalink'];
            $prod_filter_description = $_POST['prod_filter_description'];
            $prod_filter_seo = $_POST['prod_filter_seo'];
            $group_id = $_POST['group_id'];
            $filter_id_up = $_POST['filter_id_up'];
            
            $resultOK = NpPermaLinkDba::insertData($conn, $permalinkValue, $table_name);
            if ($resultOK == 0) {
                $message = $ERROR_DUPLICATE_SLUG;
            } else {
                $data_id = NpPermaLinkDba::getMaxDataId($conn);
                $sql = "INSERT INTO np_prod_filter (data_id, group_id, prod_filter_name, prod_filter_description, prod_filter_seo, filter_id_up) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $data_id, $group_id, $fieldEditValue, $prod_filter_description, $prod_filter_seo, $filter_id_up);
                $stmt->execute();
                
                $message = $INFO_INSERT_DATA_OK;
            }
        }
    }
    ?>
<script type="text/javascript">
    $(document).ready( function() {
        $("#prod_filter_name").change(function() {
              $("#permalink").val(slug($('#prod_filter_name').val()));
        });
	});
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Thêm Thông Tin Bộ lọc Sản Phẩm <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form action="" method="post">
						
						<div class="form-group">
							<label>Group sản phẩm</label> 
							<select class="form-control" name="group_id" id="group_id">
								<option value="">---- Chọn Group Cấp Trên ----</option>
								<?php 
								for ($i = 1; $i < 4; $i++) {					    
								?>
								<option  <?php if ($group_id == $i) echo "selected = 'selected'"; ?>  value='<?=$i?>'>
									<?php 
									if ($i == 1){
									    echo "G1. Thiết bị vệ sinh";    
									} else if ($i == 2) {
									    echo "G2. Thiết bị nhà bếp";  
									} else if ($i == 3) {
									    echo "G3. Thiết bị điện";  
									}
									?>
								</option>
								<?php 
    								$sql = "SELECT group_id, group_name FROM np_prod_group ";
    								$sql .= " WHERE group_type = '" .$i. "' AND group_level = '1' AND delete_flag = '0'";
    								$result = $conn->query($sql);
    								if ($result->num_rows > 0) {
                        				while ($row = $result->fetch_assoc()) {
                				?>
    									<option <?php if ($group_id == $row['group_id']) echo "selected = 'selected'"; ?> value="<?=$row['group_id']?>">&nbsp;&nbsp;&nbsp;|---(<?=$row['group_name']?>)</option>
    									<?php 
    									$sql1 = "SELECT group_id, group_name FROM np_prod_group ";
    									$sql1 .= " WHERE group_level_up = '" .$row['group_id']. "' AND delete_flag = '0'";
    									$result1 = $conn->query($sql1);
    									if ($result1->num_rows > 0) {
    									    while ($row1 = $result1->fetch_assoc()) {
    									?>
    										<option <?php if ($group_id == $row1['group_id']) echo "selected = 'selected'"; ?> value="<?=$row1['group_id']?>">&nbsp;&nbsp;&nbsp;
    														&nbsp;&nbsp;&nbsp;
    														|---(<?=$row1['group_name']?>)</option>
    									<?php 
            								}
        								}
        								?>
								<?php 
                        				}
    								}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Bộ lọc sản phẩm cha</label> 
							<select class="form-control" name="filter_id_up" id="filter_id_up">
								<option value="">---- Chọn Bộ Lọc Cấp Trên ----</option>
								<?php 
    								$sql1 = "SELECT * FROM np_prod_filter ";
    								$result1 = $conn->query($sql1);
    								if ($result1->num_rows > 0) {
    								    while ($row1 = $result1->fetch_assoc()) {
								?>
									<option <?php if ($filter_id_up == $row1['prod_filter_id']) echo "selected = 'selected'"; ?> value="<?=$row1['prod_filter_id']?>">
													<?=$row1['prod_filter_name']?></option>
								<?php 
        								}
    								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Bộ lọc Name(<span style='color: red'>*</span>)
							</label> _Max: 300 ký tự <input type="text" class="form-control" name="prod_filter_name" id="prod_filter_name"
								value="" />
						</div>
						<div class="form-group">
							<label>Bộ lọc Name Permalink(<span style='color: red'>*</span>)
							</label> _Permalink là duy nhất. Không được có dấu '.' _Max: 300 ký tự <input type="text"
								class="form-control" name="permalink" id="permalink" value="" />
						</div>
						<div class="form-group">
							<label>Mô tả Bộ lọc </label> _Có thể nhập hoặc không _Max: 500 ký tự
							<textarea rows="5" class="form-control" name="prod_filter_description" id="prod_filter_description" ></textarea>
						</div>
						<div class="form-group">
							<label>Seo Bộ lọc </label> _Thông tin Header, Title, Meta ... để SEO _Max: 4000 ký tự
							<textarea rows="10" class="form-control" name="prod_filter_seo" id="prod_filter_seo" ><title>  </title>
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
    $group_id = '';
    $filter_id_up = '';
    if (isset($_REQUEST['submit']))
    {
        $fieldConditionValue = $_POST['id'];
        $fieldEditValue = $_POST['prod_filter_name'];
        $permalinkValue = $_POST['permalink'];
        $prod_filter_description = $_POST['prod_filter_description'];
        $prod_filter_seo = $_POST['prod_filter_seo'];
        $group_id = $_POST['group_id'];
        $filter_id_up = $_POST['filter_id_up'];
        
        NpPermaLinkDba::updPermalink($conn, $permalinkValue, $login_user_id, $table_name, $fieldCondidtonName, $fieldConditionValue, $fieldEditName, $fieldEditValue);
        
        $sql = "UPDATE np_prod_filter SET ";
        $sql .= " group_id = ? ";
        $sql .= " ,prod_filter_name = ? ";
        $sql .= " ,prod_filter_description = ? ";
        $sql .= " ,prod_filter_seo = ? ";
        $sql .= " ,filter_id_up = ? ";
        $sql .= $sql_common_update;
        $sql .= " WHERE prod_filter_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $group_id, $fieldEditValue, $prod_filter_description, $prod_filter_seo, $filter_id_up, $fieldConditionValue);
        $stmt->execute();
        
        $message = $INFO_UPDATE_DATA_OK;
    }
    if (!isset($_REQUEST['id']))
    {
        $message = $ERROR_UPDATE_DATA_FAIL;
    } else {
        $id = $conn->real_escape_string($_REQUEST['id']);
        $sql = "SELECT A.prod_filter_id, A.group_id, A.prod_filter_name, A.prod_filter_description, A.prod_filter_seo, A.filter_id_up, B.permalink FROM np_prod_filter A ";
        $sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
        $sql .= " WHERE A.prod_filter_id = '$id' AND B.delete_flag = '0'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $filter_id_up = $row['filter_id_up'];
            $group_id = $row['group_id'];
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Sửa Bộ Lọc Thương Hiệu Sản Phẩm <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form action="" method="post">
						<div class="form-group">
							<label>Group sản phẩm</label> 
							<select class="form-control" name="group_id" id="group_id">
								<option value="">---- Chọn Group Cấp Trên ----</option>
								<?php 
								for ($i = 1; $i < 4; $i++) {					    
								?>
								<option  <?php if ($group_id == $i) echo "selected = 'selected'"; ?>  value='<?=$i?>'>
									<?php 
									if ($i == 1){
									    echo "G1. Thiết bị vệ sinh";    
									} else if ($i == 2) {
									    echo "G2. Thiết bị nhà bếp";  
									} else if ($i == 3) {
									    echo "G3. Thiết bị điện";  
									}
									?>
								</option>
								<?php 
    								$sql2 = "SELECT group_id, group_name FROM np_prod_group ";
    								$sql2 .= " WHERE group_type = '" .$i. "' AND group_level = '1' AND delete_flag = '0'";
    								$result2 = $conn->query($sql2);
    								if ($result2->num_rows > 0) {
    								    while ($row2 = $result2->fetch_assoc()) {
                				?>
    									<option <?php if ($group_id == $row2['group_id']) echo "selected = 'selected'"; ?> value="<?=$row2['group_id']?>">&nbsp;&nbsp;&nbsp;|---(<?=$row2['group_name']?>)</option>
    									<?php 
    									$sql1 = "SELECT group_id, group_name FROM np_prod_group ";
    									$sql1 .= " WHERE group_level_up = '" .$row2['group_id']. "' AND delete_flag = '0'";
    									$result1 = $conn->query($sql1);
    									if ($result1->num_rows > 0) {
    									    while ($row1 = $result1->fetch_assoc()) {
    									?>
    										<option <?php if ($group_id == $row1['group_id']) echo "selected = 'selected'"; ?> value="<?=$row1['group_id']?>">&nbsp;&nbsp;&nbsp;
    														&nbsp;&nbsp;&nbsp;
    														|---(<?=$row1['group_name']?>)</option>
    									<?php 
            								}
        								}
        								?>
								<?php 
                        				}
    								}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Bộ lọc sản phẩm cha</label> 
							<select class="form-control" name="filter_id_up" id="filter_id_up">
								<option value="">---- Chọn Bộ Lọc Cấp Trên ----</option>
								<?php 
    								$sql1 = "SELECT * FROM np_prod_filter ";
    								$result1 = $conn->query($sql1);
    								if ($result1->num_rows > 0) {
    								    while ($row1 = $result1->fetch_assoc()) {
								?>
									<option <?php if ($filter_id_up == $row1['prod_filter_id']) echo "selected = 'selected'"; ?> value="<?=$row1['prod_filter_id']?>">
													<?=$row1['prod_filter_name']?></option>
								<?php 
        								}
    								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Bộ lọc Name(<span style='color: red'>*</span>)
							</label> _Max: 300 ký tự <input type="text" class="form-control" name="prod_filter_name" id="prod_filter_name"
								value="<?=$row["prod_filter_name"]?>" />
						</div>
						<div class="form-group">
							<label>Bộ lọc Name Permalink(<span style='color: red'>*</span>)
							</label>  _Permalink là duy nhất. Không được có dấu '.' _Max: 300 ký tự 
						<input type="text"
								class="form-control" name="permalink" id="permalink"
								value="<?=$row["permalink"]?>" />
						</div>
						<div class="form-group">
							<label>Mô tả Bộ lọc </label> _Có thể nhập hoặc không _Max: 500 ký tự
							<textarea rows="5" class="form-control" name="prod_filter_description" id="prod_filter_description" ><?=$row["prod_filter_description"]?></textarea>
						</div>
						<div class="form-group">
							<label>Seo Bộ lọc </label> _Thông tin Header, Title, Meta ... để SEO _Max: 4000 ký tự
							<textarea rows="10" class="form-control" name="prod_filter_seo" id="prod_filter_seo" ><?=$row["prod_filter_seo"]?></textarea>
						</div>
						<div class="form-group">
							<label>(<span style='color: red'>*</span>)
							</label> Trường cần phải nhập thông tin
						</div>
						<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' />
						<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
						<input type="hidden" name='id' value='<?=$_REQUEST['id']?>' /> 
						<input type="submit" name="submit" value="Sửa Dữ Liệu" class="btn btn-primary" /> 
						<input type="reset" class="btn btn-default" value="Reset" />
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
    $filter_filter_group_id = '';
    $filter_group_id = '';
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' && isset($_REQUEST['id']))
    {
        $id = $_REQUEST['id'];
        NpPermaLinkDba::delPermalink($conn, $table_name, $fieldCondidtonName, $id);
        
        $message = $INFO_DELETE_DATA_OK;
    }
    $sql = "SELECT A.prod_filter_id, A.prod_filter_name, B.permalink, A.image_title, A.image_url FROM np_prod_filter A ";
    $sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
    $sql .= " WHERE B.delete_flag = '0' ";
    
    if (isset($_REQUEST['filter_group_id']) && !empty($_REQUEST['filter_group_id'])) {
        $filter_group_id = $_REQUEST['filter_group_id'];
        $sql .= " AND A.group_id = '$filter_group_id' ";
    }
    
    if (isset($_REQUEST['filter_filter_group_id']) && !empty($_REQUEST['filter_filter_group_id'])) {
        $filter_filter_group_id = $_REQUEST['filter_filter_group_id'];
        $sql .= " AND A.filter_id_up = '$filter_filter_group_id' ";
    }
    
    
    $sql .= " ORDER BY A.prod_filter_id DESC ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $n = 0;
    ?>
<form action="" method="post" name="list_filterImg_form" id="list_filterImg_form">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách Bộ lọc Sản Phẩm <?=$message?></div>
			
			<div class="panel-body">
				<div class="col-md-6">
    				<div class="form-group">
    					<select class="form-control" name="filter_filter_group_id" id="filter_filter_group_id"  onchange="filter_group();">
    						<option value="">---- Lọc sản phẩm theo Bộ lọc Thương Hiệu Cha----</option>
    						<?php 
    							$sql11 = "SELECT * FROM np_prod_filter ";
    							$result11 = $conn->query($sql11);
    							if ($result11->num_rows > 0) {
    							    while ($row11 = $result11->fetch_assoc()) {
            				?>
            					<option value="<?=$row11['prod_filter_id']?>" <?php if ($filter_filter_group_id == $row11['prod_filter_id']) echo "selected = 'selected'"; ?>><?=$row11['prod_filter_name']?></option>
            				<?php 
    							    }
    							}
            				?>
    					</select>
    				</div>
    			</div>
    			
				<div class="col-md-6">
    				<div class="form-group">
    					<select class="form-control" name="filter_group_id" id="filter_group_id" onchange="filter_group();">
    						<option value="">---- Lọc sản phẩm theo nhóm ----</option>
    						<?php 
    						for ($i = 1; $i < 4; $i++) {					    
    						?>
    						<option value="">
    							<?php 
    							if ($i == 1){
    							    echo "A. Thiết bị vệ sinh";    
    							} else if ($i == 2) {
    							    echo "B. Thiết bị nhà bếp";  
    							} else if ($i == 3) {
    							    echo "C. Thiết bị điện";  
    							}
    							?>
    						 </option>
    						<?php 
    							$sql0 = "SELECT group_id, group_name FROM np_prod_group ";
    							$sql0 .= " WHERE group_type = '" .$i. "' AND group_level = '1' AND delete_flag = '0'";
    							$result0 = $conn->query($sql0);
    							if ($result0->num_rows > 0) {
    							    while ($row0 = $result0->fetch_assoc()) {
            				?>
    								<option <?php if($filter_group_id == $row0['group_id']) echo "selected = 'selected'"; ?> value="<?=$row0['group_id']?>">&nbsp;&nbsp;&nbsp;|---(<?=$row0['group_name']?>)</option>
    								<?php 
    								$sql1 = "SELECT group_id, group_name FROM np_prod_group ";
    								$sql1 .= " WHERE group_level_up = '" .$row0['group_id']. "' AND delete_flag = '0'";
    								$result1 = $conn->query($sql1);
    								if ($result1->num_rows > 0) {
    								    while ($row1 = $result1->fetch_assoc()) {
    								?>
    									<option <?php if($filter_group_id == $row1['group_id']) echo "selected = 'selected'"; ?> value="<?=$row1['group_id']?>">&nbsp;&nbsp;&nbsp;
    													&nbsp;&nbsp;&nbsp;
    													|---(<?=$row1['group_name']?>)</option>
    									<?php 
    									$sql2 = "SELECT group_id, group_name FROM np_prod_group ";
    									$sql2 .= " WHERE group_level_up = '" .$row1['group_id']. "' AND delete_flag = '0'";
    									$result2 = $conn->query($sql2);
    									if ($result2->num_rows > 0) {
    									    while ($row2 = $result2->fetch_assoc()) {
    									?>
    										<option <?php if($filter_group_id == $row2['group_id']) echo "selected = 'selected'"; ?> value="<?=$row2['group_id']?>">
    														&nbsp;&nbsp;&nbsp;
    														&nbsp;&nbsp;&nbsp;
    														&nbsp;&nbsp;&nbsp;
    														|---<?=$row2['group_name']?></option>
    									<?php 
            								}
        								}
        								?>
    								<?php 
        								}
    								}
    								?>
    						<?php 
                    				}
    							}
    						}
    						?>
    					</select>
    				</div>
    			</div>
    			<div class="col-md-6">
    				<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' /> 
					<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
    			</div>
    			<script type="text/javascript" lang="javascript">
    				function filter_group() {
    					document.getElementById("list_filterImg_form").action = "";
						document.getElementById("list_filterImg_form").submit();
    				}
    			</script>
			</div>
			
			
			<div class="panel-body">
				<table class="table">
				<tr>
					<td>No</td>
					<td>Bộ lọc Name</td>
					<td>Bộ lọc Permalink</td>
					<td>Ảnh Bộ lọc</td>
					<td>Sửa</td>
					<td>Xóa</td>
					<td>View</td>
				</tr>
				<?php 
				while ($row = $result->fetch_assoc()) {
				    $n ++;
				?>
				<tr>
					<td><?=$n?></td>
					<td><?=$row["prod_filter_name"]?></td>
					<td><?=$row["permalink"]?></td>
					<td> <?=$row["image_url"]?> | <a href="?pcid=imgfilterpd&display=addnew&id=<?=$row["prod_filter_id"]?>&brname=<?=$row["prod_filter_name"]?>&table=np_prod_filter">Update Ảnh</a></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=edit&id=<?=$row["prod_filter_id"]?>">Sửa</a></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=list&action=delete&id=<?=$row["prod_filter_id"]?>"
							onclick="return confirm('<?=$CONFIRM_DELETE?>');">Xóa</a></td>
					<td><a target="blank" href="<?=Common::$_HOME_PAGE .'/'. $row["permalink"]?>">View</a></td>
				</tr>
				<?php 
				}
				?>
				</table>
			</div>
		</div>
	</div>
</div>
</form>
	<?php 
    }
	?>
<?php 
}
?>