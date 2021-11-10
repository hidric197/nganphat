<?php 
$table_name = 'np_prod_brand';
$fieldCondidtonName = 'brand_id';
$fieldConditionValue = '';
$fieldEditName = 'brand_name';
$fieldEditValue = '';
$permalinkValue = '';
?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?php  echo Common::$_HOME_PAGE .'/npad/' ?>"> <em class="fa fa-home"></em>
		</a></li>
		<li class="active">Quản lý Brand Sản Phẩm</li>
	</ol>
</div>
<!--/.row-->
<div class="row">
	<div class="col-lg-12">
		</br> <a href="?pcid=<?=$_REQUEST['pcid']?>&display=list"><button
				type="button" class="btn btn-sm btn-primary">Danh sách Brand</button></a>
		<a href="?pcid=<?=$_REQUEST['pcid']?>&display=addnew"><button
				type="button" class="btn btn-sm btn-success">Thêm Brand</button></a> </br>
		</br>
	</div>
</div>
<!--/.row-->

<?php
if (isset($_REQUEST['display']) && $_REQUEST['display'] == "addnew") {

    $message = "";
    
    if (isset($_POST['submit'])) {
        $resultOK = 1;
        if (!isset($_POST['brand_name']) || "" == $_POST['brand_name']){
            $resultOK = 0;
        }
        if (!isset($_POST['permalink']) || "" == $_POST['permalink']){
            $resultOK = 0;
        }        
        if ($resultOK == 0){
            $message = $ERROR_FIELD_NULL;
        } else {
            $fieldEditValue = $_POST['brand_name'];
            $permalinkValue = $_POST['permalink'];
            $brand_description = $_POST['brand_description'];
            $brand_seo = $_POST['brand_seo'];
            
            
            $resultOK = NpPermaLinkDba::insertData($conn, $permalinkValue, $table_name);
            if ($resultOK == 0) {
                $message = $ERROR_DUPLICATE_SLUG;
            } else {
                $data_id = NpPermaLinkDba::getMaxDataId($conn);
                $sql = "INSERT INTO np_prod_brand (data_id, brand_name, brand_description, brand_seo) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $data_id, $fieldEditValue, $brand_description, $brand_seo);
                $stmt->execute();
                
                $message = $INFO_INSERT_DATA_OK;
            }
        }
    }
    ?>
<script type="text/javascript">
    $(document).ready( function() {
        $("#brand_name").change(function() {
              $("#permalink").val(slug($('#brand_name').val()));
        });
	});
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Thêm Thông Tin Brand Sản Phẩm <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form action="" method="post">
						<div class="form-group">
							<label>Brand Name(<span style='color: red'>*</span>)
							</label> _Max: 300 ký tự <input type="text" class="form-control" name="brand_name" id="brand_name"
								value="" />
						</div>
						<div class="form-group">
							<label>Brand Name Permalink(<span style='color: red'>*</span>)
							</label> _Permalink là duy nhất. Không được có dấu '.' _Max: 300 ký tự <input type="text"
								class="form-control" name="permalink" id="permalink" value="" />
						</div>
						<div class="form-group">
							<label>Mô tả Brand </label> _Có thể nhập hoặc không _Max: 500 ký tự
							<textarea rows="5" class="form-control" name="brand_description" id="brand_description" ></textarea>
						</div>
						<div class="form-group">
							<label>Seo Brand </label> _Thông tin Header, Title, Meta ... để SEO _Max: 4000 ký tự
							<textarea rows="10" class="form-control" name="brand_seo" id="brand_seo" ><title>  </title>
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
    if (isset($_REQUEST['submit']))
    {
        $fieldConditionValue = $_POST['id'];
        $fieldEditValue = $_POST['brand_name'];
        $permalinkValue = $_POST['permalink'];
        $brand_description = $_POST['brand_description'];
        $brand_seo = $_POST['brand_seo'];
        
        NpPermaLinkDba::updPermalink($conn, $permalinkValue, $login_user_id, $table_name, $fieldCondidtonName, $fieldConditionValue, $fieldEditName, $fieldEditValue);
        
        $sql = "UPDATE np_prod_brand SET ";
        $sql .= " brand_name = ? ";
        $sql .= " ,brand_description = ? ";
        $sql .= " ,brand_seo = ? ";
        $sql .= $sql_common_update;
        $sql .= " WHERE brand_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $fieldEditValue, $brand_description, $brand_seo, $fieldConditionValue);
        $stmt->execute();
        
        $message = $INFO_UPDATE_DATA_OK;
    }
    if (!isset($_REQUEST['id']))
    {
        $message = $ERROR_UPDATE_DATA_FAIL;
    } else {
        $id = $conn->real_escape_string($_REQUEST['id']);
        $sql = "SELECT A.brand_id, A.brand_name, A.brand_description, A.brand_seo, B.permalink FROM np_prod_brand A ";
        $sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
        $sql .= " WHERE A.brand_id = '$id' AND B.delete_flag = '0'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Sửa Brand Sản Phẩm <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form action="" method="post">
						<div class="form-group">
							<label>Brand Name(<span style='color: red'>*</span>)
							</label> _Max: 300 ký tự <input type="text" class="form-control" name="brand_name" id="brand_name"
								value="<?=$row["brand_name"]?>" />
						</div>
						<div class="form-group">
							<label>Brand Name Permalink(<span style='color: red'>*</span>)
							</label>  _Permalink là duy nhất. Không được có dấu '.' _Max: 300 ký tự 
						<input type="text"
								class="form-control" name="permalink" id="permalink"
								value="<?=$row["permalink"]?>" />
						</div>
						<div class="form-group">
							<label>Mô tả Brand </label> _Có thể nhập hoặc không _Max: 500 ký tự
							<textarea rows="5" class="form-control" name="brand_description" id="brand_description" ><?=$row["brand_description"]?></textarea>
						</div>
						<div class="form-group">
							<label>Seo Brand </label> _Thông tin Header, Title, Meta ... để SEO _Max: 4000 ký tự
							<textarea rows="10" class="form-control" name="brand_seo" id="brand_seo" ><?=$row["brand_seo"]?></textarea>
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
        
        // Xóa Ảnh
        $id = $conn->real_escape_string($_REQUEST['id']);
        $sql = "SELECT image_url FROM np_prod_image WHERE brand_id = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (file_exists($row['image_url'])) {
                    unlink($row['image_url']);
                }
            }
        }
        $sql = "DELETE FROM np_prod_image WHERE brand_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $message = $INFO_DELETE_DATA_OK;
    }
    $sql = "SELECT A.brand_id, A.brand_name, B.permalink, A.image_title, A.image_url FROM np_prod_brand A ";
    $sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
    $sql .= " WHERE B.delete_flag = '0'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $n = 0;
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách Brand Sản Phẩm <?=$message?></div>
			<div class="panel-body">
				<table class="table">
				<tr>
					<td>No</td>
					<td>Brand Name</td>
					<td>Brand Permalink</td>
					<td>Ảnh Brand</td>
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
					<td><?=$row["brand_name"]?></td>
					<td><?=$row["permalink"]?></td>
					<td> <?=$row["image_url"]?> | <a href="?pcid=imgbr&display=addnew&id=<?=$row["brand_id"]?>&brname=<?=$row["brand_name"]?>&table=np_prod_brand">Update Ảnh</a></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=edit&id=<?=$row["brand_id"]?>">Sửa</a></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=list&action=delete&id=<?=$row["brand_id"]?>"
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