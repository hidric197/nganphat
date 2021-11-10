<?php 
$table_name = 'np_page';
$fieldCondidtonName = 'page_id';
$fieldConditionValue = '';
$fieldEditName = 'page_name';
$fieldEditValue = '';
$permalinkValue = '';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>

<script language="JavaScript" type="text/javascript">
    // AJAX call for autocomplete 
    $(document).ready(function(){
    	$("#suggest_tag_id").keyup(function(){
    		$.ajax({
    		type: "POST",
    		url: "_api_search_tag.php",
    		data:'keyword='+$(this).val(),
    		beforeSend: function(){
    			// $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
    		},
    		success: function(data){
    			$("#suggesstion-tag-box").show();
    			$("#suggesstion-tag-box").html(data);
    		}
    		});
    	});
    });
    
    $(document).ready(function(){
    	$( "#suggest_set_tag_id" ).click(function() {
    		var addTag = $( "#suggest_tag_id" ).val();
    		var nowTag = $( "#tag_id" ).val();
          	
          	// set cai o suggest la trong
          	$( "#suggest_tag_id" ).val('');
          	
          	// truong hop chua add
          	if (nowTag == null || nowTag == '') {
          		$( "#tag_id" ).append(addTag);
          	} else {
          		var listNowTags = nowTag.split(',');
          		var i;
          		var isExits = '0';
                for (i = 0; i < listNowTags.length; i++) {
                  if(listNowTags[i] == addTag) {
                  	isExits = '1';
                  }
                }
                if (isExits == '0') {
              		$( "#tag_id" ).append(',');
              		$( "#tag_id" ).append(addTag);
          		}
          	}
        });
    });
    
    $(document).ready(function(){
    	$("#suggest_product_id").keyup(function(){
    		$.ajax({
    		type: "POST",
    		url: "_api_search_product.php",
    		data:'keyword='+$(this).val(),
    		beforeSend: function(){
    			// $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
    		},
    		success: function(data){
    			$("#suggest_product_box").show();
    			$("#suggest_product_box").html(data);
    		}
    		});
    	});
    });
    
    $(document).ready(function(){
    	$( "#suggest_set_product_id" ).click(function() {
    		var addproduct = $( "#suggest_product_id" ).val();
    		var nowproduct = $( "#product_id" ).val();
          	
          	// set cai o suggest la trong
          	$( "#suggest_product_id" ).val('');
          		
          	// truong hop chua add
          	if (nowproduct == null || nowproduct == '') {
          		$( "#product_id" ).append(addproduct);
          	} else {
          		var listNowproducts = nowproduct.split(',');
          		var i;
          		var isExits = '0';
                for (i = 0; i < listNowproducts.length; i++) {
                  if(listNowproducts[i] == addproduct) {
                  	isExits = '1';
                  }
                }
                if (isExits == '0') {
              		$( "#product_id" ).append(',');
              		$( "#product_id" ).append(addproduct);
          		}
          	}
        });
    });
    
</script>
  
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?php  echo Common::$_HOME_PAGE .'/npad/' ?>"> <em class="fa fa-home"></em>
		</a></li>
		<li class="active">Quản lý Bài Viết</li>
	</ol>
