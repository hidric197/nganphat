<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?php  echo Common::$_HOME_PAGE .'/npad/' ?>"> <em class="fa fa-home"></em>
		</a></li>
		<li class="active">Quản lý User</li>
	</ol>
</div>
<!--/.row-->
<script type="text/javascript">
    $(document).ready( function() {
        $("#user_name").change(function() {
              $("#permalink").val(slug($('#user_name').val()));
        });
	});
</script>


<div class="row">
	<div class="col-lg-12">
		</br> <a href="?pcid=<?=$_REQUEST['pcid']?>&display=list"><button
				type="button" class="btn btn-sm btn-primary">Danh sách User</button></a>
		<?php 
		if ($_SESSION[Common::$SESSION_ADMIN_USER_INFO][5] != '2') {
		?>
		<a href="?pcid=<?=$_REQUEST['pcid']?>&display=addnew"><button
				type="button" class="btn btn-sm btn-success">Thêm Quản Lý Website</button></a> 
		<?php 
		}
		?>
		<a href="?pcid=<?=$_REQUEST['pcid']?>&display=editinfo"><button
				type="button" class="btn btn-sm btn-primary">Sửa thông tin cá nhân</button></a>
		</br>
		</br>
	</div>
</div>
<!--/.row-->

<?php
if (isset($_REQUEST['display']) && $_REQUEST['display'] == "addnew") {

    $message = "";
    
    if (isset($_POST['submit'])) {
        $resultOK = 1;
        if (!isset($_POST['user_phone']) || "" == $_POST['user_phone']){
            $resultOK = 0;
        }
        if (!isset($_POST['user_name']) || "" == $_POST['user_name']){
            $resultOK = 0;
        }       
        if (!isset($_POST['user_full_name']) || "" == $_POST['user_full_name']){
            $resultOK = 0;
        } 
        if (!isset($_POST['user_email']) || "" == $_POST['user_email']){
            $resultOK = 0;
        } 
        if (!isset($_POST['user_password']) || "" == $_POST['user_password']){
            $resultOK = 0;
        } 
        if (!isset($_POST['user_password_confirm']) || empty($_POST['user_password_confirm'])) {
            $resultOK = 0;
        } else {
            $rg_password = $_POST['user_password'];
            $rg_password_cf = $_POST['user_password_confirm'];
            if ($rg_password != $rg_password_cf) {
                $resultOK = 0;
            }
        }
        if ($resultOK == 0){
            $message = $ERROR_FIELD_NULL;
        } else {
            $user_phone = $_POST['user_phone'];
            $user_name = $_POST['user_name'];
            $user_full_name = $_POST['user_full_name'];
            $user_email = $_POST['user_email'];
            $user_password = md5($_POST['user_password']);
            $user_type = $_POST['user_type'];
            
            $phone = $conn->real_escape_string($user_phone);
            $user = $conn->real_escape_string($user_name);
            $sql = "SELECT user_phone FROM np_user WHERE user_phone = '$phone' OR user_name = '$user'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $message = "(<span style='color: red'>Số điện thoại này hoặc tên đăng nhập này đã được đăng ký</span>)";
                
            } else {
                $sql = "INSERT INTO np_user (user_phone, user_name, user_full_name, user_email, user_password, user_type) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $user_phone, $user_name, $user_full_name, $user_email, $user_password, $user_type);
                $stmt->execute();
                
                $message = $INFO_INSERT_DATA_OK;
            }
        }
    }
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Thêm Thông Tin User <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form action="" method="post">
						<div class="form-group">
							<label>Số điện thoại(<span style='color: red'>*</span>)
							</label> _Max: 50 ký tự <input type="text" class="form-control" name="user_phone" id="user_phone"
								value="" />
						</div>
						<div class="form-group">
							<label>Tên login (<span style='color: red'>*</span>)
							</label> _Max: 50 ký tự <input type="text"
								class="form-control" name="user_name" id="user_name" value="" />
						</div>
						<div class="form-group">
							<label>Tên đầy đủ (<span style='color: red'>*</span>)
							</label> _Max: 50 ký tự <input type="text"
								class="form-control" name="user_full_name" id="user_full_name" value="" />
						</div>
						<div class="form-group">
							<label>Email (<span style='color: red'>*</span>)
							</label> _Max: 50 ký tự <input type="text"
								class="form-control" name="user_email" id="user_email" value="" />
						</div>
						<div class="form-group">
							<label>Password (<span style='color: red'>*</span>)
							</label> _Max: 20 ký tự <input type="password"
								class="form-control" name="user_password" id="user_password" value="" />
						</div>
						<div class="form-group">
							<label>Password confirm (<span style='color: red'>*</span>)
							</label> _Max: 20 ký tự _Cần phải nhập trùng với trường Password <input type="password"
								class="form-control" name="user_password_confirm" id="user_password_confirm" value="" />
						</div>
						
						<div class="form-group">
							<label>Loại user :</label>
							<input type="radio" name="user_type" id="user_type1" value="1">&nbsp;Admin NganPhat
							&nbsp;&nbsp;&nbsp;<input type="radio" name="user_type" id="user_type2" value="2" checked="checked">&nbsp;Nhân viên NganPhat
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
} else if (isset($_REQUEST['display']) && $_REQUEST['display'] == "editinfo") {
    
    $message = "";
    if (isset($_POST['submit'])) {
        $resultOK = 1;
        if (!isset($_POST['user_full_name']) || empty($_POST['user_full_name'])){
            $resultOK = 0;
        }
        if (!isset($_POST['user_email']) || empty($_POST['user_email'])){
            $resultOK = 0;
        }
        if (isset($_POST['user_password']) && !empty($_POST['user_password'])) {
            $rg_password = $_POST['user_password'];
            $rg_password_cf = $_POST['user_password_confirm'];
            if ($rg_password != $rg_password_cf) {
                $resultOK = 0;
            }
        }
        if ($resultOK == 0){
            $message = $ERROR_FIELD_NULL;
        } else {
            $user_full_name = $conn->real_escape_string($_POST['user_full_name']);
            $user_email = $conn->real_escape_string($_POST['user_email']);
            $user_password = $conn->real_escape_string(md5($_POST['user_password']));
            $user_info = $conn->real_escape_string($_POST['user_info']) ;
            
            
//             $sql = "SELECT user_phone FROM np_user WHERE user_phone = '$phone' OR user_name = '$user'";
//             $result = $conn->query($sql);
//             if ($result->num_rows > 0) {
//                 $message = "(<span style='color: red'>Số điện thoại này hoặc tên đăng nhập này đã được đăng ký</span>)";
                
//             } else {
            $sql = "UPDATE np_user SET ";
            $sql .= " user_full_name = ?";
            $sql .= " , user_email = ?";
            if (isset($_POST['user_password']) && !empty($_POST['user_password'])) {
                $sql .= " , user_password = ?";
            }
            $sql .= " , user_info = ?";
            $sql .= $sql_common_update;
            
            $sql .= " WHERE user_id = ?";
            
            $stmt = $conn->prepare($sql);
            if (isset($_POST['user_password']) && !empty($_POST['user_password'])) {
                $stmt->bind_param("sssss", $user_full_name, $user_email, $user_password, $user_info, $login_user_id);
            } else {
                $stmt->bind_param("ssss", $user_full_name, $user_email, $user_info, $login_user_id);
            }
            $stmt->execute();
                
            $message = $INFO_UPDATE_DATA_OK;
//             }
        }
    }
    $sql = "SELECT * FROM np_user WHERE user_id = '$login_user_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {    
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Sửa thông tin cá nhân <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form action="" method="post">
						<div class="form-group">
							<label>Số điện thoại (Không thể sửa đổi)
							</label> _Max: 50 ký tự <input type="text" class="form-control" name="user_phone" id="user_phone"
								value="<?=$row['user_phone']?>" disabled="disabled"/>
						</div>
						<div class="form-group">
							<label>Tên login (Không thể sửa đổi)
							</label> _Max: 50 ký tự <input type="text"
								class="form-control" name="user_name" id="user_name" value="<?=$row['user_name']?>" disabled="disabled" />
						</div>
						<div class="form-group">
							<label>Tên đầy đủ (<span style='color: red'>*</span>)
							</label> _Max: 50 ký tự <input type="text"
								class="form-control" name="user_full_name" id="user_full_name" value="<?=$row['user_full_name']?>" />
						</div>
						<div class="form-group">
							<label>Email (<span style='color: red'>*</span>)
							</label> _Max: 50 ký tự <input type="text"
								class="form-control" name="user_email" id="user_email" value="<?=$row['user_email']?>" />
						</div>
						<div class="form-group">
							<label>Password (<span style='color: red'>*</span>)
							</label> _Max: 20 ký tự <input type="password"
								class="form-control" name="user_password" id="user_password"/>
						</div>
						<div class="form-group">
							<label>Password confirm (<span style='color: red'>*</span>)
							</label> _Max: 20 ký tự _Cần phải nhập trùng với trường Password <input type="password"
								class="form-control" name="user_password_confirm" id="user_password_confirm"/>
						</div>
						
						<div class="form-group">
							<label>Mô tả bản thân (Hiển thị dưới bài viết)
							</label> _Max: 1000 ký tự 
							<textarea class="form-control" name="user_info" id="user_info" rows="10"><?=$row['user_info']?></textarea>
						</div>
						
						<div class="form-group">
							<label>(<span style='color: red'>*</span>)
							</label> Trường cần phải nhập thông tin
						</div>
						<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' />
						<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
						<input type="submit" name="submit" value="Sửa Thông Tin Cá Nhân"
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

?>
<?php
} else if (isset($_REQUEST['display']) && $_REQUEST['display'] == "edit") {
    $message = "";
    if (isset($_REQUEST['deactive']))
    {
        $id = $_POST['id'];
        $sql = "UPDATE np_user SET ";
        $sql .= " delete_flag = '1' ";
        $sql .= $sql_common_update;
        $sql .= " WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        
        $message = $INFO_UPDATE_DATA_OK;
    } else if (isset($_REQUEST['active'])) {
        $id = $_POST['id'];
        $sql = "UPDATE np_user SET ";
        $sql .= " delete_flag = '0' ";
        $sql .= $sql_common_update;
        $sql .= " WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        
        $message = $INFO_UPDATE_DATA_OK;
    }
    
    if (!isset($_REQUEST['id']))
    {
        $message = $ERROR_UPDATE_DATA_FAIL;
    } else {
        $id = $conn->real_escape_string($_REQUEST['id']);
        $sql = "SELECT A.user_phone, A.user_name, A.user_full_name, A.user_email, A.user_password, A.user_type, A.delete_flag FROM np_user A ";
        $sql .= " WHERE A.user_id = '$id' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Sửa User <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form action="" method="post">
						<div class="form-group">
							<label>Số điện thoại : </label> <?=$row['user_phone']?>
						</div>
						<div class="form-group">
							<label>Tên login : </label> <?=$row['user_name']?>
						</div>
						<div class="form-group">
							<label>Tên đầy đủ : </label>  <?=$row['user_full_name']?>
						</div>
						<div class="form-group">
							<label>Email : </label> <?=$row['user_email']?>
						</div>
						<div class="form-group">
							<label>Loại user :</label> 
							<?php 
            					if ($row["user_type"] == '0'){
            					    echo 'Khách Hàng';
            					} else if ($row["user_type"] == '1'){
            					    echo "<span style='color: red'>Admin Nganphat</span>";
            					} else if ($row["user_type"] == '2'){
            					    echo "<span style='color: red'>Nhân viên Ngan phát</span>";
            					}
        					?>
						</div>
						<div class="form-group">
							<label>Trạng Thái : </label>
							<?php 
            					if ($row["delete_flag"] == '0'){
            					    echo 'Hoạt Động';
            					} else if ($row["delete_flag"] == '1'){
            					    echo "<span style='color: red'>Không hoạt động</span>";
            					}
        					?>
						</div>
						<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' />
						<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
						<input type="hidden" name='id' value='<?=$_REQUEST['id']?>' /> 
						<?php 
        					if ($row["delete_flag"] == '0'){
        				?>
						<input type="submit" name="deactive" value="Update trạng thái không hoạt động" class="btn btn-primary" /> 
						<?php 
        					} else if ($row["delete_flag"] == '1'){
						?>
						<input type="submit" name="active" value="Update trạng thái hoạt động" class="btn btn-primary" /> 
						<?php 
        					}
						?>
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

        $user_replace = $_SESSION[Common::$SESSION_ADMIN_USER_INFO][0];
        
        // update thong tin o bai viet
        $sql = "UPDATE np_page SET insert_user = '$user_replace' WHERE insert_user  = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // update thong tin o san phan
        $sql = "UPDATE np_product SET insert_user = '$user_replace' WHERE insert_user  = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $sql = "DELETE FROM np_user WHERE user_id  = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $message = $INFO_DELETE_DATA_OK;
    }
    
    $sql = "SELECT A.user_id, A.user_phone, A.user_name, A.user_full_name, A.user_email, A.user_type, A.delete_flag FROM np_user A ";
    $sql .= " WHERE A.user_type <> '9'";
    $sql .= " ORDER BY user_type DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $n = 0;
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách User <?=$message?></div>
			<div class="panel-body">
				<table class="table">
				<tr>
					<td>No</td>
					<td>Số điện thoại</td>
					<td>Tên đăng nhập</td>
					<td>Tên đầy đủ</td>
					<td>Email</td>
					<td>Loại User</td>
					<td>Trạng Thái</td>
					<td>View & Edit</td>
					<td>Xóa User</td>
				</tr>
				<?php 
				while ($row = $result->fetch_assoc()) {
				    $n ++;
				?>
				<tr>
					<td><?=$n?></td>
					<td><?=$row["user_phone"]?></td>
					<td><?=$row["user_name"]?></td>
					<td><?=$row["user_full_name"]?></td>
					<td><?=$row["user_email"]?></td>
					<td><?php 
    					if ($row["user_type"] == '0'){
    					    echo 'Khách Hàng';
    					} else if ($row["user_type"] == '1'){
    					    echo "<span style='color: red'>Admin Nganphat</span>";
    					} else if ($row["user_type"] == '2'){
    					    echo "<span style='color: red'>Nhân viên Ngan phát</span>";
    					}
					?></td>
					<td><?php 
    					if ($row["delete_flag"] == '0'){
    					    echo 'Hoạt Động';
    					} else if ($row["delete_flag"] == '1'){
    					    echo "<span style='color: red'>Không hoạt động</span>";
    					}
					?></td>
					<td>
						<?php 
						if ($_SESSION[Common::$SESSION_ADMIN_USER_INFO][5] != '2' && $_SESSION[Common::$SESSION_ADMIN_USER_INFO][0] != $row["user_id"]) {
                		?>
						<a href="?pcid=<?=$_REQUEST['pcid']?>&display=edit&id=<?=$row["user_id"]?>">Sửa Trạng thái user</a>
						<?php 
                		  }
						?>
					</td>
					<td>
						<?php 
						if ($_SESSION[Common::$SESSION_ADMIN_USER_INFO][5] != '2' && $_SESSION[Common::$SESSION_ADMIN_USER_INFO][0] != $row["user_id"]) {
                		?>
						<a href="?pcid=<?=$_REQUEST['pcid']?>&display=list&action=delete&id=<?=$row["user_id"]?>"
							onclick="return confirm('<?=$CONFIRM_DELETE?>');">Xóa</a>
						<?php 
                		  }
						?>
					</td>
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