<?php 
namespace Verot\Upload;
include ('lib/upload/src/class.upload.php');
?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="index.php"> <em class="fa fa-home"></em>
		</a></li>
		<li class="active">Quản lý Ảnh Sản Phẩm</li>
	</ol>
</div>
<!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-12">
				</br> <a href="?pcid=detpd&display=list"><button
				type="button" class="btn btn-sm btn-primary">Danh sách Sản Phẩm</button></a>
				</br> </br>
			</div>
		</div>
	</div>
</div>
<!--/.row-->

<?php
if (isset($_REQUEST['display']) && $_REQUEST['display'] == "addnew") {
    $product_id = $_REQUEST['id'];
    $message = "";
    $prdcode = $_REQUEST['prdcode'];
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
                    $imageType = '2';
                    if ($n == 1) {
                        $imageType = '1';
                    }
                    $image_title = $_POST['fileup_' . $n];               
                    $url = $dir_pics . '/' . $handle->file_dst_name;
                    $sql = "INSERT INTO np_prod_image(product_id, image_type, image_title, image_url) VALUES (?,?,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssss", $id, $imageType, $image_title, $url);
                    $stmt->execute();
                } else {
                    
                }
            } else {
                
            }
            $n ++;
            $message = "(<span style='color: red'>Thêm Ảnh cho sản phẩm thành công !</span>)";
        }
    }
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Thêm Ảnh Sản Phẩm Mã <?=$prdcode?> <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form name="form3" enctype="multipart/form-data" method="post" action="">
						<div class="form-group">
							<label>Chọn Ảnh Icon (Ảnh hiện thị ở list sản phẩm 140x140)</label>
						</div>
						<div class="form-group">
							<label>Tiêu đề ảnh	</label> _Max: 200 ký tự 
							<input type="text" class="form-control" name="fileup_1" value="" placeholder="Mô tả ảnh thứ nhất"/>
							<input type="file" name="file_field[]" value="" />
						</div>
						<div class="form-group">
							<label>Chọn Ảnh Mô Tả (Ảnh hiển thị chi tiết sản phẩm 440x440)</label>
						</div>
						<div class="form-group">
							<label>Tiêu đề ảnh	</label> _Max: 200 ký tự 
							<input type="text" class="form-control" name="fileup_2" value="" placeholder="Mô tả ảnh thứ hai"/>
							<input type="file" name="file_field[]" value="" />
						</div>
						<div class="form-group">
							<label>Tiêu đề ảnh	</label> _Max: 200 ký tự 
							<input type="text" class="form-control" name="fileup_3" value="" placeholder="Mô tả ảnh thứ ba"/>
							<input type="file" name="file_field[]" value="" />
						</div>
						<div class="form-group">
							<label>Tiêu đề ảnh	</label> _Max: 200 ký tự 
							<input type="text" class="form-control" name="fileup_4" value="" placeholder="Mô tả ảnh thứ tư"/>
							<input type="file" name="file_field[]" value="" />
						</div>
						<input type="hidden" name="id" value="<?=$product_id?>" />
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
    $message = "";
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' && isset($_REQUEST['id']))
    {
        $image_id = $conn->real_escape_string($_REQUEST['imageid']);
        $sql = "SELECT image_url FROM np_prod_image WHERE image_id = '$image_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (file_exists($row['image_url'])) {
                    unlink($row['image_url']);
                }
            }
        }
        $sql = "DELETE FROM np_prod_image WHERE image_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $image_id);
        $stmt->execute();
        $message = "(<span style='color: red'>Xóa bản ghi thành công</span>)";
    }
    $sql = "SELECT A.product_id, B.image_id, B.image_type, B.image_title, B.image_url FROM np_product A ";
    $sql .= " INNER JOIN np_prod_image B ON A.product_id = B.product_id ";
    $sql .= " WHERE A.delete_flag = '0' AND A.product_id = '$product_id' ";  
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $n = 0;
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách Ảnh đã Upload <?=$message?></div>
			<div class="panel-body">
				<table class="table">
				<tr>
					<td>No</td>
					<td>Product_Id</td>
					<td>Loại Ảnh</td>
					<td>Tiêu đề Ảnh</td>					
					<td>Url Ảnh</td>
					<td>Xóa</td>
				</tr>
				<?php 
				while ($row = $result->fetch_assoc()) {
				    $n ++;
				?>
				<tr>
					<td><?=$n?></td>
					<td><?=$row["product_id"]?></td>
					<td><?php
					if ($row["image_type"] == '1') {
					    echo 'Ảnh Icon';
					} else {
					    echo 'Ảnh Detail';
					}
					?></td>
					<td><?=$row["image_title"]?></td>
					<td><a target="_blank" href="<?=$row["image_url"]?>"><?=$row["image_url"]?></a></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=addnew&action=delete&id=<?=$row["product_id"]?>&imageid=<?=$row["image_id"]?>&prdcode=<?=$prdcode?>&table=np_product"
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