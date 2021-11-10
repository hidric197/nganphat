<?php 
namespace Verot\Upload;
include ('lib/upload/src/class.upload.php');
?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="index.php"> <em class="fa fa-home"></em>
		</a></li>
		<li class="active">Quản lý Ảnh Banner</li>
	</ol>
</div>
<!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-12">
				</br> <a href="?pcid=<?=$_REQUEST['pcid']?>&display=list"><button
						type="button" class="btn btn-sm btn-primary">Danh sách Ảnh</button></a>
						<a href="?pcid=<?=$_REQUEST['pcid']?>&display=addnew"><button
                				type="button" class="btn btn-sm btn-success">Thêm Ảnh</button></a> </br>
                		</br>
			</div>
		</div>
	</div>
</div>
<!--/.row-->

<?php
if (isset($_REQUEST['display']) && $_REQUEST['display'] == "addnew") {
    $message = "";
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
                    $banner_image_title = $_POST['fileup_' . $n]; 
                    $banner_image_type = $_POST['banner_image_type'];
                    $banner_image_link = $_POST['banner_image_link'];
                    $banner_background = $_POST['banner_background'];
                    $group_id = $_POST['group_id'];
                    
                    $url = $dir_pics . '/' . $handle->file_dst_name;
                    $sql = "INSERT INTO np_banner_image(banner_image_type, banner_image_title, banner_image_url, banner_image_link, banner_background, group_id) VALUES (?,?,?,?,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssssss", $banner_image_type, $banner_image_title, $url, $banner_image_link, $banner_background, $group_id);
                    $stmt->execute();
                } else {
                    
                }
            } else {
                
            }
            $n ++;
            $message = "(<span style='color: red'>Thêm Ảnh cho Banner thành công !</span>)";
        }
    }
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Thêm Ảnh Banner <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<form name="form3" enctype="multipart/form-data" method="post" action="">
						<div class="form-group">
						</div>
						<div class="form-group">
							<label>Vị trí hiển thị ảnh Banner(<span style='color: red'>*</span>)
							</label> 
							<?php 
							$selected_banner_image_type = '';
							if (isset($_REQUEST['banner_image_type'])){
							    $selected_banner_image_type = $_REQUEST['banner_image_type'];
            				    }
            				?>
							<select class="form-control" name="banner_image_type" id="banner_image_type">
								<option <?php if($selected_banner_image_type == "1"){ echo "selected='selected'";}?> value="1">Top Banner của PC</option>
								<option <?php if($selected_banner_image_type == "2"){ echo "selected='selected'";}?> value="2">HomePage Slide của PC</option>
								<option <?php if($selected_banner_image_type == "3"){ echo "selected='selected'";}?> value="3">Group Page Slide của PC</option>
								<option <?php if($selected_banner_image_type == "6"){ echo "selected='selected'";}?> value="6">Ảnh nhỏ cạnh Homepage Slide của PC</option>
								<option <?php if($selected_banner_image_type == "4"){ echo "selected='selected'";}?> value="4">Top Banner của MB</option>
								<option <?php if($selected_banner_image_type == "5"){ echo "selected='selected'";}?> value="5">HomePage Slide của MB</option>
							</select>
						</div>
						<div class="form-group">
							<label>Tiêu đề ảnh	</label> _Max: 200 ký tự 
							<input type="text" class="form-control" name="fileup_1" value="" placeholder="Mô tả ảnh"/>
							</br>
							<input type="file" name="file_field[]" value="" />
						</div>
						<div class="form-group">
							<label>Link ảnh	</label> _Max: 255 ký tự 
							<input type="text" class="form-control" name="banner_image_link" value="" placeholder="Link ảnh"/>
						</div>
						<div class="form-group">
							<label>Màu Nền Cho Ảnh Banner	</label> Sử dụng cho ảnh banner ( Mặc định #FFFFFF )
							<input type="text" class="form-control" name="banner_background" value="#FFFFFF" placeholder="Màu nền"/>
						</div>
						<div class="form-group">
							<label>Group sản phẩm </label>  
							<select class="form-control" name="group_id" id="group_id">
								<option value="0">---- Chọn Group ----</option>
								<?php 
								for ($i = 1; $i < 4; $i++) {					    
								?>
								<option value="">
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
    									<option value="<?=$row['group_id']?>">&nbsp;&nbsp;&nbsp;|---(<?=$row['group_name']?>)</option>
    									<?php 
    									$sql1 = "SELECT group_id, group_name FROM np_prod_group ";
    									$sql1 .= " WHERE group_level_up = '" .$row['group_id']. "' AND delete_flag = '0'";
    									$result1 = $conn->query($sql1);
    									if ($result1->num_rows > 0) {
    									    while ($row1 = $result1->fetch_assoc()) {
    									?>
    										<option value="<?=$row1['group_id']?>">&nbsp;&nbsp;&nbsp;
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
							Chú ý: 
							</br>1. Ảnh Top Banner của PC : Nhiều ảnh (1235 x 60)
							</br>2. ẢNh Home Slide của PC : Nhiều ảnh (720 x 445)
							</br>3. Group Page Slide của PC : Nhiều ảnh (970 x 270)
							</br>4. Ảnh Nhỏ cạnh Slide Homepage của PC : 2 ảnh (300 x 250)
							</br>5. Ảnh Top Banner của MB : Nhiều ảnh (320 x 60)
							</br>6. ẢNh Home Slide của MB : Nhiều ảnh (630 x 390)
							
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
        $sql = "SELECT banner_image_url FROM np_banner_image WHERE banner_image_id = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (file_exists($row['banner_image_url'])) {
                    unlink($row['banner_image_url']);
                }
            }
        }
        $sql = "DELETE FROM np_banner_image WHERE banner_image_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $message = "(<span style='color: red'>Xóa bản ghi thành công</span>)";
    }
    $sql = "SELECT A.banner_image_id, A.banner_image_type, A.banner_image_title, A.banner_image_url, A.banner_image_link FROM np_banner_image A ";
    $sql .= " WHERE A.delete_flag = '0' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $n = 0;
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách Ảnh Brand <?=$message?></div>
			<div class="panel-body">
				<table class="table">
				<tr>
					<td>No</td>
					<td>Title Ảnh</td>
					<td>Ảnh</td>
					<td>Link hiển thị</td>
					<td>Hiển thị Ảnh</td>
					<td>Xóa</td>
				</tr>
				<?php 
				while ($row = $result->fetch_assoc()) {
				    $n ++;
				?>
				<tr>
					<td><?=$n?></td>
					<td><?=$row["banner_image_title"]?></td>
					<td><a target="blank" href="<?=$row["banner_image_url"]?>" ><?=$row["banner_image_url"]?></a></td>
					<td><a target="blank" href="<?=$row["banner_image_link"]?>" ><?=$row["banner_image_link"]?></a></td>
					<td><?php 
    					if ($row["banner_image_type"] == '1'){
    					    echo "Top Banner của PC";
    					}
    					if ($row["banner_image_type"] == '2'){
    					    echo "HomePage Slide của PC";
    					}
    					if ($row["banner_image_type"] == '3'){
    					    echo "Group Page Slide của PC";
    					}
    					if ($row["banner_image_type"] == '4'){
    					    echo "Top Banner của MB";
    					}
    					if ($row["banner_image_type"] == '5'){
    					    echo "HomePage Slide của MB";
    					}
    					if ($row["banner_image_type"] == '6'){
    					    echo "Ảnh nhỏ cạnh HomePage Slide của MB";
    					}
					?></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=list&action=delete&id=<?=$row["banner_image_id"]?>"
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