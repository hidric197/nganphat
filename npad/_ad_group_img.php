<?php 
namespace Verot\Upload;
include ('lib/upload/src/class.upload.php');
?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="index.php"> <em class="fa fa-home"></em>
		</a></li>
		<li class="active">Quản lý Ảnh Group</li>
	</ol>
</div>
<!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-12">
				</br> <a href="?pcid=<?=$_REQUEST['pcid']?>&display=list"><button
						type="button" class="btn btn-sm btn-primary">Danh sách Ảnh</button></a>
				</br> </br>
			</div>
		</div>
	</div>
</div>
<!--/.row-->

<?php
if (isset($_REQUEST['display']) && $_REQUEST['display'] == "addnew") {
    $message = "";
    $groudname = $_REQUEST['grdname'];
    if (isset($_POST['submit'])) {
        $dir_dest = (isset($_GET['dir']) ? $_GET['dir'] : 'uploadImage');
        $dir_pics = (isset($_GET['pics']) ? $_GET['pics'] : $dir_dest);
        $files = array();
        foreach ($_FILES['file_field'] as $k => $l) {
            foreach ($l as $i => $v) {
                if (! array_key_exists($i, $files))
                    $files[$i] = array();
                    $files[$i][$k] = $v;
            }
        }
        $n = 1;
        // now we can loop through $files, and feed each element to the class
        foreach ($files as $file) {
            // we instanciate the class for each element of $file
            $handle = new Upload($file);
            // then we check if the file has been uploaded properly
            // in its *temporary* location in the server (often, it is /tmp)
            if ($handle->uploaded) {
                // now, we start the upload 'process'. That is, to copy the uploaded file
                // from its temporary location to the wanted location
                // It could be something like $handle->process('/home/www/my_uploads/');
                $handle->process($dir_dest);
                // we check if everything went OK
                if ($handle->processed) {
                    $id = $_POST['id'];
                    $image_title = $_POST['fileup_' . $n];               
                    $image_url = $dir_pics . '/' . $handle->file_dst_name;
                    
                    $sql = "UPDATE np_prod_group SET image_title = ?, image_url = ? ";
                    $sql .= $sql_common_update;
                    $sql .= "WHERE group_id = ?";                    
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $image_title, $image_url, $id);
                    $stmt->execute();
                    
                    $message = "(<span style='color: red'>Update Ảnh cho Group thành công !</span>)";
                    
                } else {
                    $message = "(<span style='color: red'>Hãy nhập đầy đủ thông tin !</span>)";
                }
            } else {
                $message = "(<span style='color: red'>Hãy nhập đầy đủ thông tin !</span>)";
            }
            $n ++;
        }
    }
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Thêm Ảnh Group <?=$groudname?> (150 x 150) <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form name="form3" enctype="multipart/form-data" method="post" action="">
						<div class="form-group">
						</div>
						<div class="form-group">
							<label>Tiêu đề ảnh	</label> _Max: 200 ký tự 
							<input type="text" class="form-control" name="fileup_1" value="" placeholder="Mô tả ảnh thứ nhất"/>
							</br>
							<input type="file" name="file_field[]" value="" />
						</div>
						<input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
						<input type="hidden" name="pcid" value="<?=$_REQUEST['pcid']?>" />
						<input type="hidden" name="display" value="<?=$_REQUEST['display']?>" /> 
						<input type="submit" name="submit" value="Upload Ảnh"
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
} else {
    $message = "";
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' && isset($_REQUEST['id']))
    {
        $id = $conn->real_escape_string($_REQUEST['id']);
        $sql = "SELECT image_url FROM np_prod_group WHERE group_id = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (file_exists($row['image_url'])) {
                    unlink($row['image_url']);
                }
            }
        }
        $sql = "UPDATE np_prod_group SET image_title = '', image_url = '' WHERE group_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $message = $INFO_DELETE_DATA_OK;
    }
    $sql = "SELECT A.group_id, A.group_name, A.image_url FROM np_prod_group A ";
    $sql .= " WHERE A.delete_flag = '0' ";
    $sql .= " GROUP BY A.group_id, A.group_name ";
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $n = 0;
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách Ảnh Group <?=$message?></div>
			<div class="panel-body">
				<table class="table">
				<tr>
					<td>No</td>
					<td>Tên Group</td>
					<td>Link Ảnh</td>
					<td>Thêm</td>
					<td>Xóa</td>
				</tr>
				<?php 
				while ($row = $result->fetch_assoc()) {
				    $n ++;
				?>
				<tr>
					<td><?=$n?></td>
					<td><?=$row["group_name"]?></td>
					<td><a href="<?=$row["image_url"]?>" target="blank"><?=$row["image_url"]?></a></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=addnew&id=<?=$row["group_id"]?>&grdname=<?=$row["group_name"]?>">Update Ảnh</a></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=list&action=delete&id=<?=$row["group_id"]?>"
						onclick="return confirm('<?=$CONFIRM_DELETE?>');">Xóa Ảnh</a></td>
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