<?php 
$table_name = 'np_page_group';
$fieldCondidtonName = 'page_group_id';
$fieldConditionValue = '';
$fieldEditName = 'page_group_name';
$fieldEditValue = '';
$permalinkValue = '';
?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?php  echo Common::$_HOME_PAGE .'/npad/' ?>"> <em class="fa fa-home"></em>
		</a></li>
		<li class="active">Quản lý Group Page</li>
	</ol>
</div>
<!--/.row-->

<div class="row">
	<div class="col-lg-12">
		</br> <a href="?pcid=<?=$_REQUEST['pcid']?>&display=list"><button
				type="button" class="btn btn-sm btn-primary">Danh sách Group</button></a>
		<a href="?pcid=<?=$_REQUEST['pcid']?>&display=addnew"><button
				type="button" class="btn btn-sm btn-success">Thêm Group</button></a> </br>
		</br>
	</div>
</div>
<!--/.row-->

<?php
if (isset($_REQUEST['display']) && $_REQUEST['display'] == "addnew") {

    $message = "";

    if (isset($_POST['submit'])) {
        $resultOK = 1;
        if (!isset($_POST['page_group_name']) || "" == $_POST['page_group_name']){
            $resultOK = 0;
        }
        if (!isset($_POST['permalink']) || "" == $_POST['permalink']){
            $resultOK = 0;
        }        
        if ($resultOK == 0){
            $message = $ERROR_FIELD_NULL;
        } else {
            $fieldEditValue = $_POST['page_group_name'];
            $permalinkValue = $_POST['permalink'];
            
            $resultOK = NpPermaLinkDba::insertData($conn, $permalinkValue, $table_name);
            if ($resultOK == 0) {
                $message = $ERROR_DUPLICATE_SLUG;
            } else {
                $data_id = NpPermaLinkDba::getMaxDataId($conn);
                $sql = "INSERT INTO np_page_group (data_id, page_group_name) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $data_id, $fieldEditValue);
                $stmt->execute();
                
                $message = $INFO_INSERT_DATA_OK;
            }
        }
    }
    ?>
<script type="text/javascript">
    $(document).ready( function() {
        $("#page_group_name").change(function() {
              $("#permalink").val(slug($('#page_group_name').val()));
        });
	});
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Thêm Thông Tin Group Page <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form action="" method="post">
						<div class="form-group">
							<label>Group Name(<span style='color: red'>*</span>)
							</label> _Max: 300 ký tự <input type="text" class="form-control" name="page_group_name" id="page_group_name"
								value="" />
						</div>
						<div class="form-group">
							<label>Group Name Permalink(<span style='color: red'>*</span>)
							</label> _ Permalink là duy nhất. Không bao gồm ký tự '.' _Max: 300 ký tự <input type="text" id="permalink"
								class="form-control" name="permalink" value="" />
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
    if (isset($_REQUEST['submit']))
    {
        $fieldConditionValue = $_POST['id'];
        $fieldEditValue = $_POST['page_group_name'];
        $permalinkValue = $_POST['permalink'];
        NpPermaLinkDba::updPermalink($conn, $permalinkValue, $login_user_id, $table_name, $fieldCondidtonName, $fieldConditionValue, $fieldEditName, $fieldEditValue);
        
        $sql = "UPDATE np_page_group SET ";
        $sql .= " page_group_name = ? ";
        $sql .= $sql_common_update;
        $sql .= " WHERE page_group_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $fieldEditValue, $fieldConditionValue);
        $stmt->execute();
        
        $message = $INFO_UPDATE_DATA_OK;
    }
    if (!isset($_REQUEST['id']))
    {
        $message = $ERROR_UPDATE_DATA_FAIL;
    } else {
        $id = $conn->real_escape_string($_REQUEST['id']);
        $sql = "SELECT A.page_group_id, A.page_group_name, B.permalink FROM np_page_group A INNER JOIN np_permalink B ON A.data_id = B.data_id WHERE A.page_group_id = '$id' AND B.delete_flag = '0'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Sửa Group Page <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form action="" method="post">
						<div class="form-group">
							<label>Group Name(<span style='color: red'>*</span>)
							</label> _Max: 300 ký tự <input type="text" class="form-control" name="page_group_name" id="page_group_name"
								value="<?=$row["page_group_name"]?>" />
						</div>
						<div class="form-group">
							<label>Group Name Permalink(<span style='color: red'>*</span>)
							</label> _ Permalink là duy nhất _ Permalink là duy nhất. Không bao gồm ký tự '.' _Max: 300 ký tự
						<input type="text"
								class="form-control" name="permalink" id="permalink"
								value="<?=$row["permalink"]?>" />
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
    $sql = "SELECT A.page_group_id, A.page_group_name, B.permalink FROM np_page_group A ";
    $sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id WHERE B.delete_flag = '0'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $n = 0;
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách Group Page <?=$message?></div>
			<div class="panel-body">
				<table class="table">
				<tr>
					<td>No</td>
					<td>Group Name</td>
					<td>Group Permalink</td>
					<td>Sửa</td>
					<td>Xóa</td>
				</tr>
				<?php 
				while ($row = $result->fetch_assoc()) {
				    $n ++;
				?>
				<tr>
					<td><?=$n?></td>
					<td><?=$row["page_group_name"]?></td>
					<td><?=$row["permalink"]?></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=edit&id=<?=$row["page_group_id"]?>">Sửa</a></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=list&action=delete&id=<?=$row["page_group_id"]?>"
						onclick="return confirm('<?=$CONFIRM_DELETE?>');">Xóa</a></td>
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