</div>
<!--/.row-->
<div class="row">
	<div class="col-lg-12">
		</br> <a href="?pcid=<?=$_REQUEST['pcid']?>&display=list"><button
				type="button" class="btn btn-sm btn-primary">Danh sách Bài Viết</button></a>
		<a href="?pcid=<?=$_REQUEST['pcid']?>&display=addnew"><button
				type="button" class="btn btn-sm btn-success">Thêm Bài Viết</button></a> </br>
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
        if (!isset($_POST['page_name']) || "" == $_POST['page_name']){
            $resultOK = 0;
        }
        if (!isset($_POST['permalink']) || "" == $_POST['permalink']){
            $resultOK = 0;
        }
        if (!isset($_POST['page_group_id']) || "" == $_POST['page_group_id']){
            $resultOK = 0;
        }
        if (!isset($_POST['page_description']) || "" == $_POST['page_description']){
            $resultOK = 0;
        }
        if (!isset($_POST['page_content']) || "" == $_POST['page_content']){
            $resultOK = 0;
        }
        if ($resultOK == 0){
            $message = $ERROR_FIELD_NULL;
        } else {
            $fieldEditValue = $_POST['page_name'];
            $permalinkValue = $_POST['permalink'];
            $page_group_id = $_POST['page_group_id'];
            $page_description = $_POST['page_description'];
            $page_content = $_POST['page_content'];
            $page_seo = $_POST['page_seo'];
            $tag_id = $_POST['tag_id'];
            $product_id = $_POST['product_id'];
            
            $resultOK = NpPermaLinkDba::insertData($conn, $permalinkValue, $table_name);
            if ($resultOK == 0) {
                $message = $ERROR_DUPLICATE_SLUG;
            } else {
                $data_id = NpPermaLinkDba::getMaxDataId($conn);
                $sql = "INSERT INTO np_page (data_id, page_group_id, page_display_type, page_name, page_description, page_content, page_seo, insert_user) ";
                $sql .= " VALUES (?, ?, '0', ?, ?, ?, ?, '$login_user_id')";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $data_id, $page_group_id, $fieldEditValue, $page_description, $page_content, $page_seo);
                $stmt->execute();
                
                if (!empty($tag_id)) {
                    $id = NpPermaLinkDba::getMaxPageId($conn);
                    $arrTag = explode(",", $tag_id);
                    foreach ($arrTag as $str) {
                        $slug = Common::convertSlug(trim($str));
                        NpPermaLinkDba::insertTagPage($conn, trim($str), trim($slug), $id);
                    }
                }
                
                if (!empty($product_id)) {
                    $pageid = NpPermaLinkDba::getMaxPageId($conn);
                    $arrProduct = explode(",", $product_id);
                    
                    foreach ($arrProduct as $str) {
                        $tempProductId = '';
                        $sqlp = "SELECT product_id ";
                        $sqlp .= " FROM np_product A ";
                        $sqlp .= " WHERE  A.product_name = '$str' ";
                        $resultp = $conn->query($sqlp);
                        if ($resultp->num_rows > 0) {
                            while ($rowp = $resultp->fetch_assoc()) {
                                $tempProductId = $rowp['product_id'];
                            }
                        }
                        $tempProductId = $conn->real_escape_string($tempProductId);
                        $sql = "INSERT INTO page_product (page_id, product_id) VALUES (?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ss", $pageid, $tempProductId);
                        $stmt->execute();
                    }
                }
                $message = $INFO_INSERT_DATA_OK;
            }
        }
    }
    ?>
