<?php 
$table_name = 'np_landing_page';
$fieldCondidtonName = 'landing_page_id';
$fieldConditionValue = '';
$fieldEditName = 'landing_page_name';
$fieldEditValue = '';
$permalinkValue = '';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
  
 

<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?php  echo Common::$_HOME_PAGE .'/npad/' ?>"> <em class="fa fa-home"></em>
		</a></li>
		<li class="active">Quản lý LandingPage</li>
	</ol>
</div>
<!--/.row-->
<div class="row">
	<div class="col-lg-12">
		</br> <a href="?pcid=<?=$_REQUEST['pcid']?>&display=list"><button
				type="button" class="btn btn-sm btn-primary">Danh sách LandingPage</button></a>
		<a href="?pcid=<?=$_REQUEST['pcid']?>&display=addnew"><button
				type="button" class="btn btn-sm btn-success">Thêm LandingPage</button></a> </br>
		</br>
	</div>
</div>
<!--/.row-->

<?php
if (isset($_REQUEST['display']) && $_REQUEST['display'] == "addnew") {
    $message = '';
    $page_group_id = '';
    if (isset($_POST['submit'])) {
        $resultOK = 1;
        if (!isset($_POST['landing_page_name']) || "" == $_POST['landing_page_name']){
            $resultOK = 0;
        }
        if (!isset($_POST['permalink']) || "" == $_POST['permalink']){
            $resultOK = 0;
        }
        if (!isset($_POST['landing_page_content']) || "" == $_POST['landing_page_content']){
            $resultOK = 0;
        }
        if ($resultOK == 0){
            $message = $ERROR_FIELD_NULL;
        } else {
            $fieldEditValue = $_POST['landing_page_name'];
            $permalinkValue = $_POST['permalink'];
            $landing_page_content = $_POST['landing_page_content'];
            $landing_page_seo = $_POST['landing_page_seo'];
            $footer_display = $_POST['footer_display'];
            
            $resultOK = NpPermaLinkDba::insertData($conn, $permalinkValue, $table_name);
            if ($resultOK == 0) {
                $message = $ERROR_DUPLICATE_SLUG;
            } else {
                $data_id = NpPermaLinkDba::getMaxDataId($conn);
                $sql = "INSERT INTO np_landing_page (data_id, landing_page_name, landing_page_content, landing_page_seo, insert_user, footer_display) ";
                $sql .= " VALUES (?, ?, ?, ?, '$login_user_id', ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $data_id, $fieldEditValue, $landing_page_content, $landing_page_seo, $footer_display);
                $stmt->execute();
                
                $message = $INFO_INSERT_DATA_OK;
            }
        }
    }
    ?>
<script type="text/javascript">
    $(document).ready( function() {
        $("#landing_page_name").change(function() {
              $("#permalink").val(slug($('#landing_page_name').val()));
        });
	});
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		<form action="" method="post">
			<div class="panel-heading">Thêm Thông Tin LandingPage  <?=$message?></div>
			<div class="panel-body">
    				<div class="col-md-6">
    					<div class="form-group">
    						<label>Tên LandingPage (<span style='color: red'>*</span>)
    						</label> _Max: 300 ký tự <input type="text" class="form-control" name="landing_page_name" id="landing_page_name"
    							value="" />
    					</div>
    					<div class="form-group">
    						<label>LandingPage Permalink(<span style='color: red'>*</span>)
    						</label> _ Permalink là duy nhất. Không bao gồm ký tự '.' _Max: 300 ký tự <input type="text" id="permalink"
    							class="form-control" name="permalink" value="" />
    					</div>
    					<div class="form-group">
							<label>Hiển thị Footer :</label>
							<input type="radio" name="footer_display" id="user_type1" value="0" checked="checked">&nbsp;Hiển thị
							&nbsp;&nbsp;&nbsp;<input type="radio" name="footer_display" id="user_type2" value="1">&nbsp;Không hiển thị
						</div>
        			</div>
        				<div class="col-md-6">
    						<div class="form-group">
    							<label>Page Seo </label> _Thông tin Header, Title, Meta ... để SEO _Max: 4000 ký tự
    							<textarea rows="10" class="form-control" name="landing_page_seo" id="landing_page_seo" ><title>  </title>
<meta name="description" content="  "/>
<meta name=robots content=INDEX,FOLLOW,ALL />
							</textarea>
    						</div>
    					</div>
        			</div>
        			<div class="form-group">
        						<label>Chi tiết LandingPage(<span style='color: red'>*</span>)
        						</label> <textarea rows="30" class="form-control" name="landing_page_content" id="editor">
        						</textarea>
        			</div>
        			</br>
        			<div class="form-group">
        				<label>(<span style='color: red'>*</span>)
        				</label> Trường cần phải nhập thông tin
        			
        			<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' />
        			<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
        			<input type="submit" name="submit" value="Push LandingPage"
        				class="btn btn-primary" /> 
        			<input type="reset"
        				class="btn btn-default" value="Reset" />
			</div>
			</br></br></br>
		</div>
		</form>
		</div>
	</div>
</div>
<?php
} else if (isset($_REQUEST['display']) && $_REQUEST['display'] == "edit") {
    $message = "";
    if (isset($_REQUEST['submit']))
    {
        $id = $_POST['id'];
        $landing_page_name = $_POST['landing_page_name'];
        $permalink = $_POST['permalink'];
        $landing_page_content = $_POST['landing_page_content'];
        $landing_page_seo = $_POST['landing_page_seo'];
        $footer_display = $_POST['footer_display'];
        
        $sql = "UPDATE np_permalink SET permalink = ? ";
        $sql .= $sql_common_update;
        $sql .= " WHERE data_id IN (SELECT data_id FROM np_landing_page WHERE landing_page_id = ? )";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $permalink, $id);
        $stmt->execute();
        
        $sql = "UPDATE np_landing_page SET ";
        $sql .= " landing_page_name = ? ";
        $sql .= " , landing_page_content = ? ";
        $sql .= " , landing_page_seo = ? ";
        $sql .= " , footer_display = ? ";
        $sql .= $sql_common_update;
        $sql .= " WHERE landing_page_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $landing_page_name, $landing_page_content, $landing_page_seo, $footer_display, $id);
        $stmt->execute();
        
        $message = $INFO_UPDATE_DATA_OK;
    }
    if (!isset($_REQUEST['id']))
    {
        $message = $ERROR_UPDATE_DATA_FAIL;
    } else {
        $page_group_id = '';
        $id = $conn->real_escape_string($_REQUEST['id']);
        $sql = "SELECT A.landing_page_id, A.landing_page_name, A.landing_page_content, A.landing_page_seo, B.permalink, A.footer_display ";
        $sql .= " FROM np_landing_page A ";
        $sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
        $sql .= " WHERE A.landing_page_id = '$id' AND B.delete_flag = '0'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		<form action="" method="post">
			<div class="panel-heading">Sửa Thông Tin LandingPage  <?=$message?></div>
			<div class="panel-body">
    				<div class="col-md-6">
    					<div class="form-group">
    						<label>LandingPage (<span style='color: red'>*</span>)
    						</label> _Max: 300 ký tự <input type="text" class="form-control" name="landing_page_name" id="landing_page_name"
    							value="<?=$row['landing_page_name']?>" />
    					</div>
    					<div class="form-group">
    						<label>LandingPage Permalink(<span style='color: red'>*</span>)
    						</label> _ Permalink là duy nhất. Không bao gồm ký tự '.' _Max: 300 ký tự <input type="text" id="permalink"
    							class="form-control" name="permalink" value="<?=$row['permalink']?>" />
    					</div>
    					<div class="form-group">
							<label>Hiển thị Footer :</label>
							<input type="radio" name="footer_display" id="user_type1" value="0" <?php if ($row['footer_display'] == '0') echo "checked='checked'"; ?>>&nbsp;Hiển thị
							&nbsp;&nbsp;&nbsp;<input type="radio" name="footer_display" id="user_type2" value="1" <?php if ($row['footer_display'] == '1') echo "checked='checked'"; ?>>&nbsp;Không hiển thị
						</div>
        			</div>
        				<div class="col-md-6">
    						<div class="form-group">
    							<label>Landing Page Seo </label> _Thông tin Header, Title, Meta ... để SEO _Max: 4000 ký tự
    							<textarea rows="10" class="form-control" name="landing_page_seo" id="landing_page_seo" ><?=$row['landing_page_seo']?></textarea>
    						</div>
    					</div>
        			</div>
        			<div class="form-group">
        						<label>Chi tiết LandingPage(<span style='color: red'>*</span>)
        						</label> <textarea rows="30" class="form-control" name="landing_page_content" id="editor"><?=$row['landing_page_content']?></textarea>
        			</div>
        			</br>
        			<div class="form-group">
        				<label>(<span style='color: red'>*</span>)
        				</label> Trường cần phải nhập thông tin
        			<input type="hidden" name='id' value='<?=$_REQUEST['id']?>' />
        			<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' />
        			<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
        			<input type="submit" name="submit" value="Thay đổi LandingPage"
        				class="btn btn-primary" /> 
        			<input type="reset"
        				class="btn btn-default" value="Reset" />
			</div>
			</br></br></br>
		</div>
		</form>
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
    $sql = "SELECT A.landing_page_id, A.landing_page_name, B.permalink FROM np_landing_page A ";
    $sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id WHERE B.delete_flag = '0'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $n = 0;
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách LandingPage <?=$message?></div>
			<div class="panel-body">
				<table class="table">
				<tr>
					<td>No</td>
					<td>Group Name</td>
					<td>Group Permalink</td>
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
					<td><?=$row["landing_page_name"]?></td>
					<td><?=$row["permalink"]?></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=edit&id=<?=$row["landing_page_id"]?>">Sửa</a></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=list&action=delete&id=<?=$row["landing_page_id"]?>"
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

<script>
	CKEDITOR.replace( 'editor' , {
		height: 300,
    	filebrowserUploadUrl: 'ckUpload.php'
//     	filebrowserBrowseUrl: 'lib/ckfinder/ckfinder.html',
// 		filebrowserUploadUrl: 'lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
	} );
</script>