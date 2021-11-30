<?php 
$table_name = 'np_home';
    
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?php  echo Common::$_HOME_PAGE .'/npad/' ?>"> <em class="fa fa-home"></em>
		</a></li>
		<li class="active">Quản lý trang chủ</li>
	</ol>
</div>
<!--/.row-->
<div class="row">
	<div class="col-lg-12">
		</br> <a href="?pcid=<?=$_REQUEST['pcid']?>&display=list"><button
				type="button" class="btn btn-sm btn-primary">Danh sách Thẻ Meta</button></a>
		<a href="?pcid=<?=$_REQUEST['pcid']?>&display=addnew"><button
				type="button" class="btn btn-sm btn-success">Thêm Thẻ Meta</button></a> </br>
		</br>
	</div>
</div>
<!--/.row-->

<?php
if (isset($_REQUEST['display']) && $_REQUEST['display'] == "addnew") {

    $message = "";

    if (isset($_POST['submit'])) {
    	if (!$_POST['description'] && !$_POST['title'] && !$_POST['locale'] && !$_POST['locale'] && !$_POST['type'] && !$_POST['url'] && !$_POST['site_name'] && !$_POST['image'] && !$_POST['card']){
            goto break_point;
        }
        $description = $_POST['description'] ?? null;
        $title = $_POST['title'] ?? null;
        $locale = $_POST['locale'] ?? null;
        $type = $_POST['type'] ?? null;
        $url = $_POST['url'] ?? null;
        $site_name = $_POST['site_name'] ?? null;
        $image = $_POST['image'] ?? null;
        $card = $_POST['card'] ?? "";
        $data = [
        	':description' => $description ?? null,
            ':title' => $title ?? null,
            ':locale' => $locale ?? null,
            ':type' => $type ?? null,
            ':url' => $url ?? null,
            ':site_name' => $site_name ?? null,
            ':image' => $image ?? null,
            ':card' => $card ?? null,
        ];
        $conn_pdo = DBManager::getConnectionPDO();
        $sql = "INSERT INTO `np_meta_tag` (`description`, `title`, `locale`, `type`, `url`, `site_name`, `image`, `card`) VALUES (:description, :title, :locale, :type, :url,:site_name, :image, :card)";
        $stmt = $conn_pdo->prepare($sql);
        $stmt->execute($data);
        if(!$stmt) {
			$message = $ERROR_FIELD_NULL;
        }
        $message = $INFO_INSERT_DATA_OK;
        break_point:
    }
    ?>
<script type="text/javascript">
    $(document).ready( function() {
        $("#product_name").change(function() {
              $("#permalink").val(slug($('#product_name').val()));
        });
	});
</script>
<form action="" method="post" name="formProduct" id="formProduct">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Thêm Thông Tin Thẻ Meta <?=$message?></div>
				<div class="panel-body">
					<div class="col-md-6">
						<div class="form-group">
							<label>Description
							</label><textarea class="form-control" placeholder="<meta property='og:description' content='{Nội dung}'>" rows="5" name="description"></textarea>
						</div>
						<div class="form-group">
							<label>Locale
							</label><textarea class="form-control" placeholder="<meta property='og:locale' content='{Nội dung}'>" name="locale"></textarea>
						</div>
						<div class="form-group">
							<label>Type
							</label>
							<textarea class="form-control" placeholder="<meta property='og:type' content='{Nội dung}'>" name="type"></textarea>
						</div>
						<div class="form-group">
							<label>Url
							</label><textarea class="form-control" placeholder="<meta property='og:url' content='{Nội dung}'>" name="url"></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Title
							</label><textarea class="form-control" placeholder="<meta property='og:title' content='{Nội dung}'>" rows="5" name="title"></textarea>
						</div>
						<div class="form-group">
							<label>Site Name
							</label><textarea class="form-control" placeholder="<meta property='og:site_name' content='{Nội dung}'>" name="site_name"></textarea>
						</div>
						<div class="form-group">
							<label>Image
							</label><textarea class="form-control" placeholder="<meta property='og:image' content='{Nội dung}'>" name="image"></textarea>
						</div>
						<div class="form-group">
							<label>Card
							</label><textarea class="form-control" placeholder="<meta property='og:card' content='{Nội dung}'>" name="card"></textarea>
						</div>
						<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' /> 
						<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
						<input type="submit" id="submit" name="submit" value="Thêm thẻ meta" class="btn btn-primary"/>
						<br>
						<br>
						<br>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<?php
} else if (isset($_REQUEST['display']) && $_REQUEST['display'] == "edit") {
    $message = "";
    if (isset($_REQUEST['submit']))
    {
        $id = $_POST['id'];
        $description = $_POST['description'];
        $title = $_POST['title'];
        $locale = $_POST['locale'] ?? "";
        $type = $_POST['type'] ?? "";
        $url = $_POST['url'] ?? null;
        $site_name = $_POST['site_name'] ?? null;
        $image = $_POST['image'] ?? null;
        $card = $_POST['card'] ?? "";
        $data = [
        	':description' => $description ?? null,
            ':title' => $title ?? null,
            ':locale' => $locale ?? null,
            ':type' => $type ?? null,
            ':url' => $url ?? null,
            ':site_name' => $site_name ?? null,
            ':image' => $image ?? null,
            ':card' => $card ?? null,
        ];
        $conn_pdo = DBManager::getConnectionPDO();
        $sql = "UPDATE `np_meta_tag` SET `description` = :description, `title` = :title, `locale` = :locale, `type` = :type, `url` = :url, `site_name` = :site_name, `image` = :image, `card` = :card";
        $stmt = $conn_pdo->prepare($sql);
        $stmt->execute($data);
        if(!$stmt) {
			$message = $ERROR_UPDATE_DATA_FAIL;
        }
        
        $message = $INFO_UPDATE_DATA_OK;
    }
    if (!isset($_REQUEST['id']))
    {
        $message = $ERROR_UPDATE_DATA_FAIL;
    } else {
        $id = $conn->real_escape_string($_REQUEST['id']);
        $meta_tag_sql = "SELECT * FROM np_meta_tag ";
        $meta_tag_sql .= " WHERE meta_id = $id AND delete_flag = 0";
        $meta_tag_result = $conn->query($meta_tag_sql);
        if ($meta_tag_result->num_rows > 0) {
            while ($meta_tag_row = $meta_tag_result->fetch_assoc()) {
?>
<form action="" method="post" name="formProduct" id="formProduct">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Sửa Thông Tin Thẻ Meta <?=$message?></div>
				<div class="panel-body">
					<div class="col-md-6">
						<div class="form-group">
							<label>Description
							</label><textarea class="form-control" placeholder="<meta property='og:description' content='{Nội dung}'>" rows="5" name="description"><?= $meta_tag_row['description']?></textarea>
						</div>
						<div class="form-group">
							<label>Locale
							</label>
							<textarea class="form-control" placeholder="<meta property='og:locale' content='{Nội dung}'>" name="locale"><?= $meta_tag_row['locale']?></textarea>
						</div>
						<div class="form-group">
							<label>Type
							</label>
							<textarea class="form-control" placeholder="<meta property='og:type' content='{Nội dung}'>" name="type"><?= $meta_tag_row['type']?></textarea>
						</div>
						<div class="form-group">
							<label>Url
							</label><textarea class="form-control" placeholder="<meta property='og:url' content='{Nội dung}'>" name="url"><?= $meta_tag_row['url'] ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Title
							</label><textarea class="form-control" placeholder="<meta property='og:title' content='{Nội dung}'>" rows="5" name="title"><?= $meta_tag_row['title']?></textarea>
						</div>
						<div class="form-group">
							<label>Site Name
							</label><textarea class="form-control" placeholder="<meta property='og:site_name' content='{Nội dung}'>" name="site_name"><?= $meta_tag_row['site_name'] ?></textarea>
						</div>
						<div class="form-group">
							<label>Image
							</label><textarea class="form-control" placeholder="<meta property='og:image' content='{Nội dung}'>" name="image"><?=$meta_tag_row['image'] ?></textarea>
						</div>
						<div class="form-group">
							<label>Card
							</label><textarea class="form-control" placeholder="<meta property='og:card' content='{Nội dung}'>" name="card"><?= $meta_tag_row['card']?></textarea>
						</div>
						<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' /> 
						<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
						<input type="hidden" name='id' value='<?=$_REQUEST['id']?>' /> 
						<input type="submit" id="submit" name="submit" value="Sửa thẻ meta" class="btn btn-primary"/>
						<br>
						<br>
						<br>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
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
        $meta_del_sql = "UPDATE np_meta_tag SET delete_flag = 1 ";
        $meta_del_sql .= " WHERE meta_id = $id";
        $stmt = $conn->prepare($meta_del_sql);
        $stmt->execute();
        
        $message = $INFO_DELETE_DATA_OK;
    }
    
    $sql = "SELECT * ";
    $sql .= " FROM np_meta_tag WHERE delete_flag = 0 ";
    
    $sql .= " ORDER BY meta_id DESC ";
    
    // =======================paging ============================
    // lay so so luong ban ghi
    $resultCount = $conn->query($sql);
    $totalRecord = $resultCount->num_rows;
    $totalPage =  intdiv($totalRecord, 100);
    if ($totalRecord - ($totalPage * 100) > 0) {
        $totalPage ++;
    }
    $currentPage = 1;
    if (isset($_POST['paging_group']) && !empty($_POST['paging_group'])) {
        $currentPage = $_POST['paging_group'];
        if (empty($currentPage)) {
            $currentPage = 1;
        }
    }
    $startR = ($currentPage - 1) * 100;
    
    $sql .= " Limit " .$startR. ", 100 ";
    
    // =======================paging ============================
    
    $result = $conn->query($sql);
    ?>
<form action="" method="post" name="list_product_form" id="list_product_form">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách Thẻ Meta (<?=($currentPage -1) * 100 ?> ~ <?=$currentPage * 100 ?>/<?=$totalRecord ?> thẻ) <?=$message?></div>
			<div class="panel-body">
    			
				<div class="col-md-6">
					<div class="form-group">
    					<select class="form-control" name="paging_group" id="paging_group" onchange="filter_group();">
    						<?php 
    						for ($i = 1; $i <= $totalPage; $i++) {
    						?>
    							<option value="<?=$i?>" <?php if($currentPage == $i) echo 'selected=selected';?>>Page <?=$i?></option>
    						<?php 
    						}
    						?>
    					</select>
    				</div>
    			</div>
    			<div class="col-md-6">
    				<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' /> 
					<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' />
    			</div>
			</div>
			<div class="panel-body">
				<table class="table">
				<tr>
					<td>No</td>
					<td>MetaTag ID</td>
					<td>Title</td>
					<td>Url</td>
					<td>Site Name</td>
					<td>Hành Động</td>
				</tr>
				<?php 
				if ($result->num_rows > 0) {
				    $n = 0;
    				while ($row = $result->fetch_assoc()) {
    				    $n ++;
				?>
				<tr>
					<td><?=$n?></td>
					<td><?=$row['meta_id']?></td>
					<td><?= htmlentities($row['title']) ?></td>
					<td><?= htmlentities($row['url']) ?></td>
					<td><?= htmlentities($row['site_name']) ?></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=edit&id=<?=$row['meta_id']?>">Sửa </a>
						<a href="?pcid=<?=$_REQUEST['pcid']?>&display=list&action=delete&id=<?=$row['meta_id']?>"
							onclick="return confirm('<?=$CONFIRM_DELETE?>');">Xóa</a></td>
				</tr>
				<?php 
				    }
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