<script type="text/javascript">
    $(document).ready( function() {
        $("#page_name").change(function() {
              $("#permalink").val(slug($('#page_name').val()));
        });
	});
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		<form action="" method="post">
			<div class="panel-heading">Thêm Thông Tin Bài Viết  <?=$message?></div>
			<div class="panel-body">
    				<div class="col-md-6">
    					<div class="form-group">
    						<label>Nhóm Bài viết(<span style='color: red'>*</span>)
    						</label> 
    						<?php 
    						$sql = "SELECT A.page_group_id, A.page_group_name FROM np_page_group A ";
    						$sql .= " WHERE A.delete_flag = '0'";
    						$result20 = $conn->query($sql);
    						if ($result20->num_rows > 0) {
    						?>
    						<select class="form-control" name="page_group_id" id="page_group_id">
    								<?php 
    								while ($row20 = $result20->fetch_assoc()) {
                    				?>
    								<option <?php if ($page_group_id == $row20['page_group_id']) { echo "selected = 'selected'";}?> value="<?=$row20['page_group_id']?>"><?=$row20['page_group_name']?></option>
    								<?php 
                    				}
    								?>
    						</select>
    						<?php 
    						}
    						?>
    					</div>
    					<div class="form-group">
    						<label>Tên Bài Viết (<span style='color: red'>*</span>)
    						</label> _Max: 300 ký tự <input type="text" class="form-control" name="page_name" id="page_name"
    							value="" />
    					</div>
    					<div class="form-group">
    						<label>Bài Viết Permalink(<span style='color: red'>*</span>)
    						</label> _ Permalink là duy nhất. Không bao gồm ký tự '.' _Max: 300 ký tự <input type="text" id="permalink"
    							class="form-control" name="permalink" value="" />
    					</div>
    					<div class="form-group">
							<label>Tag Bài viết</label> _ Có thể thêm nhiều tag cách nhau bởi dấu ',' ( VD: tag1, tag2, ... )
							<input list="browsers-tag" name="suggest_tag_id" id="suggest_tag_id" value="" placeholder="Hỗ trợ tìm kiến Tag" style="width: 300px"/>
							<input type="button" id="suggest_set_tag_id" value="Thêm Tag"/>
							<div id="suggesstion-tag-box"></div>
							<textarea rows="5" class="form-control" name="tag_id" id="tag_id" ></textarea>
						</div>
						<div class="form-group">
							<label>Sản Phẩm Liên Quan Bài viết</label> _ Có thể chọn nhiều sản phẩm cách nhau bởi dấu ','
							<input list="browsers-product" name="suggest_product_id" id="suggest_product_id" value="" placeholder="Hỗ trợ tìm kiến Sản Phẩm"  style="width: 300px"/>
							<input type="button" id="suggest_set_product_id" value="Thêm Product"/>
							<div id="suggest_product_box"></div>
							<textarea rows="5" class="form-control" name="product_id" id="product_id" ></textarea>
						</div>
        			</div>
        				<div class="col-md-6">
    						<div class="form-group">
    							<label>Tóm tắt Bài viết(<span style='color: red'>*</span>)
    						</label> _Max: 500 ký tự <textarea rows="10" class="form-control" name="page_description"></textarea>
    						</div>
    						<div class="form-group">
    							<label>Page Seo </label> _Thông tin Header, Title, Meta ... để SEO _Max: 4000 ký tự
    							<textarea rows="10" class="form-control" name="page_seo" id="page_seo" ><title>  </title>
