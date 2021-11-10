<?php 
$table_name = 'np_prod_tag';
$fieldCondidtonName = 'tag_id';
$fieldConditionValue = '';
$fieldEditName = 'tag_name';
$fieldEditValue = '';
$permalinkValue = '';
?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?php  echo Common::$_HOME_PAGE .'/npad/' ?>"> <em class="fa fa-home"></em>
		</a></li>
		<li class="active">Quản lý Tag Sản Phẩm</li>
	</ol>
</div>
<div class="row">
	<div class="col-lg-12">
		</br> <a href="?pcid=<?=$_REQUEST['pcid']?>&display=list"><button
				type="button" class="btn btn-sm btn-primary">Danh sách Tag</button></a>
		
	<!-- 	<a href="?pcid=<?=$_REQUEST['pcid']?>&display=addnew">
			<button type="button" class="btn btn-sm btn-success">Thêm Tag</button></a> 
	 -->
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
        if (!isset($_POST['tag_name']) || "" == $_POST['tag_name']){
            $resultOK = 0;
        }
        if (!isset($_POST['permalink']) || "" == $_POST['permalink']){
            $resultOK = 0;
        }        
        if ($resultOK == 0){
            $message = $ERROR_FIELD_NULL;
        } else {
            $tag_name = $_POST['tag_name'];
            $permalinkValue = $_POST['permalink'];
            $tag_description = $_POST['tag_description'];
            $tag_seo = $_POST['tag_seo'];
            
            $resultOK = NpPermaLinkDba::insertData($conn, $permalinkValue, $table_name);
            if ($resultOK == 0) {
                $message = $ERROR_DUPLICATE_SLUG;
            } else {
                $data_id = NpPermaLinkDba::getMaxDataId($conn);
                $sql = "INSERT INTO np_prod_tag (data_id, tag_name, tag_description, tag_seo) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $data_id, $tag_name, $tag_description, $tag_seo);
                $stmt->execute();
                
                $message = $INFO_INSERT_DATA_OK;
            }
        }
    }
    ?>
<!--/.row-->
<script type="text/javascript">
    $(document).ready( function() {
        $("#tag_name").change(function() {
              $("#permalink").val(slug($('#tag_name').val()));
        });
	});
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Thêm Thông Tin Tag Sản Phẩm <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form action="" method="post">
						<div class="form-group">
							<label>Tag Name(<span style='color: red'>*</span>) 
							</label> _Max: 300 ký tự <input type="text" class="form-control" name="tag_name" id="tag_name"
								value="" />
						</div>
						<div class="form-group">
							<label>Tag Name Permalink(<span style='color: red'>*</span>) 
							</label> _Permalink là duy nhất. Không được có dấu '.' _Max: 300 ký tự <input type="text"
								class="form-control" name="permalink" id="permalink" value="" />
						</div>
						<div class="form-group">
							<label>Mô tả tag </label> _Có thể nhập hoặc không _Max: 500 ký tự
							<textarea rows="5" class="form-control" name="tag_description" id="tag_description" ></textarea>
						</div>
						<div class="form-group">
							<label>Seo tag </label> _Thông tin Header, Title, Meta ... để SEO _Max: 4000 ký tự
							<textarea rows="10" class="form-control" name="tag_seo" id="tag_seo" ></textarea>
						</div>
						<div class="form-group">
							<label>(<span style='color: red'>*</span>)
							</label> Trường cần phải nhập thông tin
						</div>
						<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' />
						<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
						<input type="submit" name="submit" value="Thêm Thông Tin"
							class="btn btn-primary" /> 
						<input type="reset" class="btn btn-default" value="Reset" />
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
        $tag_id = $_POST['id'];
        $tag_name = $_POST['tag_name'];
        $permalinkValue = $_POST['permalink'];
        $tag_description = $_POST['tag_description'];
        $tag_seo = $_POST['tag_seo'];
        
        NpPermaLinkDba::updPermalink($conn, $permalinkValue, $login_user_id, $table_name, $fieldCondidtonName, $tag_id, $fieldEditName, $table_name);
        
        $sql = "UPDATE np_prod_tag SET ";
        $sql .= " tag_name = ? ";
        $sql .= " ,tag_description = ? ";
        $sql .= " ,tag_seo = ? ";
        $sql .= $sql_common_update;
        $sql .= " WHERE tag_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $tag_name, $tag_description, $tag_seo, $tag_id);
        $stmt->execute();
        
        $message = $INFO_UPDATE_DATA_OK;
    }
    if (!isset($_REQUEST['id']))
    {
        $message = $ERROR_UPDATE_DATA_FAIL;
    } else {
        $id = $conn->real_escape_string($_REQUEST['id']);
        $sql = "SELECT A.tag_id, A.tag_name, A.tag_description, A.tag_seo, B.permalink ";
        $sql .= " FROM np_prod_tag A INNER JOIN np_permalink B ON A.data_id = B.data_id ";
        $sql .= " WHERE A.tag_id = '$id' AND B.delete_flag = '0'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Sửa Tag Sản Phẩm <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form action="" method="post">
						<div class="form-group">
							<label>Tag Name(<span style='color: red'>*</span>) 
							</label> _Max: 300 ký tự <input type="text" class="form-control" name="tag_name" id="tag_name"
								value="<?=$row["tag_name"]?>" />
						</div>
						<div class="form-group">
							<label>Tag Name Permalink(<span style='color: red'>*</span>) 
							</label> _Permalink là duy nhất. Không được có dấu '.' _Max: 300 ký tự
							<input type="text"
								class="form-control" name="permalink" id="permalink"
								value="<?=$row["permalink"]?>" />
						</div>
						<div class="form-group">
							<label>Mô tả tag </label> _Có thể nhập hoặc không _Max: 500 ký tự
							<textarea rows="5" class="form-control" name="tag_description" id="tag_description" ><?=$row["tag_description"]?></textarea>
						</div>
						<div class="form-group">
							<label>Seo tag </label> _Thông tin Header, Title, Meta ... để SEO _Max: 4000 ký tự
							
							<?php 
							if (empty($row["tag_seo"])) {
							?>
							
							<textarea rows="10" class="form-control" name="tag_seo" id="tag_seo" ><title>  </title>
<meta name="description" content="  "/>
<meta name=robots content=INDEX,FOLLOW,ALL />
							</textarea>
							
							<?php 
							} else {
							?>
							<textarea rows="10" class="form-control" name="tag_seo" id="tag_seo" ><?=$row["tag_seo"]?></textarea>
							<?php 
							
							}
							?>
							
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
        
        // Delete all tag list for this product
        $delId = $conn->real_escape_string($id);
        $sql = "DELETE FROM tag_product WHERE tag_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delId);
        $stmt->execute();
        
        $message = $INFO_DELETE_DATA_OK;
    }
    $sql = "SELECT A.tag_id, A.tag_name, B.permalink FROM np_prod_tag A INNER JOIN np_permalink B ON A.data_id = B.data_id ";
    $sql .= " WHERE B.delete_flag = '0' ";
    $sql .= " ORDER BY A.tag_id DESC ";
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $n = 0;
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách Tag Sản Phẩm <?=$message?></div>
			<div class="panel-body">
				<table class="table">
				<tr>
					<td>No</td>
					<td>Tag Name</td>
					<td>Tag Permalink</td>
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
					<td><?=$row["tag_name"]?></td>
					<td><?=$row["permalink"]?></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=edit&id=<?=$row["tag_id"]?>">Sửa</a></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=list&action=delete&id=<?=$row["tag_id"]?>" 
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
	<?php 
    }
	?>
<?php 
}
?>