<meta name="description" content="  "/>
<meta name=robots content=INDEX,FOLLOW,ALL />
							</textarea>
    						</div>
    					</div>
        			</div>
        			<div class="form-group">
        						<label>Chi tiết Bài viết(<span style='color: red'>*</span>)
        						</label> <textarea rows="30" class="form-control" name="page_content" id="editor">
        						</textarea>
        			</div>
        			</br>
        			<div class="form-group">
        				<label>(<span style='color: red'>*</span>)
        				</label> Trường cần phải nhập thông tin
        			
        			<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' />
        			<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
        			<input type="submit" name="submit" value="Push Bài Viết"
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
        $page_name = $_POST['page_name'];
        $permalink = $_POST['permalink'];
        $page_group_id = $_POST['page_group_id'];
        $page_description = $_POST['page_description'];
        $page_content = $_POST['page_content'];
        $page_seo = $_POST['page_seo'];
        $tag_id = $_POST['tag_id'];
        $product_id = $_POST['product_id'];
        
        $sql = "UPDATE np_permalink SET permalink = ? ";
        $sql .= $sql_common_update;
        $sql .= " WHERE data_id IN (SELECT data_id FROM np_page WHERE page_id = ? )";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $permalink, $id);
        $stmt->execute();
        
        $sql = "UPDATE np_page SET page_group_id = ? ";
        $sql .= " , page_name = ? ";
        $sql .= " , page_description = ? ";
        $sql .= " , page_content = ? ";
        $sql .= " , page_seo = ? ";
        $sql .= $sql_common_update;
        $sql .= " WHERE page_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssi", $page_group_id, $page_name, $page_description, $page_content, $page_seo, $id);
        $stmt->execute();
        
        // Delete all tag list for this page
        $delId = $conn->real_escape_string($id);
        $sql = "DELETE FROM tag_page WHERE page_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delId);
        $stmt->execute();
        
        if (!empty($tag_id)) {
            $arrTag = explode(",", $tag_id);
            foreach ($arrTag as $str) {
                $slug = Common::convertSlug(trim($str));
                NpPermaLinkDba::insertTagPage($conn, trim($str), trim($slug), $id);
            }
        }
        
        // Delete all tag list for this page
        $delId = $conn->real_escape_string($id);
        $sql = "DELETE FROM page_product WHERE page_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delId);
        $stmt->execute();
        
        if (!empty($product_id)) {
            $pageid = $id;
            $arrProduct = explode(",", $product_id);
            
            foreach ($arrProduct as $str) {
                $tempProductId = '';
                $sqlp = "SELECT product_id ";
                $sqlp .= " FROM np_product A ";
                $sqlp .= " WHERE  A.product_name = '$str' ";
                $resultp = $conn->query($sqlp);
                if ($resultp->num_rows > 0) {
                    while ($rowp = $resultp->fetch_assoc()) {
                        $tempProductId = $rowp['product_id'];
                    }
                }
                $tempProductId = $conn->real_escape_string($tempProductId);
                $sql = "INSERT INTO page_product (page_id, product_id) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $pageid, $tempProductId);
                $stmt->execute();
            }
        }
        
        $message = $INFO_UPDATE_DATA_OK;
    }
    if (!isset($_REQUEST['id']))
    {
        $message = $ERROR_UPDATE_DATA_FAIL;
    } else {
        $page_group_id = '';
        $id = $conn->real_escape_string($_REQUEST['id']);
        $sql = "SELECT A.page_id, A.page_group_id, A.page_name, A.page_description, A.page_content, A.page_seo, B.permalink ";
        $sql .= " FROM np_page A ";
        $sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
        $sql .= " WHERE A.page_id = '$id' AND B.delete_flag = '0'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $page_group_id = $row['page_group_id'];
                $page_id = $row['page_id'];
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		<form action="" method="post">
			<div class="panel-heading">Sửa Thông Tin Bài Viết  <?=$message?></div>
			<div class="panel-body">
    				<div class="col-md-6">
    					<div class="form-group">
    						<label>Nhóm Bài viết(<span style='color: red'>*</span>)
    						</label> 
    						<?php 
    						$sql20 = "SELECT A.page_group_id, A.page_group_name FROM np_page_group A ";
    						$sql20 .= " WHERE A.delete_flag = '0'";
    						$result20 = $conn->query($sql20);
    						if ($result20->num_rows > 0) {
    						?>
    						<select class="form-control" name="page_group_id" id="page_group_id">
    								<?php 
    								while ($row20 = $result20->fetch_assoc()) {
                    				?>
    								<option <?php if ($page_group_id == $row20['page_group_id']) { echo "selected = 'selected'";}?> value="<?=$row20['page_group_id']?>"><?=$row20['page_group_name']?></option>
    								<?php 
                    				}
    								?>
    						</select>
    						<?php 
    						}
    						?>
    					</div>
    					<div class="form-group">
    						<label>Bài Viết (<span style='color: red'>*</span>)
    						</label> _Max: 300 ký tự <input type="text" class="form-control" name="page_name" id="page_name"
    							value="<?=$row['page_name']?>" />
    					</div>
    					<div class="form-group">
    						<label>Bài Viết Permalink(<span style='color: red'>*</span>)
    						</label> _ Permalink là duy nhất. Không bao gồm ký tự '.' _Max: 300 ký tự <input type="text" id="permalink"
    							class="form-control" name="permalink" value="<?=$row['permalink']?>" />
    					</div>
    					<div class="form-group">
							<label>Tag Bài Viết</label> _ Có thể thêm nhiều tag cách nhau bởi dấu ',' ( VD: tag1, tag2, ... )
							<input list="browsers-tag" name="suggest_tag_id" id="suggest_tag_id" value="" placeholder="Hỗ trợ tìm kiến Tag" style="width: 300px"/>
							<input type="button" id="suggest_set_tag_id" value="Thêm Tag"/>
							<div id="suggesstion-tag-box"></div>
							<?php 
							    $tagList = '';
        						$sqltag = " SELECT tag_name FROM np_prod_tag A";
        						$sqltag .= " INNER JOIN tag_page B ON A.tag_id = B.tag_id ";
        						$sqltag .= " WHERE B.page_id = '$page_id'";
        						$resulttag = $conn->query($sqltag);
        						if ($resulttag->num_rows > 0) {
        						    while ($rowtag = $resulttag->fetch_assoc()) {
        						        $tagList .= $rowtag['tag_name'] . ',';
        						    }
        						}
    						?>
							<textarea rows="5" class="form-control" name="tag_id" id="tag_id" ><?=substr($tagList, 0, -1)?></textarea>
						</div>
						<div class="form-group">
							<label>Sản Phẩm Liên Quan Bài viết</label> _ Có thể chọn nhiều sản phẩm cách nhau bởi dấu ','
							<input list="browsers-product" name="suggest_product_id" id="suggest_product_id" value="" placeholder="Hỗ trợ tìm kiến Sản Phẩm"  style="width: 300px"/>
							<input type="button" id="suggest_set_product_id" value="Thêm Product"/>
							<div id="suggest_product_box"></div>
							<?php 
							    $productList = '';
        						$sqlprd = " SELECT product_name FROM np_product A";
        						$sqlprd .= " INNER JOIN page_product B ON A.product_id  = B.product_id  ";
        						$sqlprd .= " WHERE B.page_id = '$page_id'";
        						$resultprd = $conn->query($sqlprd);
        						if ($resultprd->num_rows > 0) {
        						    while ($rowprd = $resultprd->fetch_assoc()) {
        						        $productList .= $rowprd['product_name'] . ',';
        						    }
        						}
    						?>
							<textarea rows="5" class="form-control" name="product_id" id="product_id" ><?=substr($productList, 0, -1)?></textarea>
						</div>
						
        			</div>
        				<div class="col-md-6">
    						<div class="form-group">
    							<label>Tóm tắt Bài viết(<span style='color: red'>*</span>)
    							</label> _Max: 500 ký tự <textarea rows="10" class="form-control" name="page_description"><?=$row['page_description']?></textarea>
    						</div>
    						<div class="form-group">
    							<label>Page Seo </label> _Thông tin Header, Title, Meta ... để SEO _Max: 4000 ký tự
    							<textarea rows="10" class="form-control" name="page_seo" id="page_seo" ><?=$row['page_seo']?></textarea>
    						</div>
    					</div>
        			</div>
        			<div class="form-group">
        						<label>Chi tiết Bài viết(<span style='color: red'>*</span>)
        						</label> <textarea rows="30" class="form-control" name="page_content" id="editor"><?=$row['page_content']?></textarea>
        			</div>
        			</br>
        			<div class="form-group">
        				<label>(<span style='color: red'>*</span>)
        				</label> Trường cần phải nhập thông tin
        			<input type="hidden" name='id' value='<?=$_REQUEST['id']?>' />
        			<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' />
        			<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
        			<input type="submit" name="submit" value="Thay đổi Bài Viết"
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
    $sql = "SELECT A.page_id, A.page_name, B.permalink, A.image_url FROM np_page A ";
    $sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
    $sql .= "  WHERE B.delete_flag = '0' ";
    $sql .= "  ORDER BY page_id DESC ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $n = 0;
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách Bài Viết <?=$message?></div>
			<div class="panel-body">
				<table class="table">
				<tr>
					<td>No</td>
					<td>Tên Bài Viết</td>
					<td>Permalink</td>
					<td>Ảnh Bìa</td>
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
					<td><?=$row["page_name"]?></td>
					<td><?=$row["permalink"]?></td>
					<td> <?=$row["image_url"]?> | <a href="?pcid=detpgImg&display=addnew&id=<?=$row["page_id"]?>&brname=<?=$row["page_name"]?>&table=np_page">Update Ảnh</a></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=edit&id=<?=$row["page_id"]?>">Sửa</a></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=list&action=delete&id=<?=$row["page_id"]?>"
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
	} );
</script>